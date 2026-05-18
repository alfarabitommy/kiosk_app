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