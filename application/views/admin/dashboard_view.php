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
                <h3 class="card-title" style="text-align: center; border: none;">Total Pemain (All Time)</h3>
                <div class="stat-number"><?= $total_players; ?></div>
                <p>Peserta telah berpartisipasi dalam interaksi Kiosk.</p>
            </div>
        </div>
    </div>
</body>
</html>