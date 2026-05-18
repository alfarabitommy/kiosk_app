<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_locations() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('sys_locations')->result_array();
    }

    public function add_location($location_code, $location_name) {
        $data = array(
            'location_code' => strtoupper(trim($location_code)),
            'location_name' => strtoupper(trim($location_name))
        );
        $this->db->insert('sys_locations', $data);

        // Otomatis buat default settings untuk lokasi baru
        $default_settings = array(
            array('location_code' => $data['location_code'], 'setting_key' => 'timer_sec', 'setting_value' => '10'),
            array('location_code' => $data['location_code'], 'setting_key' => 'noise_gate_db', 'setting_value' => '40'),
            array('location_code' => $data['location_code'], 'setting_key' => 'scoring_mode', 'setting_value' => 'hybrid')
        );
        $this->db->insert_batch('app_settings', $default_settings);

        // Otomatis buat baris kosong aset untuk lokasi baru
        $default_assets = array(
            array('location_code' => $data['location_code'], 'asset_name' => 'bg_main', 'file_path' => ''),
            array('location_code' => $data['location_code'], 'asset_name' => 'client_logo', 'file_path' => ''),
            array('location_code' => $data['location_code'], 'asset_name' => 'prop_bowl', 'file_path' => ''),
            array('location_code' => $data['location_code'], 'asset_name' => 'prop_noodle', 'file_path' => ''),
            array('location_code' => $data['location_code'], 'asset_name' => 'prop_chopstick', 'file_path' => '')
        );
        $this->db->insert_batch('app_assets', $default_assets);
        return TRUE;
    }

    public function get_all_settings($location_code) {
        $this->db->where('location_code', $location_code);
        $query = $this->db->get('app_settings');
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->setting_key] = $row->setting_value;
        }
        return $result;
    }

    public function update_setting($location_code, $setting_key, $setting_value) {
        $this->db->where('location_code', $location_code);
        $this->db->where('setting_key', $setting_key);
        return $this->db->update('app_settings', array('setting_value' => $setting_value));
    }

    public function get_all_assets($location_code) {
        $this->db->where('location_code', $location_code);
        $query = $this->db->get('app_assets');
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->asset_name] = $row->file_path;
        }
        return $result;
    }

    public function update_asset($location_code, $asset_name, $file_path) {
        $this->db->where('location_code', $location_code);
        $this->db->where('asset_name', $asset_name);
        return $this->db->update('app_assets', array('file_path' => $file_path));
    }
}