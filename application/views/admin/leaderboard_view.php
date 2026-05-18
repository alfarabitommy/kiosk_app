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
            <a href="<?= site_url('admin/settings'); ?>">Game Settings</a>
            <a href="<?= site_url('admin/leaderboard'); ?>" class="active">Leaderboard</a>
            <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout</a>
        </div>
        
        <div class="main-content">
            <h1 class="page-title"><?= $page_title; ?></h1>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <div class="card" style="background-color: #fff9f5; border: 3px dashed #ffdac1; display:flex; justify-content:space-between; align-items:center; gap:20px;">
                <div style="flex:1;">
                    <label style="font-weight:bold; color:#5d4037; display:block; margin-bottom:5px;">Saring Klasemen Berdasarkan Lokasi:</label>
                    <select class="form-control" onchange="location = this.value;" style="font-weight:bold;">
                        <option value="<?= site_url('admin/leaderboard'); ?>">-- TAMPILKAN SEMUA CABANG (OVERALL) --</option>
                        <?php foreach($locations as $loc): ?>
                            <option value="<?= site_url('admin/leaderboard?loc='.$loc['location_code']); ?>" <?= ($selected_loc == $loc['location_code']) ? 'selected' : ''; ?>>
                                [<?= $loc['location_code']; ?>] <?= $loc['location_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; align-items:flex-end; height:100%; margin-top:23px;">
                    <a href="<?= site_url('admin/export_csv?loc='.$selected_loc); ?>" class="btn btn-primary">Unduh CSV</a>
                    <a href="<?= site_url('admin/reset_leaderboard?loc='.$selected_loc); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data klasemen terpilih?');">Reset Data</a>
                </div>
            </div>

            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Lokasi Event</th>
                            <th>Nama Pemain</th>
                            <th>Peak (dB)</th>
                            <th>Sustain (ms)</th>
                            <th>Skor Akhir</th>
                            <th>Waktu Bermain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($leaderboard_data)): ?>
                            <?php $rank = 1; foreach($leaderboard_data as $row): ?>
                            <tr>
                                <td>#<?= $rank++; ?></td>
                                <td><span style="background:#e2f0cb; padding:4px 10px; border-radius:8px; font-size:0.9rem; font-weight:bold;"><?= $row['location_name']; ?></span></td>
                                <td><strong><?= htmlspecialchars($row['player_name']); ?></strong></td>
                                <td><?= $row['peak_db']; ?></td>
                                <td><?= $row['duration_ms']; ?></td>
                                <td style="color: #ff9aa2; font-weight: bold; font-size: 1.2rem;"><?= number_format($row['final_score']); ?></td>
                                <td><?= $row['created_at']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center; color: #ff9aa2;">Belum ada record data pada lingkup ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>