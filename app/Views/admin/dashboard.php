<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<!-- Impor Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #3498db;
        --secondary-color: #2ecc71;
        --danger-color: #e74c3c;
        --light-gray: #f0f3f5;
        --dark-gray: #475569;
        --text-color: #333;
        --card-bg: #ffffff;
    }

    .content-wrapper {
        padding: 1.5rem;
    }

    .profile-header-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid var(--primary-color);
        padding: 5px;
        background: white;
    }

    .profile-info h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-color);
        margin: 0 0 0.25rem 0;
    }

    .profile-info p {
        font-size: 1rem;
        color: var(--dark-gray);
        margin: 0;
    }

    .vehicle-info {
        margin-left: auto;
        text-align: right;
        padding-left: 1.5rem;
        border-left: 1px solid var(--light-gray);
    }
    
    .vehicle-info .title {
        color: var(--dark-gray);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }

    .vehicle-info .value {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .service-summary-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .summary-card .icon {
        font-size: 2rem;
        padding: 1rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .icon.last-service {
        background-color: #e8f5e9; /* Light green */
        color: var(--secondary-color);
    }

    .icon.next-service {
        background-color: #e3f2fd; /* Light blue */
        color: var(--primary-color);
    }
    
    .summary-card .details .title {
        color: var(--dark-gray);
        font-size: 0.9rem;
    }

    .summary-card .details .date {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-color);
    }

    .service-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .list-card {
        background-color: var(--card-bg);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    .list-card .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--light-gray);
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-color);
    }
    
    .list-card .section-link {
        font-size: 0.85rem;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }
    
    .list-card ul {
        list-style-type: none;
        padding-left: 0;
        margin: 0;
    }

    .list-card li {
        padding: 0.75rem 0.25rem;
        color: var(--dark-gray);
        border-bottom: 1px solid var(--light-gray);
        display: flex;
        align-items: center;
    }
    
    .list-card li:last-child {
        border-bottom: none;
    }
    
    .list-card li .list-icon {
        margin-right: 1rem;
        font-size: 1rem;
    }

    .list-icon.history-icon { color: var(--secondary-color); }
    .list-icon.schedule-icon { color: var(--primary-color); }
    
    @media (max-width: 992px) {
        .profile-header-card {
            flex-direction: column;
            text-align: center;
        }
        .vehicle-info {
            margin-left: 0;
            text-align: center;
            border-left: none;
            padding-left: 0;
            margin-top: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .service-summary-grid, .service-grid {
            grid-template-columns: 1fr;
        }
        .profile-img {
            width: 100px;
            height: 100px;
        }
    }
</style>

<div class="content-wrapper">
    <!-- Kartu Profil Header -->
    <div class="profile-header-card">
        <img src="<?= base_url('image/' . (!empty($user['photo']) ? $user['photo'] : 'nmax.jpg')); ?>" alt="Foto Profil" class="profile-img">
        <div class="profile-info">
            <h1><?= esc($user['name']); ?></h1>
            <p>Selamat datang di dasbor kendaraan Anda.</p>
        </div>
        <div class="vehicle-info">
            <div class="title"><i class="fas fa-motorcycle"></i> Kendaraan Anda</div>
            <div class="value"><?= esc($user['vehicle'] ?? 'Belum diatur'); ?></div>
        </div>
    </div>

    <!-- Ringkasan Jadwal Service -->
    <div class="service-summary-grid">
        <div class="summary-card">
            <div class="icon last-service"><i class="fas fa-history"></i></div>
            <div class="details">
                <div class="title">Servis Terakhir</div>
                <div class="date"><?= !empty($history) ? date('d F Y', strtotime($history[0]['tanggal'])) : 'Belum ada data'; ?></div>
            </div>
        </div>
        <div class="summary-card">
            <div class="icon next-service"><i class="fas fa-calendar-alt"></i></div>
            <div class="details">
                <div class="title">Servis Selanjutnya</div>
                <div class="date"><?= !empty($schedules) ? date('d F Y', strtotime($schedules[0]['tanggal'])) : 'Belum ada jadwal'; ?></div>
            </div>
        </div>
    </div>

    <!-- Daftar Riwayat dan Jadwal -->
    <div class="service-grid">
        <div class="list-card">
            <div class="section-title">
                <span>Riwayat Perawatan</span>
                <a href="<?= base_url('riwayatperawatan'); ?>" class="section-link">Lihat Semua</a>
            </div>
            <ul>
                <?php if (!empty($history)): ?>
                    <?php foreach ($history as $item): ?>
                        <li>
                            <i class="fas fa-check-circle list-icon history-icon"></i>
                            <?= esc(date('d M Y', strtotime($item['tanggal']))) ?> - <?= esc($item['jenis_servis']) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Tidak ada riwayat perawatan.</li>
                <?php endif; ?>
            </ul>
        </div>
        
        <div class="list-card">
            <div class="section-title">
                <span>Jadwal Akan Datang</span>
                <a href="<?= base_url('jadwalservice'); ?>" class="section-link">Lihat Semua</a>
            </div>
            <ul>
                <?php if (!empty($schedules)): ?>
                    <?php foreach ($schedules as $schedule): ?>
                        <li>
                            <i class="fas fa-clock list-icon schedule-icon"></i>
                            <?= esc(date('d M Y', strtotime($schedule['tanggal']))) ?> - <?= esc($schedule['jenis_servis']) ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Tidak ada jadwal baru.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
