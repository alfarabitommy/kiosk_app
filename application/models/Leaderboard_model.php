<!-- // File: application/models/Leaderboard_model.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaderboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_score($player_name, $peak_db, $duration_ms) {
        // Mengambil konfigurasi scoring dari database (Pilar 4: Logika Skoring di Model)
        $this->db->select('setting_key, setting_value');
        $this->db->where_in('setting_key', array('scoring_mode', 'weight_power', 'weight_endurance'));
        $settings_query = $this->db->get('app_settings')->result_array();
        
        $config = array();
        foreach ($settings_query as $row) {
            $config[$row['setting_key']] = $row['setting_value'];
        }

        $mode = isset($config['scoring_mode']) ? $config['scoring_mode'] : 'hybrid';
        
        // Default bobot jika belum ada di database
        $w_power = isset($config['weight_power']) ? (float)$config['weight_power'] : 100;
        $w_endurance = isset($config['weight_endurance']) ? (float)$config['weight_endurance'] : 1;

        $final_score = 0;

        // Kalkulasi dinamis berdasarkan mode [cite: 51, 52, 53]
        if ($mode === 'power') {
            $final_score = (int) ($peak_db * $w_power);
        } elseif ($mode === 'endurance') {
            $final_score = (int) ($duration_ms * $w_endurance);
        } else {
            // Mode Hybrid: (Peak dB * Bobot X) + (Duration ms * Bobot Y) [cite: 53]
            $final_score = (int) (($peak_db * $w_power) + ($duration_ms * $w_endurance));
        }

        // Persiapan data insert
        $data = array(
            'player_name' => $player_name,
            'peak_db' => $peak_db,
            'duration_ms' => $duration_ms,
            'final_score' => $final_score,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('game_leaderboard', $data);
        
        // Kembalikan skor akhir agar bisa direspon oleh API ke Frontend
        return $final_score;
    }

    public function get_top_10() {
        $this->db->select('player_name, final_score');
        $this->db->order_by('final_score', 'DESC');
        $this->db->limit(10);
        return $this->db->get('game_leaderboard')->result_array();
    }

    public function get_all_for_export() {
        $this->db->order_by('final_score', 'DESC');
        return $this->db->get('game_leaderboard')->result_array();
    }

    public function truncate_data() {
        return $this->db->truncate('game_leaderboard');
    }
}