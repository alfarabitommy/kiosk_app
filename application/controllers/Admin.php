<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
    }

    public function index() {
        $data['page_title'] = 'Macro Dashboard Analytics';
        $data['total_players_overall'] = $this->Leaderboard_model->count_players();
        
        $locations = $this->Settings_model->get_all_locations();
        $breakdown = array();
        foreach ($locations as $loc) {
            $breakdown[] = array(
                'code' => $loc['location_code'],
                'name' => $loc['location_name'],
                'count' => $this->Leaderboard_model->count_players($loc['location_code'])
            );
        }
        $data['locations_breakdown'] = $breakdown;
        $this->load->view('admin/dashboard_view', $data);
    }

    public function add_location_process() {
        $code = $this->input->post('location_code', TRUE);
        $name = $this->input->post('location_name', TRUE);
        
        if(!empty($code) && !empty($name)) {
            $this->Settings_model->add_location($code, $name);
            $this->session->set_flashdata('success', 'Cabang Kiosk Baru Berhasil Didaftarkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mendaftarkan lokasi, data tidak lengkap.');
        }
        redirect('admin/settings');
    }

    public function settings() {
        $selected_loc = $this->input->get('loc', TRUE);
        $data['locations'] = $this->Settings_model->get_all_locations();
        
        if (empty($selected_loc) && !empty($data['locations'])) {
            $selected_loc = $data['locations'][0]['location_code'];
        }
        
        if ($this->input->post()) {
            $loc_target = $this->input->post('location_code', TRUE);
            $this->Settings_model->update_setting($loc_target, 'timer_sec', $this->input->post('timer_sec', TRUE));
            $this->Settings_model->update_setting($loc_target, 'noise_gate_db', $this->input->post('noise_gate_db', TRUE));
            $this->Settings_model->update_setting($loc_target, 'scoring_mode', $this->input->post('scoring_mode', TRUE));
            $this->session->set_flashdata('success', 'Pengaturan Cabang ' . $loc_target . ' Berhasil Disimpan!');
            redirect('admin/settings?loc=' . $loc_target);
        }

        $data['selected_loc'] = $selected_loc;
        $data['page_title'] = 'Tenant Configuration Manager';
        $data['settings'] = $this->Settings_model->get_all_settings($selected_loc);
        $data['assets'] = $this->Settings_model->get_all_assets($selected_loc);
        $this->load->view('admin/settings_view', $data);
    }

    public function upload_asset() {
        $loc_target = $this->input->post('location_code', TRUE);
        $asset_key = $this->input->post('asset_key', TRUE);
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $loc_target . '_' . $asset_key . '_asset'; 
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('asset_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('',''));
        } else {
            $upload_data = $this->upload->data();
            $file_path = 'uploads/' . $upload_data['file_name'];
            $this->Settings_model->update_asset($loc_target, $asset_key, $file_path);
            $this->session->set_flashdata('success', 'Aset ' . $asset_key . ' untuk ' . $loc_target . ' Sukses Diperbarui!');
        }
        redirect('admin/settings?loc=' . $loc_target);
    }

    public function leaderboard() {
        $selected_loc = $this->input->get('loc', TRUE);
        $data['locations'] = $this->Settings_model->get_all_locations();
        $data['selected_loc'] = $selected_loc;
        $data['page_title'] = 'Leaderboard Filter Engine';
        $data['leaderboard_data'] = $this->Leaderboard_model->get_all_for_export($selected_loc);
        $this->load->view('admin/leaderboard_view', $data);
    }

    public function export_csv() {
        $selected_loc = $this->input->get('loc', TRUE);
        $suffix = (!empty($selected_loc)) ? $selected_loc : 'OVERALL';
        $filename = 'Leaderboard_Kiosk_' . $suffix . '_' . date('Ymd') . '.csv';
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=UTF-8");
        
        $file = fopen('php://output', 'w');
        fputcsv($file, array("ID", "Kode Lokasi", "Nama Lokasi", "Nama Pemain", "Peak dB", "Sustain (ms)", "Skor Akhir", "Waktu Bermain"));
        
        $leaderboard_data = $this->Leaderboard_model->get_all_for_export($selected_loc);
        foreach ($leaderboard_data as $row) {
            fputcsv($file, array(
                $row['id'],
                $row['location_code'],
                $row['location_name'],
                $row['player_name'],
                $row['peak_db'],
                $row['duration_ms'],
                $row['final_score'],
                $row['created_at']
            ));
        }
        fclose($file);
        exit;
    }

    public function reset_leaderboard() {
        $selected_loc = $this->input->get('loc', TRUE);
        $this->Leaderboard_model->truncate_data($selected_loc);
        $this->session->set_flashdata('success', 'Data Papan Skor Terpilih Sukses Dikosongkan!');
        redirect('admin/leaderboard?loc=' . $selected_loc);
    }
}