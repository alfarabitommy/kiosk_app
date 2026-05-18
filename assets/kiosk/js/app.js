// File: assets/kiosk/js/app.js

const urlParams = new URLSearchParams(window.location.search);
const LOCATION_CODE = urlParams.get('loc') || 'JKT-01';

const API_BASE = '/api'; 

const appState = {
    currentState: 'state-boot',
    settings: {
        timer_sec: 10,
        noise_gate_db: 40,
        scoring_mode: 'hybrid' 
    },
    playerData: {
        name: '',
        peakDb: 0,
        durationMs: 0
    },
    gameInterval: null,
    timeRemaining: 0,
    idleTimeout: null,
    isOnline: true 
};

const bannedWords = ['anjing', 'babi', 'bangsat', 'kontol', 'memek', 'jancok'];

let localDb;
const dbRequest = indexedDB.open('KioskLocalStorageDB', 1);

dbRequest.onupgradeneeded = (e) => {
    localDb = e.target.result;
    if (!localDb.objectStoreNames.contains('local_scores')) {
        const store = localDb.createObjectStore('local_scores', { keyPath: 'id', autoIncrement: true });
        store.createIndex('location_code', 'location_code', { unique: false });
        store.createIndex('is_synced', 'is_synced', { unique: false });
        store.createIndex('created_at', 'created_at', { unique: false });
    }
};

dbRequest.onsuccess = (e) => {
    localDb = e.target.result;
    console.log("IndexedDB Offline System Terinisialisasi.");
};

dbRequest.onerror = () => {
    console.error("Gagal mengaktifkan database lokal IndexedDB.");
};

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
    setupAdminControls();
};

async function fetchInitData() {
    try {
        const res = await fetch(`${API_BASE}/init?loc=${LOCATION_CODE}`);
        const data = await res.json();
        
        if (data.status === 200) {
            appState.isOnline = true;
            appState.settings.timer_sec = parseInt(data.settings.timer_sec) || 10;
            appState.settings.noise_gate_db = parseInt(data.settings.noise_gate_db) || 40;
            appState.settings.scoring_mode = data.settings.scoring_mode || 'hybrid';
            
            if(data.assets.bg_main) document.getElementById('kiosk-bg').src = '/' + data.assets.bg_main;
            if(data.assets.prop_bowl) document.getElementById('kiosk-bowl').src = '/' + data.assets.prop_bowl;
            if(data.assets.prop_noodle) document.getElementById('kiosk-noodle').src = '/' + data.assets.prop_noodle;
            if(data.assets.prop_chopstick) document.getElementById('kiosk-chopstick').src = '/' + data.assets.prop_chopstick;
        }
        setTimeout(() => { changeState('state-idle'); }, 1500); 
    } catch (err) {
        console.warn("Kiosk Berjalan dalam Mode Offline (Failsafe Terbuka).");
        appState.isOnline = false;
        
        document.getElementById('kiosk-bg').src = BASE_URL + 'assets/kiosk/img/bg_fallback.jpg';
        document.getElementById('kiosk-bowl').src = BASE_URL + 'assets/kiosk/img/bowl_fallback.png';
        document.getElementById('kiosk-noodle').src = BASE_URL + 'assets/kiosk/img/noodle_fallback.png';
        document.getElementById('kiosk-chopstick').src = BASE_URL + 'assets/kiosk/img/chopstick_fallback.png';
        
        setTimeout(() => { changeState('state-idle'); }, 1500);
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

// FIX: Event Listener untuk mengembalikan ke halaman awal dari layar Leaderboard
document.getElementById('btn-back-home').addEventListener('click', () => {
    changeState('state-idle');
    document.getElementById('input-player-name').value = '';
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
    
    let calculatedScore = 0;
    const mode = appState.settings.scoring_mode;
    if (mode === 'power') {
        calculatedScore = Math.floor(appState.playerData.peakDb * 100);
    } else if (mode === 'endurance') {
        calculatedScore = Math.floor(appState.playerData.durationMs * 1);
    } else {
        calculatedScore = Math.floor((appState.playerData.peakDb * 100) + (appState.playerData.durationMs * 1));
    }

    const timestampIso = new Date().toISOString().slice(0, 19).replace('T', ' ');

    const scoreObject = {
        location_code: LOCATION_CODE,
        player_name: appState.playerData.name,
        peak_db: appState.playerData.peakDb,
        duration_ms: appState.playerData.durationMs,
        final_score: calculatedScore,
        created_at: timestampIso,
        is_synced: 0
    };

    const transaction = localDb.transaction(['local_scores'], 'readwrite');
    const store = transaction.objectStore(['local_scores']);
    store.add(scoreObject);

    document.getElementById('final-score-display').innerText = calculatedScore.toLocaleString();
    changeState('state-result');

    if (appState.isOnline) {
        try {
            const res = await fetch(`${API_BASE}/score`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(scoreObject)
            });
            const data = await res.json();
            if (data.status === 200) {
                const updTransaction = localDb.transaction(['local_scores'], 'readwrite');
                const updStore = updTransaction.objectStore('local_scores');
                scoreObject.is_synced = 1;
                updStore.put(scoreObject);
            }
        } catch (err) {
            appState.isOnline = false; 
        }
    }

    setTimeout(() => { loadLeaderboard(); }, 4000); 
}

async function loadLeaderboard() {
    const tbody = document.getElementById('leaderboard-body');
    tbody.innerHTML = '';

    if (appState.isOnline) {
        try {
            const res = await fetch(`${API_BASE}/top_scores?loc=${LOCATION_CODE}`);
            const data = await res.json();
            if(data.status === 200 && data.data.length > 0) {
                data.data.forEach((row, index) => {
                    tbody.innerHTML += `<tr><td>#${index + 1}</td><td>${row.player_name}</td><td style="color:#ff9aa2;">${parseInt(row.final_score).toLocaleString()}</td></tr>`;
                });
                changeState('state-leaderboard');
                document.getElementById('input-player-name').value = '';
                return;
            }
        } catch (err) {
            appState.isOnline = false;
        }
    }

    const transaction = localDb.transaction(['local_scores'], 'readonly');
    const store = transaction.objectStore('local_scores');
    const request = store.openCursor();
    let localRecords = [];

    request.onsuccess = (e) => {
        const cursor = e.target.result;
        if (cursor) {
            if (cursor.value.location_code === LOCATION_CODE) {
                localRecords.push(cursor.value);
            }
            cursor.continue();
        } else {
            localRecords.sort((a, b) => b.final_score - a.final_score);
            const top10Local = localRecords.slice(0, 10);

            if (top10Local.length > 0) {
                top10Local.forEach((row, index) => {
                    tbody.innerHTML += `<tr><td>#${index + 1}</td><td>${row.player_name}</td><td style="color:#ff9aa2;">${row.final_score.toLocaleString()}</td></tr>`;
                });
            } else {
                tbody.innerHTML = `<tr><td colspan="3">Belum ada skor.</td></tr>`;
            }
            changeState('state-leaderboard');
            document.getElementById('input-player-name').value = '';
        }
    };
}

// =========================================================================
// SISTEM KONTROL GESTURE & MENU RAHASIA ADMIN
// =========================================================================

function setupAdminControls() {
    document.getElementById('btn-visible-setting').addEventListener('click', () => {
        const pinInput = prompt("Masukkan PIN Keamanan Otoritas Kiosk:");
        if (pinInput === "2026") {
            openSecretAdminPanel();
        } else if (pinInput !== null) {
            alert("PIN Salah. Akses Ditolak!");
        }
    });

    document.getElementById('btn-close-secret-modal').addEventListener('click', () => {
        document.getElementById('secret-modal-container').classList.add('hidden');
    });

    document.getElementById('btn-execute-csv-local').addEventListener('click', () => {
        const start = document.getElementById('export-start-date').value;
        const end = document.getElementById('export-end-date').value;

        if (!start || !end) {
            alert("Harap tentukan rentang tanggal ekspor data.");
            return;
        }

        const transaction = localDb.transaction(['local_scores'], 'readonly');
        const store = transaction.objectStore('local_scores');
        const request = store.openCursor();
        let csvContent = "ID,Kode Lokasi,Nama Pemain,Peak dB,Sustain ms,Skor Akhir,Waktu Bermain\n";
        let matchCount = 0;

        request.onsuccess = (e) => {
            const cursor = e.target.result;
            if (cursor) {
                const itemDate = cursor.value.created_at.split(' ')[0];
                if (cursor.value.location_code === LOCATION_CODE && itemDate >= start && itemDate <= end) {
                    csvContent += `${cursor.value.id},${cursor.value.location_code},${cursor.value.player_name},${cursor.value.peak_db},${cursor.value.duration_ms},${cursor.value.final_score},${cursor.value.created_at}\n`;
                    matchCount++;
                }
                cursor.continue();
            } else {
                if (matchCount === 0) {
                    alert("Tidak ditemukan rekaman data pada rentang tanggal tersebut.");
                    return;
                }
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.setAttribute("download", `Offline_Report_Kiosk_${LOCATION_CODE}_${start}_to_${end}.csv`);
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        };
    });

    document.getElementById('btn-execute-sync-cloud').addEventListener('click', async () => {
        const transaction = localDb.transaction(['local_scores'], 'readonly');
        const store = transaction.objectStore('local_scores');
        const request = store.openCursor();
        let unSyncedRecords = [];

        request.onsuccess = async (e) => {
            const cursor = e.target.result;
            if (cursor) {
                if (cursor.value.is_synced === 0) {
                    unSyncedRecords.push(cursor.value);
                }
                cursor.continue();
            } else {
                if (unSyncedRecords.length === 0) {
                    alert("Seluruh data lokal Kiosk sudah tersinkronisasi sempurna dengan server Cloud.");
                    return;
                }

                try {
                    const syncBtn = document.getElementById('btn-execute-sync-cloud');
                    syncBtn.innerText = "SEDANG MENGIRIM DATA MASSAL...";
                    syncBtn.disabled = true;

                    const response = await fetch(`${API_BASE}/sync_batch`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ scores: unSyncedRecords })
                    });
                    const result = await response.json();

                    if (result.status === 200) {
                        const writeTransaction = localDb.transaction(['local_scores'], 'readwrite');
                        const writeStore = writeTransaction.objectStore('local_scores');
                        
                        for (let item of unSyncedRecords) {
                            item.is_synced = 1;
                            writeStore.put(item);
                        }

                        alert(`Sinkronisasi Berhasil! ${result.synced_count} data pameran ditransfer ke cloud server.`);
                        appState.isOnline = true;
                        openSecretAdminPanel(); 
                    }
                } catch (err) {
                    alert("Koneksi internet gagal. Harap periksa tethering hotspot Anda.");
                } finally {
                    const syncBtn = document.getElementById('btn-execute-sync-cloud');
                    syncBtn.innerText = "MULAI INTEGRASI SINKRONISASI ONLINE";
                    syncBtn.disabled = false;
                }
            }
        };
    });
}

function openSecretAdminPanel() {
    const transaction = localDb.transaction(['local_scores'], 'readonly');
    const store = transaction.objectStore('local_scores');
    const request = store.openCursor();
    let unsyncedCount = 0;

    request.onsuccess = (e) => {
        const cursor = e.target.result;
        if (cursor) {
            if (cursor.value.is_synced === 0) unsyncedCount++;
            cursor.continue();
        } else {
            document.getElementById('unsynced-count-display').innerText = unsyncedCount;
            document.getElementById('secret-modal-container').classList.remove('hidden');
        }
    };
}