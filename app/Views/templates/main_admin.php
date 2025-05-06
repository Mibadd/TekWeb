<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar') ?>

        <div class="main-content">
            <!-- Navbar -->
            <?= $this->include('partials/navbar') ?>

            <!-- Content -->
            <div class="content">
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Footer -->
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
</body>
</html>
