<!-- // File: application/controllers/Admin.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Cek session login 
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
    }

    // Tampilkan dashboard ringkasan 
    public function index() {
        $data['page_title'] = 'Dashboard Analytics';
        $data['total_players'] = $this->db->count_all('game_leaderboard');
        $this->load->view('admin/dashboard_view', $data);
    }

    // Form validation dan update app_settings
    public function settings() {
        if ($this->input->post()) {
            $this->Settings_model->update_setting('timer_sec', $this->input->post('timer_sec', TRUE));
            $this->Settings_model->update_setting('noise_gate_db', $this->input->post('noise_gate_db', TRUE));
            $this->Settings_model->update_setting('scoring_mode', $this->input->post('scoring_mode', TRUE));
            $this->session->set_flashdata('success', 'Pengaturan Game berhasil disimpan!');
            redirect('admin/settings');
        }
        
        $data['page_title'] = 'Game Configuration & Assets';
        $data['settings'] = $this->Settings_model->get_all_settings();
        $data['assets'] = $this->Settings_model->get_all_assets();
        $this->load->view('admin/settings_view', $data);
    }

    // Konfigurasi library Upload CI3
    public function upload_asset() {
        $asset_key = $this->input->post('asset_key', TRUE);
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        // Atur overwrite = TRUE agar file lama terganti 
        $config['overwrite']     = TRUE;
        $config['file_name']     = $asset_key . '_asset'; 
        
        // Buat folder jika belum ada
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('asset_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('',''));
        } else {
            $upload_data = $this->upload->data();
            $file_path = 'uploads/' . $upload_data['file_name'];
            $this->Settings_model->update_asset($asset_key, $file_path);
            $this->session->set_flashdata('success', 'Aset ' . $asset_key . ' berhasil diperbarui!');
        }
        redirect('admin/settings');
    }

    // Tampilkan tabel dengan library DataTables 
    public function leaderboard() {
        $data['page_title'] = 'Leaderboard Management';
        $data['leaderboard_data'] = $this->Leaderboard_model->get_all_for_export();
        $this->load->view('admin/leaderboard_view', $data);
    }

    // Fitur ekspor CSV murni 
    public function export_csv() {
        $filename = 'Kiosk_Event_Leaderboard_' . date('Ymd') . '.csv'; 
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Content-Type: text/csv; charset=UTF-8"); 
        
        $file = fopen('php://output', 'w');
        
        // Header Kolom CSV
        $header = array("ID", "Nama Pemain", "Peak dB", "Duration (ms)", "Final Score", "Waktu Bermain");
        fputcsv($file, $header); 
        
        // Iterasi Data 
        $leaderboard_data = $this->Leaderboard_model->get_all_for_export();
        foreach ($leaderboard_data as $row) {
            fputcsv($file, array(
                $row['id'],
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

    // Eksekusi TRUNCATE table 
    public function reset_leaderboard() {
        $this->Leaderboard_model->truncate_data();
        $this->session->set_flashdata('success', 'Semua data Leaderboard berhasil dihapus!');
        redirect('admin/leaderboard');
    }
}