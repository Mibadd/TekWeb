<!-- app/Views/templates/sidebar.php -->
<div class="sidebar">
    <div class="logo">GOODBIKE</div>
    <a href="<?= base_url('dashboard'); ?>" class="menu-item">Dashboard</a>
    <a href="<?= base_url('permintaanservice'); ?>" class="menu-item">Permintaan Service</a>
    <a href="<?= base_url('jadwalservice'); ?>" class="menu-item">Jadwal Service</a>
    <a href="<?= base_url('riwayatperawatan'); ?>" class="menu-item">Riwayat Perawatan</a>
    <div style="margin-top: 10px;"></div>
    <a href="<?= base_url('payment'); ?>" class="menu-item">Pembayaran</a>
    <a href="<?= base_url('akun'); ?>" class="menu-item">Akun</a>
    <a href="<?= base_url('auth/logout'); ?>" class="logout-btn">Logout</a>
</div>
