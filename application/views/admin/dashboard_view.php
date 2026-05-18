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
            <a href="<?= site_url('admin'); ?>" class="active">Dashboard</a>
            <a href="<?= site_url('admin/settings'); ?>">Game Settings</a>
            <a href="<?= site_url('admin/leaderboard'); ?>">Leaderboard</a>
            <a href="<?= site_url('auth/logout'); ?>" class="logout">Logout</a>
        </div>
        
        <div class="main-content">
            <h1 class="page-title"><?= $page_title; ?></h1>
            
            <div class="card stat-box">
                <h3 class="card-title" style="text-align: center; border: none;">Total Partisipan Kumulatif (All Locations)</h3>
                <div class="stat-number"><?= $total_players_overall; ?></div>
                <p>Total data pemain terakumulasi dari seluruh mesin aktif di lapangan.</p>
            </div>

            <div class="card">
                <h3 class="card-title">Sebaran Trafik Aktivasi Per Lokasi</h3>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Kode Cabang</th>
                            <th>Nama Penempatan Event</th>
                            <th style="text-align: center;">Total Pemain</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($locations_breakdown as $row): ?>
                        <tr>
                            <td><span style="background:#ffdac1; padding:5px 12px; border-radius:10px; font-weight:bold;"><?= $row['code']; ?></span></td>
                            <td><strong><?= $row['name']; ?></strong></td>
                            <td style="text-align: center; color:#ff9aa2; font-weight:bold; font-size:1.3rem;"><?= number_format($row['count']); ?> Player</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>