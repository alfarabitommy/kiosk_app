const API_BASE = '/kiosk/api'; // Menggunakan absolute path sesuai environment lokal

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

// Profanity Filter (Pilar 7 - Failsafe)
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
    // Anti-Right Click / Drag untuk Kiosk Mode
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('dragstart', event => event.preventDefault());
};

// Fetch API Init untuk memuat Aset Klien dan Aturan Skoring
async function fetchInitData() {
    try {
        const res = await fetch(`${API_BASE}/init`);
        const data = await res.json();
        
        if (data.status === 200) {
            appState.settings.timer_sec = parseInt(data.settings.timer_sec) || 10;
            appState.settings.noise_gate_db = parseInt(data.settings.noise_gate_db) || 40;
            
            // Injeksi Aset White-Label
            if(data.assets.bg_main) document.getElementById('kiosk-bg').src = '/kiosk/' + data.assets.bg_main;
            if(data.assets.prop_bowl) document.getElementById('kiosk-bowl').src = '/kiosk/' + data.assets.prop_bowl;
            if(data.assets.prop_noodle) document.getElementById('kiosk-noodle').src = '/kiosk/' + data.assets.prop_noodle;
            if(data.assets.prop_chopstick) document.getElementById('kiosk-chopstick').src = '/kiosk/' + data.assets.prop_chopstick;
        }
        
        setTimeout(() => {
            changeState('state-idle');
        }, 1500); 
    } catch (err) {
        console.error("Gagal memuat API Init:", err);
        alert("Koneksi Database Gagal. Cek XAMPP/Laragon.");
    }
}

// Auto-Reset Kiosk jika ditinggal pengunjung (30 Detik Failsafe)
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

// Tombol navigasi dasar
document.getElementById('state-idle').addEventListener('click', () => {
    changeState('state-register');
});

// Submit Nama dan Mulai Game
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

// Core Gameplay Loop
function startGameplay() {
    initAudioEngine(appState.settings.noise_gate_db);
    
    appState.gameInterval = setInterval(() => {
        appState.timeRemaining -= 0.1;
        document.getElementById('ui-timer').innerText = appState.timeRemaining.toFixed(1) + 's';
        
        // Tracking Kalkulasi API (Peak & Duration)
        if (currentDb > appState.playerData.peakDb) {
            appState.playerData.peakDb = currentDb;
        }
        if (currentDb > appState.settings.noise_gate_db) {
            appState.playerData.durationMs += 100; // 0.1s = 100ms
        }

        if (appState.timeRemaining <= 0) {
            clearInterval(appState.gameInterval);
            endGameplay();
        }
    }, 100);
}

// Stop Game dan Sync Data
async function endGameplay() {
    stopAudio();
    
    // Reset posisi grafis
    document.getElementById('kiosk-noodle').style.transform = `translateX(-50%) translateY(0px)`;
    document.getElementById('kiosk-chopstick').style.transform = `translateX(-50%) translateY(0px)`;
    
    try {
        const res = await fetch(`${API_BASE}/score`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                player_name: appState.playerData.name,
                peak_db: appState.playerData.peakDb,
                duration_ms: appState.playerData.durationMs
            })
        });
        const data = await res.json();
        
        if(data.status === 200) {
            document.getElementById('final-score-display').innerText = data.final_score.toLocaleString();
            changeState('state-result');
            
            // Tahan layar Result selama 4 detik sebelum pindah Leaderboard
            setTimeout(() => {
                loadLeaderboard();
            }, 4000); 
        }
    } catch (err) {
        console.error("Gagal mengirim skor:", err);
        changeState('state-idle');
    }
}

// Fetch Leaderboard
async function loadLeaderboard() {
    try {
        const res = await fetch(`${API_BASE}/top_scores`);
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
        console.error("Gagal memuat leaderboard:", err);
        changeState('state-idle');
    }
}