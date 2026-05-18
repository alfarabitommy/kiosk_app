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
// File: assets/kiosk/js/app.js
// Description: State Machine Kiosk yang mengekstrak parameter URL '?loc=' untuk partisi multi-tenant

// Membaca KTP/Identitas Lokasi Kiosk dari Parameter Tautan Browser (?loc=)
const urlParams = new URLSearchParams(window.location.search);
const LOCATION_CODE = urlParams.get('loc') || 'JKT-01'; // Default ke JKT-01 jika tanpa parameter

const API_BASE = '/api'; 

const appState = {
    currentState: 'state-boot',
    settings: {
        timer_sec: 10,
        noise_gate_db: 40
    },
    playerData: {
        name: '',
        peakDb: 0,
        durationMs: 0
    },
    gameInterval: null,
    timeRemaining: 0,
    idleTimeout: null
};

const bannedWords = ['anjing', 'babi', 'bangsat', 'kontol', 'memek', 'jancok'];

function changeState(newStateId) {
    document.querySelectorAll('section').forEach(sec => {
        sec.classList.add('hidden');
    });
    document.getElementById(newStateId).classList.remove('hidden');
    appState.currentState = newStateId;
    resetIdleTimer();
}

window.onload = () => {
    fetchInitData();
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('dragstart', event => event.preventDefault());
};

async function fetchInitData() {
    try {
        // Mengirimkan parameter loc agar server mengirimkan aset khusus cabang ini
        const res = await fetch(`${API_BASE}/init?loc=${LOCATION_CODE}`);
        const data = await res.json();
        
        if (data.status === 200) {
            appState.settings.timer_sec = parseInt(data.settings.timer_sec) || 10;
            appState.settings.noise_gate_db = parseInt(data.settings.noise_gate_db) || 40;
            
            if(data.assets.bg_main) document.getElementById('kiosk-bg').src = '/' + data.assets.bg_main;
            if(data.assets.prop_bowl) document.getElementById('kiosk-bowl').src = '/' + data.assets.prop_bowl;
            if(data.assets.prop_noodle) document.getElementById('kiosk-noodle').src = '/' + data.assets.prop_noodle;
            if(data.assets.prop_chopstick) document.getElementById('kiosk-chopstick').src = '/' + data.assets.prop_chopstick;
        }
        
        setTimeout(() => {
            changeState('state-idle');
        }, 1500); 
    } catch (err) {
        console.error("Gagal memuat API Init untuk tenant:", err);
        alert("Koneksi API Gagal. Periksa Network Inspector.");
    }
}

function resetIdleTimer() {
    if (appState.idleTimeout) clearTimeout(appState.idleTimeout);
    if (appState.currentState !== 'state-game' && appState.currentState !== 'state-boot') {
        appState.idleTimeout = setTimeout(() => {
            changeState('state-idle');
            document.getElementById('input-player-name').value = '';
        }, 30000);
    }
}

document.addEventListener('click', resetIdleTimer);
document.addEventListener('touchstart', resetIdleTimer);

document.getElementById('state-idle').addEventListener('click', () => {
    changeState('state-register');
});

document.getElementById('btn-start-game').addEventListener('click', () => {
    const playerName = document.getElementById('input-player-name').value.trim();
    const isBanned = bannedWords.some(word => playerName.toLowerCase().includes(word));
    
    if(playerName !== "" && !isBanned) {
        appState.playerData.name = playerName;
        appState.playerData.peakDb = 0;
        appState.playerData.durationMs = 0;
        appState.timeRemaining = appState.settings.timer_sec;
        
        document.getElementById('ui-timer').innerText = appState.timeRemaining.toFixed(1) + 's';
        
        changeState('state-game');
        startGameplay();
    } else if (isBanned) {
        alert("Nama tidak pantas. Silakan gunakan nama lain.");
        document.getElementById('input-player-name').value = '';
    }
});

function startGameplay() {
    initAudioEngine(appState.settings.noise_gate_db);
    
    appState.gameInterval = setInterval(() => {
        appState.timeRemaining -= 0.1;
        document.getElementById('ui-timer').innerText = appState.timeRemaining.toFixed(1) + 's';
        
        if (currentDb > appState.playerData.peakDb) {
            appState.playerData.peakDb = currentDb;
        }
        if (currentDb > appState.settings.noise_gate_db) {
            appState.playerData.durationMs += 100;
        }

        if (appState.timeRemaining <= 0) {
            clearInterval(appState.gameInterval);
            endGameplay();
        }
    }, 100);
}

async function endGameplay() {
    stopAudio();
    
    document.getElementById('kiosk-noodle').style.transform = `translateX(-50%) translateY(0px)`;
    document.getElementById('kiosk-chopstick').style.transform = `translateX(-50%) translateY(0px)`;
    
    try {
        const res = await fetch(`${API_BASE}/score`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                location_code: LOCATION_CODE, // Mengirimkan identitas cabang saat klaim skor
                player_name: appState.playerData.name,
                peak_db: appState.playerData.peakDb,
                duration_ms: appState.playerData.durationMs
            })
        });
        const data = await res.json();
        
        if(data.status === 200) {
            document.getElementById('final-score-display').innerText = data.final_score.toLocaleString();
            changeState('state-result');
            
            setTimeout(() => {
                loadLeaderboard();
            }, 4000); 
        }
    } catch (err) {
        console.error("Gagal mengirim skor cabang:", err);
        changeState('state-idle');
    }
}

async function loadLeaderboard() {
    try {
        // Menampilkan top_scores terfilter khusus cabang ini saja
        const res = await fetch(`${API_BASE}/top_scores?loc=${LOCATION_CODE}`);
        const data = await res.json();
        
        const tbody = document.getElementById('leaderboard-body');
        tbody.innerHTML = '';
        
        if(data.status === 200 && data.data.length > 0) {
            data.data.forEach((row, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>#${index + 1}</td>
                        <td>${row.player_name}</td>
                        <td style="color: #ff9aa2;">${parseInt(row.final_score).toLocaleString()}</td>
                    </tr>
                `;
            });
        } else {
            tbody.innerHTML = `<tr><td colspan="3">Belum ada skor.</td></tr>`;
        }
        
        changeState('state-leaderboard');
        document.getElementById('input-player-name').value = '';
        
    } catch (err) {
        console.error("Gagal memuat leaderboard cabang:", err);
        changeState('state-idle');
    }
}
<!-- end file assets/kiosk/js/app.js -->

<!-- file assets/kiosk/js/audio-engine.js -->
let audioCtx;
let analyser;
let microphone;
let animationId;
let currentDb = 0;
let noiseGate = 40; // Default, akan dioverride oleh pengaturan CMS

// Inisialisasi Web Audio API dan akses Mikrofon
async function initAudioEngine(gateValue) {
    noiseGate = gateValue;
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ audio: true, video: false });
        
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        analyser = audioCtx.createAnalyser();
        analyser.fftSize = 512;
        
        microphone = audioCtx.createMediaStreamSource(stream);
        microphone.connect(analyser);
        
        processAudio();
    } catch (err) {
        console.error("Akses mikrofon ditolak atau error perangkat keras:", err);
        alert("Mic Error - Hubungi Staff / Periksa Kabel Mikrofon");
    }
}

// Looping 60fps untuk membaca frekuensi dan menggerakkan animasi CSS
function processAudio() {
    const bufferLength = analyser.frequencyBinCount;
    const dataArray = new Uint8Array(bufferLength);
    analyser.getByteTimeDomainData(dataArray);

    let sumSquares = 0.0;
    for (let i = 0; i < bufferLength; i++) {
        let norm = (dataArray[i] / 128.0) - 1.0; 
        sumSquares += (norm * norm);
    }
    
    // Konversi RMS ke satuan Desibel (dB)
    let rms = Math.sqrt(sumSquares / bufferLength);
    let db = 20 * Math.log10(rms);
    
    // Normalisasi skala dB agar mudah diolah (Silent = 0, Sangat Keras = ~100)
    let displayDb = db + 100;
    if (displayDb < 0) displayDb = 0;
    
    // Terapkan Noise Gate dari CMS
    if (displayDb < noiseGate) {
        currentDb = 0;
    } else {
        currentDb = displayDb;
    }

    // CSS Binding ke elemen DOM
    const noodle = document.getElementById('kiosk-noodle');
    const chopstick = document.getElementById('kiosk-chopstick');
    const meter = document.getElementById('ui-decibel-meter');
    
    if (noodle && chopstick && meter) {
        meter.innerText = currentDb.toFixed(1) + ' dB';
        
        let moveY = 0;
        if (currentDb > 0) {
            moveY = (currentDb - noiseGate) * 15; // Bobot multiplier pergerakan
            if (moveY < 0) moveY = 0;
            if (moveY > 800) moveY = 800; // Batas atas maksimal tarikan mie
        }
        
        noodle.style.transform = `translateX(-50%) translateY(-${moveY}px)`;
        chopstick.style.transform = `translateX(-50%) translateY(-${moveY}px)`;
    }

    animationId = requestAnimationFrame(processAudio);
}

// Memory Leak Prevention (Pilar 4)
function stopAudio() {
    if (animationId) cancelAnimationFrame(animationId);
    if (microphone) microphone.disconnect();
    if (analyser) analyser.disconnect();
    if (audioCtx && audioCtx.state !== 'closed') {
        audioCtx.close().then(() => {
            console.log("AudioContext Closed. Memory Cleared.");
        });
    }
}
<!-- end file assets/kiosk/js/audio-engine.js -->

<!-- file application/controllers/Kiosk.php -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiosk extends CI_Controller {
    public function index() {
        $this->load->helper('url');
        $this->load->view('kiosk_view');
    }
}
<!-- end file application/controllers/Kiosk.php -->

<!-- file application/controllers/Admin.php -->
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Settings_model');
        $this->load->model('Leaderboard_model');
    }

    public function index() {
        $data['page_title'] = 'Macro Dashboard Analytics';
        $data['total_players_overall'] = $this->Leaderboard_model->count_players();
        
        $locations = $this->Settings_model->get_all_locations();
        $breakdown = array();
        foreach ($locations as $loc) {
            $breakdown[] = array(
                'code' => $loc['location_code'],
                'name' => $loc['location_name'],
                'count' => $this->Leaderboard_model->count_players($loc['location_code'])
            );
        }
        $data['locations_breakdown'] = $breakdown;
        $this->load->view('admin/dashboard_view', $data);
    }

    public function add_location_process() {
        $code = $this->input->post('location_code', TRUE);
        $name = $this->input->post('location_name', TRUE);
        
        if(!empty($code) && !empty($name)) {
            $this->Settings_model->add_location($code, $name);
            $this->session->set_flashdata('success', 'Cabang Kiosk Baru Berhasil Didaftarkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal mendaftarkan lokasi, data tidak lengkap.');
        }
        redirect('admin/settings');
    }

    public function settings() {
        $selected_loc = $this->input->get('loc', TRUE);
        $data['locations'] = $this->Settings_model->get_all_locations();
        
        if (empty($selected_loc) && !empty($data['locations'])) {
            $selected_loc = $data['locations'][0]['location_code'];
        }
        
        if ($this->input->post()) {
            $loc_target = $this->input->post('location_code', TRUE);
            $this->Settings_model->update_setting($loc_target, 'timer_sec', $this->input->post('timer_sec', TRUE));
            $this->Settings_model->update_setting($loc_target, 'noise_gate_db', $this->input->post('noise_gate_db', TRUE));
            $this->Settings_model->update_setting($loc_target, 'scoring_mode', $this->input->post('scoring_mode', TRUE));
            $this->session->set_flashdata('success', 'Pengaturan Cabang ' . $loc_target . ' Berhasil Disimpan!');
            redirect('admin/settings?loc=' . $loc_target);
        }

        $data['selected_loc'] = $selected_loc;
        $data['page_title'] = 'Tenant Configuration Manager';
        $data['settings'] = $this->Settings_model->get_all_settings($selected_loc);
        $data['assets'] = $this->Settings_model->get_all_assets($selected_loc);
        $this->load->view('admin/settings_view', $data);
    }

    public function upload_asset() {
        $loc_target = $this->input->post('location_code', TRUE);
        $asset_key = $this->input->post('asset_key', TRUE);
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite']     = TRUE;
        $config['file_name']     = $loc_target . '_' . $asset_key . '_asset'; 
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('asset_file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors('',''));
        } else {
            $upload_data = $this->upload->data();
            $file_path = 'uploads/' . $upload_data['file_name'];
            $this->Settings_model->update_asset($loc_target, $asset_key, $file_path);
            $this->session->set_flashdata('success', 'Aset ' . $asset_key . ' untuk ' . $loc_target . ' Sukses Diperbarui!');
        }
        redirect('admin/settings?loc=' . $loc_target);
    }

    public function leaderboard() {
        $selected_loc = $this->input->get('loc', TRUE);
        $data['locations'] = $this->Settings_model->get_all_locations();
        $data['selected_loc'] = $selected_loc;
        $data['page_title'] = 'Leaderboard Filter Engine';
        $data['leaderboard_data'] = $this->Leaderboard_model->get_all_for_export($selected_loc);
        $this->load->view('admin/leaderboard_view', $data);
    }

    public function export_csv() {
        $selected_loc = $this->input->get('loc', TRUE);
        $suffix = (!empty($selected_loc)) ? $selected_loc : 'OVERALL';
        $filename = 'Leaderboard_Kiosk_' . $suffix . '_' . date('Ymd') . '.csv';
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: text/csv; charset=UTF-8");
        
        $file = fopen('php://output', 'w');
        fputcsv($file, array("ID", "Kode Lokasi", "Nama Lokasi", "Nama Pemain", "Peak dB", "Sustain (ms)", "Skor Akhir", "Waktu Bermain"));
        
        $leaderboard_data = $this->Leaderboard_model->get_all_for_export($selected_loc);
        foreach ($leaderboard_data as $row) {
            fputcsv($file, array(
                $row['id'],
                $row['location_code'],
                $row['location_name'],
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

    public function reset_leaderboard() {
        $selected_loc = $this->input->get('loc', TRUE);
        $this->Leaderboard_model->truncate_data($selected_loc);
        $this->session->set_flashdata('success', 'Data Papan Skor Terpilih Sukses Dikosongkan!');
        redirect('admin/leaderboard?loc=' . $selected_loc);
    }
}
<!-- end file application/controllers/Admin.php -->

<!-- file application/controllers/Api.php -->
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
<!-- end file application/controllers/Api.php -->

<!-- file application/models/Auth_model.php -->
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
<!-- end file application/models/Settings_model.php -->

<!-- file application/models/Leaderboard_model.php -->
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
            <h1 class="text-title text-bounce">LOADING ASSET...</h1>
        </section>

        <section id="state-idle" class="hidden">
            <h1 class="text-title">TOUCH THE SCREEN<br>TO PLAY!</h1>
        </section>

        <section id="state-register" class="hidden">
            <div class="form-group">
                <input type="text" id="input-player-name" maxlength="15" placeholder="Who are you?">
                <button id="btn-start-game" class="btn-primary">START</button>
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
            <h2 class="text-title">YAY! YOUR SCORE IS :</h2>
            <div id="final-score-display">0</div>
        </section>

        <section id="state-leaderboard" class="hidden">
            <h2 class="text-title">LEADERBOARD</h2>
            <div class="table-card">
                <table id="leaderboard-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Score</th>
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
                <h3 class="card-title" style="text-align: center; border: none;">Total Partisipan Kumulatif (All Locations)</h3>
                <div class="stat-number"><?= $total_players_overall; ?></div>
                <p>Total data pemain terakumulasi dari seluruh mesin aktif di lapangan.</p>
            </div>

            <div class="card">
                <h3 class="card-title">Sebaran Trafik Aktivasi Per Lokasi</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode Cabang</th>
                            <th>Nama Penempatan Event</th>
                            <th style="text-align: center;">Total Pemain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($locations_breakdown as $row): ?>
                        <tr>
                            <td><span style="background:#ffdac1; padding:5px 12px; border-radius:10px; font-weight:bold;"><?= $row['code']; ?></span></td>
                            <td><strong><?= $row['name']; ?></strong></td>
                            <td style="text-align: center; color:#ff9aa2; font-weight:bold; font-size:1.3rem;"><?= number_format($row['count']); ?> Player</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

            <div class="card" style="background-color: #f7fff7; border: 3px dashed #b5ead7;">
                <h3 class="card-title" style="color: #4a7c59;">+ Registrasi Cabang Kiosk Baru</h3>
                <form action="<?= site_url('admin/add_location_process'); ?>" method="POST" style="display:flex; gap:15px; align-items:flex-end;">
                    <div class="form-group" style="flex:1; margin:0;">
                        <label>Kode Unik Lokasi (Contoh: JKT-02)</label>
                        <input type="text" name="location_code" class="form-control" placeholder="Maks 15 Karakter" required style="padding:10px;">
                    </div>
                    <div class="form-group" style="flex:2; margin:0;">
                        <label>Nama Penempatan Event / Mall</label>
                        <input type="text" name="location_name" class="form-control" placeholder="Contoh: MALL KELAPA GADING" required style="padding:10px;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding:11px 25px; border-radius:15px;">Daftarkan</button>
                </form>
            </div>

            <div class="card" style="background-color: #fff9f5; border: 3px solid #ffdac1;">
                <label style="font-weight:bold; font-size:1.3rem; color:#ff9aa2; display:block; margin-bottom:10px;">PILIH LOKASI KIOSK YANG INGIN DIKONFIGURASI:</label>
                <select class="form-control" onchange="location = this.value;" style="font-weight:bold; color:#5d4037; border-color:#ffdac1;">
                    <?php foreach($locations as $loc): ?>
                        <option value="<?= site_url('admin/settings?loc='.$loc['location_code']); ?>" <?= ($selected_loc == $loc['location_code']) ? 'selected' : ''; ?>>
                            [<?= $loc['location_code']; ?>] <?= $loc['location_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <?php if(!empty($settings)): ?>
            <div class="card">
                <h3 class="card-title">Logika Game - Kiosk Kategori (<?= $selected_loc; ?>)</h3>
                <form action="<?= site_url('admin/settings'); ?>" method="POST">
                    <input type="hidden" name="location_code" value="<?= $selected_loc; ?>">
                    <div class="form-group">
                        <label>Durasi Permainan (Detik)</label>
                        <input type="number" name="timer_sec" class="form-control" value="<?= $settings['timer_sec']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Noise Gate (Batas Bawah Desibel)</label>
                        <input type="number" name="noise_gate_db" class="form-control" value="<?= $settings['noise_gate_db']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Scoring Mode</label>
                        <select name="scoring_mode" class="form-control" required>
                            <option value="power" <?= ($settings['scoring_mode'] == 'power') ? 'selected' : ''; ?>>Power (Desibel Tertinggi)</option>
                            <option value="endurance" <?= ($settings['scoring_mode'] == 'endurance') ? 'selected' : ''; ?>>Endurance (Durasi Kebisingan)</option>
                            <option value="hybrid" <?= ($settings['scoring_mode'] == 'hybrid') ? 'selected' : ''; ?>>Hybrid (Kalkulasi Gabungan)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">SIMPAN ATURAN CABANG</button>
                </form>
            </div>

            <div class="card">
                <h3 class="card-title">Reskin Visual Assets - Kiosk Kategori (<?= $selected_loc; ?>)</h3>
                <form action="<?= site_url('admin/upload_asset'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="location_code" value="<?= $selected_loc; ?>">
                    <div class="form-group">
                        <label>Pilih Komponen Tampilan</label>
                        <select name="asset_key" class="form-control" required>
                            <option value="bg_main">Background Game (.jpg/.png)</option>
                            <option value="client_logo">Logo Brand Klien (.png)</option>
                            <option value="prop_bowl">Gambar Mangkuk (.png transparan)</option>
                            <option value="prop_noodle">Gambar Game Mie (.png transparan)</option>
                            <option value="prop_chopstick">Gambar Sumpit (.png transparan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Grafis Baru</label>
                        <input type="file" name="asset_file" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    <button type="submit" class="btn btn-primary">PERBARUI ASET CABANG</button>
                </form>
            </div>
            <?php endif; ?>
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

            <div class="card" style="background-color: #fff9f5; border: 3px dashed #ffdac1; display:flex; justify-content:space-between; align-items:center; gap:20px;">
                <div style="flex:1;">
                    <label style="font-weight:bold; color:#5d4037; display:block; margin-bottom:5px;">Saring Klasemen Berdasarkan Lokasi:</label>
                    <select class="form-control" onchange="location = this.value;" style="font-weight:bold;">
                        <option value="<?= site_url('admin/leaderboard'); ?>">-- TAMPILKAN SEMUA CABANG (OVERALL) --</option>
                        <?php foreach($locations as $loc): ?>
                            <option value="<?= site_url('admin/leaderboard?loc='.$loc['location_code']); ?>" <?= ($selected_loc == $loc['location_code']) ? 'selected' : ''; ?>>
                                [<?= $loc['location_code']; ?>] <?= $loc['location_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; align-items:flex-end; height:100%; margin-top:23px;">
                    <a href="<?= site_url('admin/export_csv?loc='.$selected_loc); ?>" class="btn btn-primary">Unduh CSV</a>
                    <a href="<?= site_url('admin/reset_leaderboard?loc='.$selected_loc); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data klasemen terpilih?');">Reset Data</a>
                </div>
            </div>

            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Lokasi Event</th>
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
                                <td><span style="background:#e2f0cb; padding:4px 10px; border-radius:8px; font-size:0.9rem; font-weight:bold;"><?= $row['location_name']; ?></span></td>
                                <td><strong><?= htmlspecialchars($row['player_name']); ?></strong></td>
                                <td><?= $row['peak_db']; ?></td>
                                <td><?= $row['duration_ms']; ?></td>
                                <td style="color: #ff9aa2; font-weight: bold; font-size: 1.2rem;"><?= number_format($row['final_score']); ?></td>
                                <td><?= $row['created_at']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: #ff9aa2;">Belum ada record data pada lingkup ini.</td>
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