<!-- // File: application/models/Settings_model.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_settings() {
        $query = $this->db->get('app_settings');
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->setting_key] = $row->setting_value;
        }
        return $result;
    }

    public function update_setting($setting_key, $setting_value) {
        $this->db->where('setting_key', $setting_key);
        return $this->db->update('app_settings', array('setting_value' => $setting_value));
    }

    public function get_all_assets() {
        $query = $this->db->get('app_assets');
        $result = array();
        foreach ($query->result() as $row) {
            $result[$row->asset_name] = $row->file_path;
        }
        return $result;
    }

    public function update_asset($asset_name, $file_path) {
        $this->db->where('asset_name', $asset_name);
        return $this->db->update('app_assets', array('file_path' => $file_path));
    }
}