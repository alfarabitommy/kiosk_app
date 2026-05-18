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