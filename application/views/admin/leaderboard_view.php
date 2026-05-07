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

            <div style="margin-bottom: 20px; display: flex; gap: 15px;">
                <a href="<?= site_url('admin/export_csv'); ?>" class="btn btn-primary">Download CSV (.csv)</a>
                <a href="<?= site_url('admin/reset_leaderboard'); ?>" class="btn btn-danger" onclick="return confirm('PERINGATAN: Semua data skor akan dihapus permanen. Lanjutkan?');">Reset/Hapus Semua Data</a>
            </div>

            <div class="card">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rank</th>
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
                                <td><strong><?= htmlspecialchars($row['player_name']); ?></strong></td>
                                <td><?= $row['peak_db']; ?></td>
                                <td><?= $row['duration_ms']; ?></td>
                                <td style="color: #b5ead7; font-weight: bold; font-size: 1.2rem;"><?= number_format($row['final_score']); ?></td>
                                <td><?= $row['created_at']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; color: #ff9aa2;">Belum ada data pemain.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>