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

<!-- file assets/admin/css/admin_style.css -->
/* File: assets/admin/css/admin_style.css */
/* Kiosk CMS Admin - Cheerful Pastel Theme */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', 'Quicksand', 'Nunito', Tahoma, sans-serif;
}

body {
    background-color: #fef6f8; /* Soft baby pink */
    color: #5d4037;
}

.login-container {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #ffdac1 0%, #fce4ec 100%);
}

.admin-layout {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    width: 260px;
    background-color: #ffffff;
    padding: 30px 20px;
    box-shadow: 5px 0 20px rgba(255, 182, 193, 0.2);
    z-index: 10;
}

.sidebar h2 {
    color: #ff9aa2;
    text-align: center;
    margin-bottom: 40px;
    font-size: 1.8rem;
}

.sidebar a {
    display: block;
    padding: 15px 20px;
    color: #5d4037;
    text-decoration: none;
    font-weight: bold;
    border-radius: 15px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.sidebar a:hover, .sidebar a.active {
    background-color: #b5ead7;
    transform: translateX(5px);
}

.sidebar a.logout {
    background-color: #ffe5e5;
    color: #ff6b6b;
    margin-top: 50px;
}

.main-content {
    flex: 1;
    padding: 40px;
    overflow-y: auto;
}

.page-title {
    color: #ff9aa2;
    margin-bottom: 30px;
    font-size: 2.5rem;
    text-shadow: 2px 2px 0px #ffe5e5;
}

.card {
    background-color: #ffffff;
    border-radius: 25px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(255, 182, 193, 0.15);
    border: 3px solid #fff0f5;
    margin-bottom: 30px;
}

.card-title {
    color: #b5ead7;
    margin-bottom: 20px;
    font-size: 1.5rem;
    border-bottom: 2px dashed #e2f0cb;
    padding-bottom: 10px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
    color: #ff9aa2;
}

.form-control {
    width: 100%;
    padding: 15px;
    border: 3px solid #ffe5e5;
    border-radius: 15px;
    font-size: 1.1rem;
    color: #5d4037;
    outline: none;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #ffdac1;
}

.btn {
    padding: 15px 30px;
    border: none;
    border-radius: 15px;
    font-size: 1.1rem;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s;
    text-decoration: none;
    display: inline-block;
}

.btn:active {
    transform: scale(0.95);
}

.btn-primary {
    background-color: #b5ead7;
    color: #5d4037;
    box-shadow: 0 5px 15px rgba(181, 234, 215, 0.4);
}

.btn-danger {
    background-color: #ff9aa2;
    color: #ffffff;
    box-shadow: 0 5px 15px rgba(255, 154, 162, 0.4);
}

.alert {
    padding: 15px 20px;
    border-radius: 15px;
    margin-bottom: 25px;
    font-weight: bold;
}

.alert-success {
    background-color: #e2f0cb;
    color: #4a7c59;
}

.alert-error {
    background-color: #ffdac1;
    color: #d84315;
}

/* Table Style */
.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th, .data-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 2px dashed #fff0f5;
}

.data-table th {
    color: #ff9aa2;
    font-weight: 900;
}

.stat-box {
    text-align: center;
    padding: 40px;
}

.stat-number {
    font-size: 5rem;
    color: #b5ead7;
    font-weight: 900;
    text-shadow: 3px 3px 0px #e2f0cb;
}
<!-- end file assets/admin/css/admin_style.css -->

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

        // Kalkulasi dinamis berdasarkan mode 
        if ($mode === 'power') {
            $final_score = (int) ($peak_db * $w_power);
        } elseif ($mode === 'endurance') {
            $final_score = (int) ($duration_ms * $w_endurance);
        } else {
            // Mode Hybrid: (Peak dB * Bobot X) + (Duration ms * Bobot Y) 
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

<!-- file application/views/admin/login_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/admin_style.css'); ?>">
</head>
<body>
    <div class="login-container">
        <div class="card" style="width: 400px;">
            <h2 class="page-title" style="text-align: center; margin-bottom: 10px;">CMS System</h2>
            <p style="text-align: center; margin-bottom: 30px; font-weight: bold;">Authorized Personnel Only</p>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login_process'); ?>" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>
<!-- end file application/views/admin/login_view.php -->

<!-- file application/views/admin/dashboard_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/admin_style.css'); ?>">
</head>
<body>
    <div class="admin-layout">
        <div class="sidebar">
            <h2>Kiosk CMS</h2>
            <a href="<?= site_url('admin'); ?>" class="active">Dashboard</a>
            <a href="<?= site_url('admin/settings'); ?>">Game Settings</a>
            <a href="<?= site_url('admin/leaderboard'); ?>">Leaderboard</a>
            <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout</a>
        </div>
        
        <div class="main-content">
            <h1 class="page-title"><?= $page_title; ?></h1>
            
            <div class="card stat-box">
                <h3 class="card-title" style="text-align: center; border: none;">Total Pemain (All Time)</h3>
                <div class="stat-number"><?= $total_players; ?></div>
                <p>Peserta telah berpartisipasi dalam interaksi Kiosk.</p>
            </div>
        </div>
    </div>
</body>
</html>
<!-- end file application/views/admin/dashboard_view.php -->

<!-- file application/views/admin/settings_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/admin_style.css'); ?>">
</head>
<body>
    <div class="admin-layout">
        <div class="sidebar">
            <h2>Kiosk CMS</h2>
            <a href="<?= site_url('admin'); ?>">Dashboard</a>
            <a href="<?= site_url('admin/settings'); ?>" class="active">Game Settings</a>
            <a href="<?= site_url('admin/leaderboard'); ?>">Leaderboard</a>
            <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout</a>
        </div>
        
        <div class="main-content">
            <h1 class="page-title"><?= $page_title; ?></h1>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <div class="card">
                <h3 class="card-title">Logika & Aturan Game</h3>
                <form action="<?= site_url('admin/settings'); ?>" method="POST">
                    <div class="form-group">
                        <label>Durasi Permainan (Detik)</label>
                        <input type="number" name="timer_sec" class="form-control" value="<?= isset($settings['timer_sec']) ? $settings['timer_sec'] : 10; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Noise Gate (Batas Bawah Desibel)</label>
                        <input type="number" name="noise_gate_db" class="form-control" value="<?= isset($settings['noise_gate_db']) ? $settings['noise_gate_db'] : 40; ?>" required>
                        <small style="color: #ff9aa2;">*Suara di bawah angka ini akan diabaikan (mencegah sumpit naik karena suara latar/musik mall).</small>
                    </div>
                    <div class="form-group">
                        <label>Scoring Mode</label>
                        <select name="scoring_mode" class="form-control" required>
                            <option value="power" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'power') ? 'selected' : ''; ?>>Power (Desibel Tertinggi Saja)</option>
                            <option value="endurance" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'endurance') ? 'selected' : ''; ?>>Endurance (Durasi Terlama Berteriak)</option>
                            <option value="hybrid" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'hybrid') ? 'selected' : ''; ?>>Hybrid (Gabungan Power & Endurance)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">SIMPAN ATURAN</button>
                </form>
            </div>

            <div class="card">
                <h3 class="card-title">Reskin Assets (White-Label)</h3>
                <form action="<?= site_url('admin/upload_asset'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pilih Aset untuk Diganti</label>
                        <select name="asset_key" class="form-control" required>
                            <option value="bg_main">Background Game (.jpg/.png)</option>
                            <option value="prop_bowl">Gambar Mangkuk (.png transparan)</option>
                            <option value="prop_noodle">Gambar Mie (.png transparan)</option>
                            <option value="prop_chopstick">Gambar Sumpit (.png transparan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Gambar Baru</label>
                        <input type="file" name="asset_file" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    <button type="submit" class="btn btn-primary">UPLOAD & TIMPA ASET</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<!-- end file application/views/admin/settings_view.php -->

<!-- file application/views/admin/leaderboard_view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/admin_style.css'); ?>">
</head>
<body>
    <div class="admin-layout">
        <div class="sidebar">
            <h2>Kiosk CMS</h2>
            <a href="<?= site_url('admin'); ?>">Dashboard</a>
            <a href="<?= site_url('admin/settings'); ?>">Game Settings</a>
            <a href="<?= site_url('admin/leaderboard'); ?>" class="active">Leaderboard</a>
            <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout</a>
        </div>
        
        <div class="main-content">
            <h1 class="page-title"><?= $page_title; ?></h1>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <div style="margin-bottom: 20px; display: flex; gap: 15px;">
                <a href="<?= site_url('admin/export_csv'); ?>" class="btn btn-primary">Download CSV (.csv)</a>
                <a href="<?= site_url('admin/reset_leaderboard'); ?>" class="btn btn-danger" onclick="return confirm('PERINGATAN: Semua data skor akan dihapus permanen. Lanjutkan?');">Reset/Hapus Semua Data</a>
            </div>

            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Nama Pemain</th>
                            <th>Peak (dB)</th>
                            <th>Sustain (ms)</th>
                            <th>Skor Akhir</th>
                            <th>Waktu Bermain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($leaderboard_data)): ?>
                            <?php $rank = 1; foreach($leaderboard_data as $row): ?>
                            <tr>
                                <td>#<?= $rank++; ?></td>
                                <td><strong><?= htmlspecialchars($row['player_name']); ?></strong></td>
                                <td><?= $row['peak_db']; ?></td>
                                <td><?= $row['duration_ms']; ?></td>
                                <td style="color: #b5ead7; font-weight: bold; font-size: 1.2rem;"><?= number_format($row['final_score']); ?></td>
                                <td><?= $row['created_at']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #ff9aa2;">Belum ada data pemain.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<!-- end file application/views/admin/leaderboard_view.php -->