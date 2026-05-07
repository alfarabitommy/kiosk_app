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