<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice-Activated Noodle Game</title>
    <link rel="stylesheet" href="<?= base_url('assets/kiosk/css/style.css'); ?>">
    
    <script>
        const BASE_URL = "<?= base_url(); ?>";
    </script>
    
    <style>
        /* Desain Pastel Soft UI Khusus Modal Rahasia Admin */
        .admin-secret-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1);
            width: 800px;
            background: #ffffff;
            border: 6px solid #ffdac1;
            border-radius: 40px;
            padding: 40px;
            z-index: 9999;
            box-shadow: 0 30px 60px rgba(93, 64, 55, 0.2);
            font-family: 'Segoe UI', 'Quicksand', sans-serif;
            color: #5d4037;
        }
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(93, 64, 55, 0.4);
            backdrop-filter: blur(8px);
            z-index: 9998;
        }
        .modal-header {
            font-size: 2.2rem;
            color: #ff9aa2;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 900;
            border-bottom: 4px dashed #fff0f5;
            padding-bottom: 15px;
        }
        .modal-section {
            background: #fff6f8;
            border-radius: 25px;
            padding: 25px;
            margin-bottom: 20px;
            border: 2px solid #ffe5e5;
        }
        .modal-section h3 {
            margin-bottom: 15px;
            color: #5d4037;
            font-size: 1.4rem;
        }
        .modal-grid {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .modal-input {
            flex: 1;
            padding: 15px;
            font-size: 1.2rem;
            border: 3px solid #ffe5e5;
            border-radius: 15px;
            outline: none;
            text-align: center;
        }
        .modal-input:focus {
            border-color: #b5ead7;
        }
        .modal-btn {
            width: 100%;
            padding: 15px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #5d4037;
            background: #b5ead7;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 5px 0 #8bc34a;
            transition: all 0.1s;
        }
        .modal-btn:active {
            transform: translateY(5px);
            box-shadow: 0 0 0 transparent;
        }
        .modal-btn.btn-close {
            background: #ff9aa2;
            box-shadow: 0 5px 0 #d84315;
            color: white;
            margin-top: 10px;
        }
        
        #btn-visible-setting {
            position: absolute;
            top: 30px;
            right: 30px;
            background: #ffdac1; 
            border: 4px solid #ff9aa2; 
            border-radius: 50%;
            width: 70px;
            height: 70px;
            font-size: 2rem;
            z-index: 99999;
            cursor: pointer;
            opacity: 1; 
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); 
            transition: transform 0.2s, background 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #5d4037;
        }
        #btn-visible-setting:hover {
            transform: scale(1.1); 
            background: #ff9aa2;
        }

        /* FIX: Tambahan Style khusus untuk tombol kembali ke awal agar tidak terlalu besar */
        #btn-back-home {
            margin-top: 30px;
            font-size: 1.6rem;
            padding: 15px 50px;
            background-color: #ff9aa2;
            color: white;
            box-shadow: 0 8px 0px #d84315;
        }
        #btn-back-home:active {
            transform: translateY(8px);
            box-shadow: 0 0px 0px #d84315;
        }
    </style>
</head>
<body>

    <div id="app-container">
        <button id="btn-visible-setting">⚙️</button>
        
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
                    <tbody id="leaderboard-body"></tbody>
                </table>
            </div>
            <button id="btn-back-home" class="btn-primary">KEMBALI KE AWAL</button>
        </section>
    </div>

    <div id="secret-modal-container" class="hidden">
        <div class="modal-overlay"></div>
        <div class="admin-secret-modal">
            <div class="modal-header">KIOSK CONTROL CENTER PANEL</div>
            
            <div class="modal-section">
                <h3>1. Ekspor Data Manually (.CSV Offline)</h3>
                <div class="modal-grid">
                    <input type="date" id="export-start-date" class="modal-input">
                    <input type="date" id="export-end-date" class="modal-input">
                </div>
                <button id="btn-execute-csv-local" class="modal-btn">GENERATE & DOWNLOAD CSV</button>
            </div>

            <div class="modal-section">
                <h3>2. Sinkronisasi Database Massal (Cloud Sync Engine)</h3>
                <p style="margin-bottom:15px; font-weight:bold;">Data Belum Tersinkron: <span id="unsynced-count-display" style="color:#ff9aa2;">0</span> Entri</p>
                <button id="btn-execute-sync-cloud" class="modal-btn" style="background:#ffdac1; box-shadow: 0 5px 0 #d84315;">MULAI INTEGRASI SINKRONISASI ONLINE</button>
            </div>

            <button id="btn-close-secret-modal" class="modal-btn btn-close">TUTUP PANEL SELESAI</button>
        </div>
    </div>

    <script src="<?= base_url('assets/kiosk/js/audio-engine.js'); ?>"></script>
    <script src="<?= base_url('assets/kiosk/js/app.js'); ?>"></script>
</body>
</html>