<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
        
        // Memastikan output selalu dibaca sebagai JSON oleh browser/frontend
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
    }

    // Endpoint: GET /api/init
    // Fungsi: Mengirimkan aturan game dan path gambar aset ke Frontend saat pertama kali loading
    public function init() {
        $settings = $this->Settings_model->get_all_settings();
        $assets = $this->Settings_model->get_all_assets();

        $response = array(
            'status' => 200,
            'settings' => $settings,
            'assets' => $assets
        );
        
        echo json_encode($response);
    }

    // Endpoint: POST /api/score
    // Fungsi: Menangkap data dari JS saat game selesai, mengkalkulasi skor, dan menyimpannya ke DB
    public function score() {
        // Vanilla JS fetch() biasanya mengirim data dalam format raw JSON stream
        $stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
        $request = json_decode($stream_clean, true);

        // Menangkap payload
        $player_name = isset($request['player_name']) ? $request['player_name'] : '';
        $peak_db = isset($request['peak_db']) ? (float)$request['peak_db'] : 0;
        $duration_ms = isset($request['duration_ms']) ? (int)$request['duration_ms'] : 0;

        // Validasi dasar
        if (empty(trim($player_name))) {
            echo json_encode(array('status' => 400, 'message' => 'Nama pemain tidak boleh kosong.'));
            return;
        }

        // Panggil fungsi insert_score di Leaderboard_model (Logika Skoring ada di sana sesuai Pilar 4)
        $final_score = $this->Leaderboard_model->insert_score($player_name, $peak_db, $duration_ms);

        $response = array(
            'status' => 200,
            'message' => 'Skor berhasil disimpan.',
            'final_score' => $final_score
        );
        
        echo json_encode($response);
    }

    // Endpoint: GET /api/top_scores
    // Fungsi: Mengirimkan daftar 10 skor tertinggi ke Frontend untuk ditampilkan di layar Leaderboard
    public function top_scores() {
        $top_10 = $this->Leaderboard_model->get_top_10();
        
        $response = array(
            'status' => 200,
            'data' => $top_10
        );
        
        echo json_encode($response);
    }
}