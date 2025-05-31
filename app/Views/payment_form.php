<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: Arial, sans-serif; 
        }

        .payment-card {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .payment-card h2 { 
            font-size: 22px;
            text-align: center;
            margin-bottom: 15px;
        }

         .payment-card h5 { font-size: 18px; font-weight: 600; margin-bottom: 15px; }

        .payment-card .card { 
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }

        .payment-summary { 
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        .mb-3 { margin-bottom: 20px; }

        .mb-3 > label { 
            display: block;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 16px;
            color: #333;
        }

        .mb-3 > div {
            padding-left: 10px; /* agar radio buttons agak masuk ke dalam */
        }

        .mb-3 label > input[type="radio"] {
            margin-right: 8px; /* jarak antara tombol radio dan teks */
            vertical-align: middle;
            cursor: pointer;
        }

        .mb-3 label {
            display: block;  /* setiap label di baris baru */
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }

        .fw-bold { 
            font-weight: 700; 
            color: #007bff; 
            font-size: 16px; 
            text-align: right; 
        }

        .form-control { 
            border: 1px solid #ced4da; 
            border-radius: 5px;
            padding: 8px 12px;
            width: 100%;
            background-color: #fff;
        }

        .btn-success { 
            width: 100%;
            color: #fff;
            background-color: #007bff;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
        }

        .btn-success:hover { background-color: #0056b3; }

        .payment-history-link { 
            display: block;
            text-align: center;
            margin-top: 12px;
            color: #fff;
            background-color: #007bff;
            padding: 10px 0;
            border-radius: 5px;
        }

        .payment-history-link:hover { background-color: #0056b3; }

    </style>
</head>
<body>

<div class="payment-card">
    <h2>Pembayaran Service</h2>
    <form action="<?= base_url('/payment/process'); ?>" method="post" enctype="multipart/form-data">
        <div class="card">
            <h5>Ringkasan Tagihan</h5>
            <div class="payment-summary"><span>Ganti Oli Mesin</span><span>Rp 75.000</span></div>
            <div class="payment-summary"><span>Service Ringan</span><span>Rp 100.000</span></div>
            <div class="payment-summary"><span>Filter Udara Baru</span><span>Rp 35.000</span></div>
            <hr>
            <div class="payment-summary fw-bold"><span>Total</span><span>Rp 210.000</span></div>
            <input type="hidden" name="total_amount" value="210000">
        </div>

        <div class="mb-3">
            <label>Pilih Metode Pembayaran</label>
            <div>
                <label><input type="radio" name="payment_method" value="Transfer Bank" required> Transfer Bank (BCA, BRI, Mandiri)</label><br>
                <label><input type="radio" name="payment_method" value="E-Wallet"> E-Wallet (OVO, Dana, GoPay)</label><br>
                <label><input type="radio" name="payment_method" value="Bayar di Tempat"> Bayar di Tempat (Tunai)</label>
            </div>
        </div>

        <div class="mb-3">
            <label>Upload Bukti Pembayaran</label>
            <input type="file" name="payment_proof" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
        <a href="<?= base_url('payment/history'); ?>" class="payment-history-link">Riwayat Pembayaran</a>
    </form>
</div>

</body>
</html>

<?= $this->endSection(); ?>
