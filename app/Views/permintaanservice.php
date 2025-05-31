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
        background-color: #4BB543; /* hijau */
    }
    .alert-error {
        background-color: #E03E2F; /* merah */
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
</style>

<script>
    // Hilangkan alert otomatis setelah 3 detik
    window.onload = function() {
        const alert = document.getElementById('alert');
        if(alert){
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 3000);

            // Klik alert untuk tutup manual
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
                <select id="vehicle" name="vehicle" class="form-control">
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
                <select id="service_type" name="service_type" class="form-control">
                    <option value="">-- Pilih Jenis Service --</option>
                    <option value="service rutin">Service Rutin</option>
                    <option value="ganti oli">Ganti Oli</option>
                    <option value="perbaikan mesin">Perbaikan Mesin</option>
                    <option value="pemeriksaan rem">Pemeriksaan Rem</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" id="date" name="date" class="form-control">
            </div>

            <div class="form-group">
                <label for="notes">Catatan Tambahan</label>
                <textarea id="notes" name="notes" class="form-control" placeholder="Tambahkan catatan..."></textarea>
            </div>

            <button type="submit" class="submit-button">
                <i class="fas fa-paper-plane"></i> Ajukan Permintaan
            </button>
        </form>
    </div>
</div>

<style>
    /* Base Styles */
    .service-container {
        padding: 20px;
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background-color: #f5f5f5;
    }
    
    .service-card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        margin: 20px 0;
    }
    
    .service-header {
        text-align: center;
        margin-bottom: 25px;
    }
    
    .service-header h2 {
        margin: 0;
        color: #333;
        font-size: 24px;
    }
    
    .service-form {
        display: flex;
        flex-direction: column;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color:rgb(28, 124, 214);
        outline: none;
        box-shadow: 0 0 0 3px rgba(214, 28, 31, 0.1);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .submit-button {
        background-color: #007BFF; /* merah */
        color: white;
        border: none;
        padding: 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        width: 100%;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .submit-button:hover {
        background-color: #007BFF; /* merah muda saat hover */
    }

    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .service-container {
            padding: 15px;
            align-items: center;
        }
        
        .service-card {
            padding: 20px;
            margin: 10px 0;
        }
        
        .service-header h2 {
            font-size: 20px;
        }
        
        .form-control {
            padding: 10px 12px;
        }
    }
    
    @media (max-width: 480px) {
        .service-card {
            padding: 15px;
            border-radius: 8px;
        }
        
        .service-header {
            margin-bottom: 15px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .submit-button {
            padding: 12px;
            font-size: 15px;
        }
    }
</style>

<?= $this->endSection(); ?>