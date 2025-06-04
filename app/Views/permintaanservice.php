<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<?php if(session()->getFlashdata('success')): ?>
    <div id="alert" class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div id="alert" class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<style>
    .alert {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 30px;
        color: white;
        font-weight: 600;
        border-radius: 5px;
        z-index: 9999;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        opacity: 0.95;
        animation: slideDown 0.5s ease forwards;
        cursor: pointer;
    }
    .alert-success {
        background-color: #4BB543;
    }
    .alert-error {
        background-color: #E03E2F;
    }
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(-50px);
        }
        to {
            opacity: 0.95;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* New Improved Styles */
    .service-container {
        padding: 2rem;
        display: flex;
        justify-content: center;
        background-color: #f8fafc;
    }
    
    .service-card {
        background: #ffffff;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 600px;
        border: 1px solid #e2e8f0;
    }
    
    .service-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .service-header h2 {
        margin: 0;
        color: #1e293b;
        font-size: 1.75rem;
        font-weight: 600;
        position: relative;
        display: inline-block;
    }
    
    .service-header h2::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #3b82f6;
        border-radius: 3px;
    }
    
    .service-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .form-group {
        position: relative;
    }
    
    label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #475569;
        font-size: 0.95rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }
    
    .form-control:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        background-color: #ffffff;
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
    }
    
    .submit-button {
        background-color: #3b82f6;
        color: white;
        border: none;
        padding: 0.875rem;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 500;
        width: 100%;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .submit-button:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
    }
    
    .submit-button:active {
        transform: translateY(0);
    }
    
    optgroup {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }
    
    optgroup option {
        font-weight: 400;
        padding: 0.5rem 1rem;
        border-bottom: 1px solid #f1f5f9;
    }
    
    @media (max-width: 768px) {
        .service-container {
            padding: 1.5rem;
        }
        
        .service-card {
            padding: 1.5rem;
        }
    }
</style>

<script>
    window.onload = function() {
        const alert = document.getElementById('alert');
        if(alert){
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 3000);

            alert.addEventListener('click', () => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }
    }
</script>

<div class="service-container">
    <div class="service-card">
        <div class="service-header">
            <h2>Permintaan Service</h2>
        </div>

        <form class="service-form" action="<?= base_url('/permintaanservice/store'); ?>" method="post">
            <div class="form-group">
                <label for="vehicle">Pilih Kendaraan</label>
                <select id="vehicle" name="vehicle" class="form-control" required>
                    <option value="">-- Pilih Kendaraan --</option>
                    <option value="XMAX 250">XMAX 250</option>
                    <option value="Grand Filano">Grand Filano</option>
                    <option value="XSR 155">XSR 155</option>
                    <option value="Vixion 155">Vixion 155</option>
                    <option value="Gear Ultima">Gear Ultima</option>
                </select>
            </div>

            <div class="form-group">
                <label for="service_type">Jenis Service</label>
                <select id="service_type" name="service_type" class="form-control" required>
                    <option value="">-- Pilih Jenis Service --</option>
                    <optgroup label="Service Rutin">
                        <option value="Service Rutin 1000 km">Service Rutin 1000 km</option>
                        <option value="Service Rutin 4000 km">Service Rutin 4000 km</option>
                        <option value="Service Rutin 8000 km">Service Rutin 8000 km</option>
                    </optgroup>
                    <optgroup label="Perawatan Mesin">
                        <option value="Ganti Oli Mesin">Ganti Oli Mesin</option>
                        <option value="Ganti Filter Oli">Ganti Filter Oli</option>
                        <option value="Ganti Busi">Ganti Busi</option>
                        <option value="Perbaikan Mesin">Perbaikan Mesin</option>
                        <option value="Pembersihan Karburator">Pembersihan Karburator</option>
                        <option value="Pemeriksaan Radiator">Pemeriksaan Radiator</option>
                    </optgroup>
                    <optgroup label="Sistem Pengereman">
                        <option value="Ganti Kampas Rem">Ganti Kampas Rem</option>
                        <option value="Ganti Cakram Rem">Ganti Cakram Rem</option>
                        <option value="Ganti Minyak Rem">Ganti Minyak Rem</option>
                        <option value="Pemeriksaan Sistem Rem">Pemeriksaan Sistem Rem</option>
                    </optgroup>
                    <optgroup label="Sistem Transmisi">
                        <option value="Ganti Oli Transmisi">Ganti Oli Transmisi</option>
                        <option value="Ganti Kampas Kopling">Ganti Kampas Kopling</option>
                        <option value="Perbaikan Transmisi">Perbaikan Transmisi</option>
                    </optgroup>
                    <optgroup label="Sistem Suspensi">
                        <option value="Ganti Shock Absorber">Ganti Shock Absorber</option>
                        <option value="Perbaikan Suspensi">Perbaikan Suspensi</option>
                    </optgroup>
                    <optgroup label="Kelistrikan">
                        <option value="Perbaikan Sistem Pengapian">Perbaikan Sistem Pengapian</option>
                        <option value="Ganti Aki">Ganti Aki</option>
                        <option value="Perbaikan Lampu">Perbaikan Lampu</option>
                    </optgroup>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <button type="submit" class="submit-button">
                <i class="fas fa-paper-plane"></i> Ajukan Permintaan
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>