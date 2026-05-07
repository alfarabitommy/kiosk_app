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