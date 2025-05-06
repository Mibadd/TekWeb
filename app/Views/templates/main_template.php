<!-- app/Views/templates/main_template.php -->
<?= $this->include('templates/header'); ?>
<div class="container">
    <?= $this->include('templates/sidebar'); ?>
    <div class="main-content">
        <?= $this->renderSection('content'); ?> <!-- Tempat konten halaman akan dimasukkan -->
    </div>
</div>
<?= $this->include('templates/footer'); ?>
