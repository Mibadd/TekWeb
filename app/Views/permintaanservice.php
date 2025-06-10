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
    /* Alert Styles tetap */
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
    .alert-success { background-color: #4BB543; }
    .alert-error { background-color: #E03E2F; }

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

    /* Container & Form Styling tetap */
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
        background-color: #f8fafc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        background-color: #ffffff;
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

    .time-options, .service-options {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 10px;
    }

    .time-option, .service-option {
        border: 2px solid #ccc;
        border-radius: 10px;
        padding: 12px 16px;
        cursor: pointer;
        flex: 1 1 120px;
        text-align: center;
        transition: all 0.2s ease-in-out;
    }

    .time-option:hover, .service-option:hover {
        background-color: #f9f9f9;
    }

    .time-option.active, .service-option.active {
        border-color: #007bff;
        background-color: #e8f0fe;
    }

    /* Card Pilihan Jenis Service */
    .service-options {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .service-option {
        flex: 1;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        font-weight: 500;
        cursor: pointer;
        transition: 0.3s ease;
        background-color: #f1f5f9;
        user-select: none;
    }

    .service-option.selected {
        border-color: #3b82f6;
        background-color: #e0edff;
    }

    @media (max-width: 768px) {
        .service-container {
            padding: 1.5rem;
        }
        .service-card {
            padding: 1.5rem;
        }
        .service-options {
            flex-direction: column;
        }
    }
</style>

<script>
    window.onload = function () {
        // Alert auto hilang dan klik
        const alert = document.getElementById('alert');
        if (alert) {
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

        // Pilihan Jenis Servis
        const serviceCards = document.querySelectorAll('.service-option');
        const serviceInput = document.getElementById('service_category');

        serviceCards.forEach(card => {
            card.addEventListener('click', () => {
                serviceCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                serviceInput.value = card.getAttribute('data-value');
            });
        });

        // Pilihan Jam Servis
        const timeOptions = document.querySelectorAll('.time-option');
        const timeInput = document.getElementById('service_time');

        timeOptions.forEach(option => {
            option.addEventListener('click', () => {
                timeOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                timeInput.value = option.getAttribute('data-value');
            });
        });
    };
</script>


<div class="service-container">
    <div class="service-card">
        <div class="service-header">
            <h2>Permintaan Service</h2>
        </div>

        <form class="service-form" action="<?= base_url('/detailservice'); ?>" method="get">
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
                <label for="date">Tanggal</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Pilih Jam Servis</label>
                <input type="hidden" name="service_time" id="service_time" required>
                <div class="time-options">
                    <div class="time-option" data-value="10:00">10:00</div>
                    <div class="time-option" data-value="11:00">11:00</div>
                    <div class="time-option" data-value="12:00">12:00</div>
                    <div class="time-option" data-value="13:00">13:00</div>
                    <div class="time-option" data-value="14:00">14:00</div>
                    <div class="time-option" data-value="15:00">15:00</div>
                </div>
            </div>

            <!-- Pilihan Jenis Service -->
            <div class="form-group">
                <label>Pilih Kategori Service</label>
                <input type="hidden" name="service_category" id="service_category" required>
                <div class="service-options">
                    <div class="service-option" data-value="Reguler">🔧 Service Reguler</div>
                    <div class="service-option" data-value="Lainnya">🛠️ Service Lainnya</div>
                </div>
            </div>

            <button type="submit" class="submit-button">
                <i class="fas fa-paper-plane"></i> Ajukan Permintaan
            </button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
