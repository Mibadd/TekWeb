<!-- app/Views/akun.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: Arial, sans-serif; 
        }

        .profile-card { 
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .profile-card img { 
            display: block;
            margin: 0 auto 15px;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .profile-card h2 { 
            font-size: 22px; 
            margin: 10px 0 15px; 
            text-align: center; 
        }

        .profile-card p { 
            color: #666; 
            margin: 15px 0; 
        }

        .profile-card .status { 
            color: green; 
            font-weight: bold; 
        }

        .profile-card .buttons { 
            margin-top: 15px; 
        }

        .profile-card button { 
            width: 100%; 
            font-weight: bold; 
            padding: 10px; 
            border: none; 
            border-radius: 5px; 
            font-size: 16px; 
            cursor: pointer; 
            margin-bottom: 10px; 
        }

        .profile-card .edit { 
            background-color: #007bff; 
            color: #fff; 
        }

        .profile-card .history { 
            background-color: #e0e0e0; 
            color: #333; 
        }

        .profile-card .logout-btn {
            background-color: #dc3545; 
            color: #fff;
            text-align: center;
            display: block;
            width: 100%; 
            padding: 10px; 
            border: none; 
            border-radius: 5px; 
            font-size: 16px; 
            cursor: pointer; 
            margin-bottom: 10px;
        }

        .profile-card .profile-initial-circle {
            background-color: #6c757d;
            color: #fff;
            font-size: 50px;
            font-weight: bold;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h2>Profil Pengguna</h2>
        <div style="text-align: center;">
            <?php if (!empty($photo)) : ?>
                <img src="<?= base_url('image/' . $photo) ?>" alt="Foto Profil" class="profile-img">
            <?php else : ?>
                <div class="profile-initial-circle">
                    <?= strtoupper(substr(trim($username), 0, 1)) ?>
                </div>
            <?php endif; ?>
            <h2><?= $username ?></h2>
            <p><?= $email ?></p>
        </div>
        <hr>
        <p><strong>Kendaraan:</strong> <?= $vehicle ?></p>
        <p><strong>Status Akun:</strong> <span class="status">Aktif</span></p>
        <p><strong>Terdaftar Sejak:</strong> <?= $registered_date ?></p>
        <div class="buttons">
            <button class="edit" onclick="window.location.href='<?= base_url('/useraccount/edit') ?>'">Edit Akun</button>
            <a href="<?= base_url('auth/logout'); ?>" class="logout-btn">Keluar</a>
        </div>
    </div>
</body>
</html>

<?= $this->endSection(); ?>
