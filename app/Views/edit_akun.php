<!-- app/Views/edit_akun.php -->
<?= $this->extend('templates/main_template'); ?>

<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: Arial, sans-serif; 
        }

        .edit-card { 
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .edit-card h2 { 
            font-size: 22px; 
            margin-bottom: 15px; 
            text-align: center; 
        }

        .edit-card form { 
            display: flex; 
            flex-direction: column; 
        }

        .edit-card input, .edit-card select { 
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .edit-card button { 
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-card button:hover { 
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="edit-card">
        <h2>Edit Profil Pengguna</h2>
        <form action="<?= base_url('/useraccount/update') ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Nama Lengkap" value="<?= $username ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
            <input type="text" name="vehicle" placeholder="Kendaraan" value="<?= $vehicle ?>">
            <input type="file" name="photo" accept="image/*">
            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>

<?= $this->endSection(); ?>
