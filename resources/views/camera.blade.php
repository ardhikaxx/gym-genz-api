<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Workout Camera Detection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --dark-primary: #AF69EE;
            --background-dark: #08030C;
            --card-background-dark: #2C123A;
            --surface-dark: #1E1E2C;
            --text-primary-dark: #FFFFFF;
            --text-secondary-dark: #C7B8D6;
            --text-hint-dark: #6D6875;
            --divider-dark: #3D3D4E;
            --error-dark: #CF6679;
            --success-dark: #81C784;
            --warning-dark: #FFB74D;
            --info-dark: #4FC3F7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-dark);
            color: var(--text-primary-dark);
            min-height: 100vh;
            padding-bottom: 30px;
        }

        .header {
            background-color: var(--surface-dark);
            padding: 20px 0;
            border-bottom: 1px solid var(--divider-dark);
            margin-bottom: 30px;
        }

        .logo {
            font-weight: 700;
            font-size: 24px;
            color: var(--dark-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .camera-section {
            background-color: var(--surface-dark);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .camera-preview {
            background-color: #000;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border: 2px solid var(--divider-dark);
        }

        .camera-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-hint-dark);
            font-size: 18px;
            padding: 30px;
            text-align: center;
            z-index: 1;
            position: relative;
        }

        .camera-placeholder i {
            font-size: 70px;
            margin-bottom: 20px;
            color: var(--dark-primary);
        }

        .camera-feed {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
            position: absolute;
            top: 0;
            left: 0;
        }

        .camera-active .camera-feed {
            display: block;
        }

        .camera-active .camera-placeholder {
            display: none;
        }

        .workout-info-section {
            background-color: var(--card-background-dark);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .workout-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .workout-card {
            background-color: var(--surface-dark);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-left: 5px solid var(--dark-primary);
        }

        .workout-card i {
            font-size: 28px;
            color: var(--dark-primary);
            margin-bottom: 12px;
        }

        .workout-card h5 {
            font-size: 14px;
            color: var(--text-secondary-dark);
            margin-bottom: 5px;
        }

        .workout-card p {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-primary-dark);
            margin: 0;
        }

        .form-label {
            color: var(--text-secondary-dark);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            background-color: var(--surface-dark);
            border: 1px solid var(--divider-dark);
            color: var(--text-primary-dark);
            padding: 12px 15px;
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--surface-dark);
            border-color: var(--dark-primary);
            color: var(--text-primary-dark);
            box-shadow: 0 0 0 0.25rem rgba(175, 105, 238, 0.25);
        }

        .counter-display {
            background-color: var(--surface-dark);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin-bottom: 25px;
            border: 1px solid var(--divider-dark);
        }

        .counter-value {
            font-size: 72px;
            font-weight: 700;
            color: var(--dark-primary);
            line-height: 1;
            margin-bottom: 10px;
        }

        .counter-label {
            font-size: 18px;
            color: var(--text-secondary-dark);
            font-weight: 500;
        }

        .status-indicator {
            background-color: var(--surface-dark);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-bottom: 25px;
            border: 1px solid var(--divider-dark);
        }

        .status-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .status-correct {
            background-color: rgba(129, 199, 132, 0.15);
            border: 5px solid var(--success-dark);
            color: var(--success-dark);
        }

        .status-incorrect {
            background-color: rgba(207, 102, 121, 0.15);
            border: 5px solid var(--error-dark);
            color: var(--error-dark);
        }

        .status-idle {
            background-color: rgba(79, 195, 247, 0.15);
            border: 5px solid var(--info-dark);
            color: var(--info-dark);
        }

        .status-label {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .status-message {
            color: var(--text-secondary-dark);
            font-size: 14px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-start {
            background-color: var(--success-dark);
            border: none;
            color: var(--background-dark);
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-start:hover {
            background-color: #6ab370;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(129, 199, 132, 0.4);
        }

        .btn-finish {
            background-color: var(--error-dark);
            border: none;
            color: var(--background-dark);
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-finish:hover {
            background-color: #c8556a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(207, 102, 121, 0.4);
        }

        .btn-secondary {
            background-color: var(--divider-dark);
            border: none;
            color: var(--text-primary-dark);
            font-weight: 600;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-secondary:hover {
            background-color: #4a4a5e;
            transform: translateY(-2px);
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: var(--text-hint-dark);
            font-size: 14px;
            padding-top: 20px;
            border-top: 1px solid var(--divider-dark);
        }

        .workout-name {
            color: var(--dark-primary);
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .workout-description {
            color: var(--text-secondary-dark);
            font-size: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .camera-preview {
                height: 300px;
            }

            .counter-value {
                font-size: 56px;
            }

            .button-container {
                flex-direction: column;
            }

            .btn-start,
            .btn-finish,
            .btn-secondary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container main-container">
        <div class="col-lg-12 mt-4">
            <div class="camera-section">
                <h4 class="mb-4">Kamera Deteksi</h4>
                <div class="camera-preview" id="cameraPreview">
                    <div class="camera-placeholder">
                        <i class="fas fa-video"></i>
                        <p>Kamera siap untuk mendeteksi gerakan workout Anda</p>
                        <p class="mt-2" style="font-size: 14px;">Pastikan tubuh Anda terlihat jelas di dalam frame</p>
                    </div>
                    <video id="cameraFeed" class="camera-feed" autoplay playsinline></video>
                </div>

                <div class="button-container">
                    <button class="btn-start" id="start-workout">
                        <i class="fas fa-play-circle"></i> Mulai Workout
                    </button>
                    <button class="btn-finish" id="finish-workout" disabled>
                        <i class="fas fa-flag-checkered"></i> Selesai Workout
                    </button>
                    <button class="btn-secondary" id="reset-workout">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Elemen DOM
        const cameraPreview = document.getElementById('cameraPreview');
        const cameraFeed = document.getElementById('cameraFeed');
        const startWorkoutBtn = document.getElementById('start-workout');
        const finishWorkoutBtn = document.getElementById('finish-workout');
        const resetWorkoutBtn = document.getElementById('reset-workout');
        
        // Status kamera
        let cameraStream = null;
        let isCameraActive = false;
        
        // Fungsi untuk memulai kamera
        async function startCamera() {
            try {
                // Meminta akses ke kamera
                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'user', // Gunakan kamera depan
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                });
                
                // Menampilkan stream kamera di elemen video
                cameraFeed.srcObject = cameraStream;
                
                // Mengaktifkan tampilan kamera
                cameraPreview.classList.add('camera-active');
                isCameraActive = true;
                
                // Mengupdate status tombol
                startWorkoutBtn.disabled = true;
                startWorkoutBtn.innerHTML = '<i class="fas fa-video"></i> Kamera Aktif';
                startWorkoutBtn.classList.remove('btn-start');
                startWorkoutBtn.classList.add('btn-secondary');
                
                finishWorkoutBtn.disabled = false;
                
                console.log('Kamera berhasil diaktifkan');
            } catch (error) {
                console.error('Error mengakses kamera:', error);
                alert('Tidak dapat mengakses kamera. Pastikan Anda memberikan izin akses kamera.');
            }
        }
        
        // Fungsi untuk menghentikan kamera
        function stopCamera() {
            if (cameraStream) {
                // Menghentikan semua track kamera
                cameraStream.getTracks().forEach(track => {
                    track.stop();
                });
                
                cameraStream = null;
            }
            
            // Menonaktifkan tampilan kamera
            cameraPreview.classList.remove('camera-active');
            isCameraActive = false;
            
            // Mengupdate status tombol
            startWorkoutBtn.disabled = false;
            startWorkoutBtn.innerHTML = '<i class="fas fa-play-circle"></i> Mulai Workout';
            startWorkoutBtn.classList.remove('btn-secondary');
            startWorkoutBtn.classList.add('btn-start');
            
            finishWorkoutBtn.disabled = true;
            
            console.log('Kamera dihentikan');
        }
        
        // Fungsi untuk mereset workout
        function resetWorkout() {
            stopCamera();
            
            // Reset semua status
            cameraPreview.classList.remove('camera-active');
            isCameraActive = false;
            
            console.log('Workout direset');
        }
        
        // Event listeners untuk tombol
        startWorkoutBtn.addEventListener('click', startCamera);
        
        finishWorkoutBtn.addEventListener('click', function() {
            if (isCameraActive) {
                alert('Workout selesai! Kamera akan dimatikan.');
                stopCamera();
            }
        });
        
        resetWorkoutBtn.addEventListener('click', resetWorkout);
        
        // Membersihkan kamera saat halaman ditutup
        window.addEventListener('beforeunload', function() {
            if (cameraStream) {
                cameraStream.getTracks().forEach(track => {
                    track.stop();
                });
            }
        });
    </script>
</body>

</html>