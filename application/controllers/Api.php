<?php
// File: application/controllers/Api.php
// Description: API Controller dengan tambahan endpoint sinkronisasi massal (batch sync) dari database lokal Kiosk

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    public function init() {
        $location_code = $this->input->get('loc', TRUE);
        if (empty($location_code)) $location_code = 'JKT-01';

        $settings = $this->Settings_model->get_all_settings($location_code);
        $assets = $this->Settings_model->get_all_assets($location_code);

        echo json_encode(array(
            'status' => 200,
            'location' => $location_code,
            'settings' => $settings,
            'assets' => $assets
        ));
    }

    public function score() {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean, true);

        $player_name = isset($request['player_name']) ? $request['player_name'] : '';
        $peak_db = isset($request['peak_db']) ? (float)$request['peak_db'] : 0;
        $duration_ms = isset($request['duration_ms']) ? (int)$request['duration_ms'] : 0;
        $location_code = isset($request['location_code']) ? $request['location_code'] : 'JKT-01';

        if (empty(trim($player_name))) {
            echo json_encode(array('status' => 400, 'message' => 'Nama tidak boleh kosong.'));
            return;
        }

        $final_score = $this->Leaderboard_model->insert_score($player_name, $peak_db, $duration_ms, $location_code);

        echo json_encode(array(
            'status' => 200,
            'message' => 'Skor sukses disimpan.',
            'final_score' => $final_score
        ));
    }

    public function top_scores() {
        $location_code = $this->input->get('loc', TRUE);
        if (empty($location_code)) $location_code = 'JKT-01';

        $top_10 = $this->Leaderboard_model->get_top_10($location_code);
        echo json_encode(array('status' => 200, 'data' => $top_10));
    }

    // Endpoint Baru: Menerima kiriman data massal dari IndexedDB Kiosk Offline
    public function sync_batch() {
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean, true);

        if (!isset($request['scores']) || !is_array($request['scores'])) {
            echo json_encode(array('status' => 400, 'message' => 'Payload data tidak valid.'));
            return;
        }

        $inserted_records = 0;
        foreach ($request['scores'] as $row) {
            $player_name = isset($row['player_name']) ? $row['player_name'] : 'OFFLINE_PLY';
            $peak_db = isset($row['peak_db']) ? (float)$row['peak_db'] : 0;
            $duration_ms = isset($row['duration_ms']) ? (int)$row['duration_ms'] : 0;
            $location_code = isset($row['location_code']) ? $row['location_code'] : 'JKT-01';
            $created_at = isset($row['created_at']) ? $row['created_at'] : date('Y-m-d H:i:s');

            // Insert langsung tanpa hitung ulang skor karena skor sudah dihitung valid secara lokal di client side
            $data = array(
                'location_code' => $location_code,
                'player_name'   => $player_name,
                'peak_db'       => $peak_db,
                'duration_ms'   => $duration_ms,
                'final_score'   => (int)$row['final_score'],
                'created_at'    => $created_at
            );

            $this->db->insert('game_leaderboard', $data);
            $inserted_records++;
        }

        echo json_encode(array(
            'status' => 200,
            'message' => 'Sinkronisasi sukses dilakukan.',
            'synced_count' => $inserted_records
        ));
    }
}