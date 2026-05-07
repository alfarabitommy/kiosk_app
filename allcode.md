<!-- file assets/kiosk/css/style.css -->
/* File: assets/kiosk/css/style.css */
/* Gen-Z Playful & Pastel White-Label Strict */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', 'Quicksand', 'Nunito', Tahoma, sans-serif;
    user-select: none;
}

body {
    background-color: #fce4ec; /* Pastel pink background */
    color: #5d4037; /* Cokelat lembut untuk teks agar kontras tapi tidak kaku */
    overflow: hidden;
    width: 100vw;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

#app-container {
    width: 1080px; 
    height: 1920px;
    background: linear-gradient(135deg, #ffffff 0%, #fff0f5 100%);
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 50px rgba(255, 182, 193, 0.5); /* Soft pink shadow */
}

section {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: opacity 0.4s ease-in-out, transform 0.4s ease-in-out;
}

.hidden {
    opacity: 0;
    pointer-events: none;
    z-index: -1;
    transform: scale(0.95);
}

.text-title {
    color: #ff9aa2; /* Pastel red/pink */
    font-size: 4.5rem;
    font-weight: 900;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 4px 4px 0px #ffe5e5, 8px 8px 0px rgba(0,0,0,0.05); /* Playful retro shadow */
    margin-bottom: 2rem;
}

@keyframes bounceText {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

.text-bounce {
    animation: bounceText 2s infinite ease-in-out;
}

.form-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 30px;
    width: 80%;
}

input[type="text"] {
    width: 100%;
    padding: 30px;
    font-size: 2.5rem;
    border: 4px solid #b5ead7; /* Pastel mint */
    border-radius: 25px;
    text-align: center;
    color: #5d4037;
    background-color: #ffffff;
    box-shadow: 0 10px 20px rgba(181, 234, 215, 0.3);
    outline: none;
    transition: all 0.3s;
}

input[type="text"]:focus {
    border-color: #ffdac1; /* Pastel peach */
    transform: scale(1.02);
}

.btn-primary {
    background-color: #b5ead7; /* Pastel mint */
    color: #5d4037;
    border: none;
    border-radius: 50px;
    padding: 25px 80px;
    font-size: 2.5rem;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    box-shadow: 0 10px 0px #8bc34a, 0 15px 20px rgba(0,0,0,0.1);
    transition: all 0.1s;
}

.btn-primary:active {
    transform: translateY(10px);
    box-shadow: 0 0px 0px #8bc34a, 0 5px 10px rgba(0,0,0,0.1);
}

/* Gameplay Elements */
#kiosk-bg {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

#kiosk-bowl {
    position: absolute;
    bottom: 5%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
}

#kiosk-noodle {
    position: absolute;
    bottom: 10%;
    left: 50%;
    transform: translateX(-50%) translateY(0px);
    z-index: 2;
    transition: transform 0.1s linear;
}

#kiosk-chopstick {
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%);
    z-index: 4;
}

#ui-hud {
    position: absolute;
    top: 5%;
    width: 90%;
    display: flex;
    justify-content: space-between;
    z-index: 10;
}

.hud-box {
    background-color: rgba(255, 255, 255, 0.9);
    padding: 15px 40px;
    border-radius: 30px;
    font-size: 3.5rem;
    font-weight: 900;
    color: #ff9aa2;
    border: 4px solid #ffdac1;
    box-shadow: 0 8px 15px rgba(255, 218, 193, 0.5);
}

#final-score-display {
    font-size: 8rem;
    font-weight: 900;
    color: #b5ead7;
    text-shadow: 5px 5px 0px #8bc34a;
}

.table-card {
    background: #ffffff;
    border-radius: 30px;
    padding: 30px;
    width: 90%;
    box-shadow: 0 15px 30px rgba(0,0,0,0.05);
    border: 4px solid #e2f0cb;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 2.2rem;
}

th {
    color: #ff9aa2;
    padding-bottom: 20px;
    border-bottom: 4px dashed #ffdac1;
}

td {
    padding: 20px 0;
    text-align: center;
    font-weight: bold;
    border-bottom: 2px solid #f9f9f9;
}
<!-- end file assets/kiosk/css/style.css -->

<!-- file assets/kiosk/js/app.js -->
const appState = {
    currentState: 'state-boot',
    playerData: {
        name: '',
        peakDb: 0,
        durationMs: 0
    }
};

function changeState(newStateId) {
    document.querySelectorAll('section').forEach(sec => {
        sec.classList.add('hidden');
    });
    document.getElementById(newStateId).classList.remove('hidden');
    appState.currentState = newStateId;
}

window.onload = () => {
    // Simulasi inisialisasi boot
    setTimeout(() => {
        changeState('state-idle');
    }, 2000);
};

// Event Listeners Dasar
document.getElementById('state-idle').addEventListener('click', () => {
    changeState('state-register');
});

document.getElementById('btn-start-game').addEventListener('click', () => {
    const playerName = document.getElementById('input-player-name').value;
    if(playerName.trim() !== "") {
        appState.playerData.name = playerName;
        changeState('state-game');
        // Logic mulai game akan di-trigger ke audio-engine.js di fase selanjutnya
    }
});
<!-- end file assets/kiosk/js/app.js -->

<!-- file assets/kiosk/js/audio-engine.js -->
let audioCtx; 
let analyser; 
let microphone; 

function initAudioEngine() {
    // Kerangka untuk menginisiasi navigator.mediaDevices.getUserMedia
    // Akan diimplementasikan penuh pada Fase 3
    console.log("Audio Engine Ready to Initialize.");
}

function processAudio() {
    // Kerangka untuk loop requestAnimationFrame
}

function stopAudio() {
    if(audioCtx) {
        audioCtx.close().then(() => {
            console.log("AudioContext Closed. Memory Cleared.");
        });
    }
}
<!-- end file assets/kiosk/js/audio-engine.js -->

<!-- file application/controller/Kiosk.php -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiosk extends CI_Controller {
    public function index() {
        $this->load->helper('url');
        $this->load->view('kiosk_view');
    }
}
<!-- end file application/controller/Kiosk.php -->

<!-- file application/models/Auth_model.php -->
<!-- // File: application/models/Auth_model.php -->

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function verify_login($username, $password) {
        $this->db->where('username', $username);
        $query = $this->db->get('sys_users');

        if ($query->num_rows() === 1) {
            $user = $query->row();
            // Verifikasi hash password (pastikan password di-hash dengan password_hash() saat pembuatan user)
            if (password_verify($password, $user->password)) {
                // Update waktu last login
                $this->db->where('id', $user->id);
                $this->db->update('sys_users', array('last_login' => date('Y-m-d H:i:s')));
                
                return $user;
            }
        }
        return FALSE;
    }
}
<!-- end file application/models/Auth_model.php -->

<!-- file application/models/Settings_model.php -->
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
<!-- end file application/models/Settings_model.php -->

<!-- file application/models/Leaderboard_model.php -->
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
<!-- end file application/models/Leaderboard_model.php -->

<!-- file application/views/kiosk_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice-Activated Noodle Game</title>
    <link rel="stylesheet" href="<?= base_url('assets/kiosk/css/style.css'); ?>">
</head>
<body>
    <div id="app-container">
        
        <section id="state-boot">
            <h1 class="text-title text-bounce">MEMUAT ASET...</h1>
        </section>

        <section id="state-idle" class="hidden">
            <h1 class="text-title">SENTUH LAYAR<br>UNTUK BERMAIN!</h1>
        </section>

        <section id="state-register" class="hidden">
            <div class="form-group">
                <input type="text" id="input-player-name" maxlength="15" placeholder="Siapa namamu?">
                <button id="btn-start-game" class="btn-primary">MULAI MAIN</button>
            </div>
            <div id="keyboard-container"></div>
        </section>

        <section id="state-game" class="hidden">
            <img id="kiosk-bg" src="" alt="">
            <img id="kiosk-bowl" src="" alt="">
            <img id="kiosk-noodle" src="" alt="">
            <img id="kiosk-chopstick" src="" alt="">
            
            <div id="ui-hud">
                <div id="ui-timer" class="hud-box">10.0s</div>
                <div id="ui-decibel-meter" class="hud-box">0 dB</div>
            </div>
        </section>

        <section id="state-result" class="hidden">
            <h2 class="text-title">YAY! SKOR KAMU:</h2>
            <div id="final-score-display">0</div>
        </section>

        <section id="state-leaderboard" class="hidden">
            <h2 class="text-title">LEADERBOARD</h2>
            <div class="table-card">
                <table id="leaderboard-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Nama</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody id="leaderboard-body">
                        </tbody>
                </table>
            </div>
        </section>

    </div>

    <script src="<?= base_url('assets/kiosk/js/audio-engine.js'); ?>"></script>
    <script src="<?= base_url('assets/kiosk/js/app.js'); ?>"></script>
</body>
</html>
<!-- end file application/views/kiosk_view.php -->