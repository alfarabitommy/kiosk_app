<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leaderboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function insert_score($player_name, $peak_db, $duration_ms, $location_code) {
        $this->db->select('setting_key, setting_value');
        $this->db->where('location_code', $location_code);
        $this->db->where_in('setting_key', array('scoring_mode', 'weight_power', 'weight_endurance'));
        $settings_query = $this->db->get('app_settings')->result_array();
        
        $config = array();
        foreach ($settings_query as $row) {
            $config[$row['setting_key']] = $row['setting_value'];
        }

        $mode = isset($config['scoring_mode']) ? $config['scoring_mode'] : 'hybrid';
        $w_power = isset($config['weight_power']) ? (float)$config['weight_power'] : 100;
        $w_endurance = isset($config['weight_endurance']) ? (float)$config['weight_endurance'] : 1;

        $final_score = 0;

        if ($mode === 'power') {
            $final_score = (int) ($peak_db * $w_power);
        } elseif ($mode === 'endurance') {
            $final_score = (int) ($duration_ms * $w_endurance);
        } else {
            $final_score = (int) (($peak_db * $w_power) + ($duration_ms * $w_endurance));
        }

        $data = array(
            'location_code' => $location_code,
            'player_name'   => $player_name,
            'peak_db'       => $peak_db,
            'duration_ms'   => $duration_ms,
            'final_score'   => $final_score,
            'created_at'    => date('Y-m-d H:i:s')
        );

        $this->db->insert('game_leaderboard', $data);
        return $final_score;
    }

    public function get_top_10($location_code) {
        $this->db->select('player_name, final_score');
        $this->db->where('location_code', $location_code);
        $this->db->order_by('final_score', 'DESC');
        $this->db->limit(10);
        return $this->db->get('game_leaderboard')->result_array();
    }

    public function get_all_for_export($location_code = NULL) {
        $this->db->select('game_leaderboard.*, sys_locations.location_name');
        $this->db->from('game_leaderboard');
        $this->db->join('sys_locations', 'sys_locations.location_code = game_leaderboard.location_code');
        
        if ($location_code !== NULL && $location_code !== '') {
            $this->db->where('game_leaderboard.location_code', $location_code);
        }
        
        $this->db->order_by('game_leaderboard.final_score', 'DESC');
        return $this->db->get()->result_array();
    }

    public function count_players($location_code = NULL) {
        if ($location_code !== NULL && $location_code !== '') {
            $this->db->where('location_code', $location_code);
        }
        return $this->db->count_all_results('game_leaderboard');
    }

    public function truncate_data($location_code = NULL) {
        if ($location_code !== NULL && $location_code !== '') {
            $this->db->where('location_code', $location_code);
            return $this->db->delete('game_leaderboard');
        }
        return $this->db->truncate('game_leaderboard');
    }
}