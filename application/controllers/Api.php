<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
    }

    public function init() {
        $location_code = $this->input->get('loc', TRUE);
        if (empty($location_code)) $location_code = 'JKT-01'; // Fallback

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
}