// File: assets/kiosk/js/app.js
// Description: State Machine Logic

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