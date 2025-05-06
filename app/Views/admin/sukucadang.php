<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoodBike - Manajemen Suku Cadang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f8;
            display: block;
        }

        .main-content {
            margin: 0 auto;
            width: 100%;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 8px;
            padding: 8px 15px;
            width: 400px;
        }

        .search-bar input {
            border: none;
            outline: none;
            width: 100%;
            padding: 5px 10px;
            font-size: 14px;
        }

        .search-bar i {
            color: #9ca3af;
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu .logo-text {
            margin-right: 15px;
        }

        .user-menu i {
            color: #6b7280;
            font-size: 18px;
            margin-left: 20px;
            cursor: pointer;
        }

        .parts-management-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #111827;
        }

        .add-button {
            background-color: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }

        .add-button:hover {
            background-color: #b91c1c;
        }

        .add-button i {
            margin-right: 8px;
        }

        .parts-table {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .parts-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .parts-table th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
            text-align: left;
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        .parts-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            color: #111827;
            font-size: 14px;
        }

        .parts-table tr:last-child td {
            border-bottom: none;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .edit-btn {
            color: #6366f1;
            text-decoration: none;
            font-weight: 500;
        }

        .delete-btn {
            color: #dc2626;
            text-decoration: none;
            font-weight: 500;
        }

        .edit-btn:hover, .delete-btn:hover {
            text-decoration: underline;
        }

        .stock-low {
            color: #dc2626;
            font-weight: 600;
        }

        .stock-ok {
            color: #16a34a;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .search-bar {
                width: 100%;
            }

            .user-menu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="top-bar">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <i class="fas fa-search"></i>
            </div>

            <div class="user-menu">
                <div class="logo-text">GOODBIKE</div>
                <i class="fas fa-chevron-down"></i>
                <i class="far fa-bell"></i>
            </div>

            <button class="mobile-menu-toggle" id="show-mobile-nav" style="display: none;">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="parts-management-header">
            <div class="section-title">Manajemen Suku Cadang</div>
            <button class="add-button">
                <i class="fas fa-plus"></i>
                Tambah Barang
            </button>
        </div>

        <div class="parts-table">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga (IDR)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Oli Mesin</td>
                        <td>Pelumas</td>
                        <td class="stock-low">3</td>
                        <td>40.000</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Busi</td>
                        <td>Kelistrikan</td>
                        <td class="stock-ok">25</td>
                        <td>18.000</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="edit-btn">Edit</a>
                                <a href="#" class="delete-btn">Hapus</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Add event listeners for buttons
        document.querySelector('.add-button').addEventListener('click', function() {
            alert('Form tambah barang akan ditampilkan');
        });

        document.querySelectorAll('.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Form edit barang akan ditampilkan');
            });
        });

        document.querySelectorAll('.delete-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                    alert('Barang berhasil dihapus');
                }
            });
        });

        // Check for mobile view
        function checkMobileView() {
            if (window.innerWidth <= 768) {
                document.getElementById('show-mobile-nav').style.display = 'block';
            } else {
                document.getElementById('show-mobile-nav').style.display = 'none';
            }
        }

        // Initial check and event listener for resize
        window.addEventListener('resize', checkMobileView);
        checkMobileView();
    </script>
</body>
</html>
