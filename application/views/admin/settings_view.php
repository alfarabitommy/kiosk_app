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

            <div class="card">
                <h3 class="card-title">Logika & Aturan Game</h3>
                <form action="<?= site_url('admin/settings'); ?>" method="POST">
                    <div class="form-group">
                        <label>Durasi Permainan (Detik)</label>
                        <input type="number" name="timer_sec" class="form-control" value="<?= isset($settings['timer_sec']) ? $settings['timer_sec'] : 10; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Noise Gate (Batas Bawah Desibel)</label>
                        <input type="number" name="noise_gate_db" class="form-control" value="<?= isset($settings['noise_gate_db']) ? $settings['noise_gate_db'] : 40; ?>" required>
                        <small style="color: #ff9aa2;">*Suara di bawah angka ini akan diabaikan (mencegah sumpit naik karena suara latar/musik mall).</small>
                    </div>
                    <div class="form-group">
                        <label>Scoring Mode</label>
                        <select name="scoring_mode" class="form-control" required>
                            <option value="power" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'power') ? 'selected' : ''; ?>>Power (Desibel Tertinggi Saja)</option>
                            <option value="endurance" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'endurance') ? 'selected' : ''; ?>>Endurance (Durasi Terlama Berteriak)</option>
                            <option value="hybrid" <?= (isset($settings['scoring_mode']) && $settings['scoring_mode'] == 'hybrid') ? 'selected' : ''; ?>>Hybrid (Gabungan Power & Endurance)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">SIMPAN ATURAN</button>
                </form>
            </div>

            <div class="card">
                <h3 class="card-title">Reskin Assets (White-Label)</h3>
                <form action="<?= site_url('admin/upload_asset'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Pilih Aset untuk Diganti</label>
                        <select name="asset_key" class="form-control" required>
                            <option value="bg_main">Background Game (.jpg/.png)</option>
                            <option value="prop_bowl">Gambar Mangkuk (.png transparan)</option>
                            <option value="prop_noodle">Gambar Mie (.png transparan)</option>
                            <option value="prop_chopstick">Gambar Sumpit (.png transparan)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File Gambar Baru</label>
                        <input type="file" name="asset_file" class="form-control" accept=".png, .jpg, .jpeg" required>
                    </div>
                    <button type="submit" class="btn btn-primary">UPLOAD & TIMPA ASET</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>