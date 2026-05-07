<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/admin_style.css'); ?>">
</head>
<body>
    <div class="login-container">
        <div class="card" style="width: 400px;">
            <h2 class="page-title" style="text-align: center; margin-bottom: 10px;">CMS System</h2>
            <p style="text-align: center; margin-bottom: 30px; font-weight: bold;">Authorized Personnel Only</p>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login_process'); ?>" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>