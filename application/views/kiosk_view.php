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
            <h1 class="text-neon">LOADING ASSETS...</h1>
        </section>

        <section id="state-idle" class="hidden">
            <h1 class="text-neon">SENTUH LAYAR UNTUK BERMAIN</h1>
        </section>

        <section id="state-register" class="hidden">
            <div class="form-group">
                <input type="text" id="input-player-name" maxlength="15" placeholder="Masukkan Nama Anda">
                <button id="btn-start-game" class="btn-primary">MULAI</button>
            </div>
            <div id="keyboard-container"></div>
        </section>

        <section id="state-game" class="hidden">
            <img id="kiosk-bg" src="" alt="">
            <img id="kiosk-bowl" src="" alt="">
            <img id="kiosk-noodle" src="" alt="">
            <img id="kiosk-chopstick" src="" alt="">
            
            <div id="ui-hud">
                <div id="ui-timer">10.0</div>
                <div id="ui-decibel-meter">0 dB</div>
            </div>
        </section>

        <section id="state-result" class="hidden">
            <h2 class="text-neon">SKOR ANDA</h2>
            <div id="final-score-display">0</div>
        </section>

        <section id="state-leaderboard" class="hidden">
            <h2 class="text-neon">LEADERBOARD</h2>
            <table id="leaderboard-table">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Nama</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody id="leaderboard-body">
                    </tbody>
            </table>
        </section>

    </div>

    <script src="<?= base_url('assets/kiosk/js/audio-engine.js'); ?>"></script>
    <script src="<?= base_url('assets/kiosk/js/app.js'); ?>"></script>
</body>
</html>