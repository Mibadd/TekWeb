<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Suku Cadang - GOODBIKE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            background-color: #f5f5f5;
            height: 100vh;
        }
        /* Sidebar Styles */
        .sidebar {
            width: 215px;
            height: 100vh;
            background-color: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }
        .logo {
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }
        .logo h1 {
            color: #e74c3c;
            font-size: 20px;
            font-weight: 600;
        }
        .menu {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f5f5f5;
            text-decoration: none;
            display: block;
        }
        .menu-item:hover,
        .menu-item.active {
            background-color: #f8f9fa;
        }
        .logout {
            border-top: 1px solid #e0e0e0;
            padding: 15px 20px;
            cursor: pointer;
            color: #333;
        }
        /* Content Styles */
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f7;
            overflow-y: auto;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .content-header h2 {
            font-size: 24px;
            color: #1a3153;
            font-weight: 600;
        }
        .add-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .add-button:hover {
            background-color: #c0392b;
        }
        .sukucadang-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 24px;
        }
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            align-items: center;
        }
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        label {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            width: 180px;
        }
        .filter-button {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .filter-button:hover {
            background-color: #1d4ed8;
        }
        .sukucadang-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .sukucadang-table th {
            background-color: #f8fafc;
            text-align: left;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        .sukucadang-table td {
            padding: 12px 16px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }
        .sukucadang-table tr:nth-child(even) {
            background-color: #fafafa;
        }
        .status-tersedia {
            color: #047857;
            font-weight: 500;
        }
        .status-menipis {
            color: #b45309;
            font-weight: 500;
        }
        .status-habis {
            color: #b91c1c;
            font-weight: 500;
        }
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        .action-edit {
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
        .action-delete {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 12px;
            cursor: pointer;
        }
        .page-item {
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 14px;
            user-select: none;
            margin-right: 5px;
            display: inline-block;
        }
        .page-item.active {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        /* Modal Styles */
        #modalTambah, #modalEdit {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        #modalTambah .modal-content, #modalEdit .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        #modalTambah h3, #modalEdit h3 {
            margin-bottom: 16px;
        }
        #modalTambah label, #modalEdit label {
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
            font-size: 14px;
            color: #333;
        }
        #modalTambah input[type="text"],
        #modalTambah input[type="number"],
        #modalTambah select,
        #modalEdit input[type="text"],
        #modalEdit input[type="number"],
        #modalEdit select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            margin-bottom: 12px;
        }
        #modalTambah .btn-group, #modalEdit .btn-group {
            text-align: right;
        }
        #modalTambah button, #modalEdit button {
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        #modalTambah #btnCloseModal, #modalEdit #btnCloseEditModal {
            background: #ccc;
            margin-right: 10px;
            color: #333;
        }
        #modalTambah #btnCloseModal:hover, #modalEdit #btnCloseEditModal:hover {
            background: #b3b3b3;
        }
        #modalTambah button[type="submit"], #modalEdit button[type="submit"] {
            background: #e74c3c;
            color: white;
        }
        #modalTambah button[type="submit"]:hover, #modalEdit button[type="submit"]:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1>Admin GOODBIKE</h1>
        </div>
        <div class="menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="menu-item active">Dashboard</a>
            <a href="<?= base_url('admin/manajemenpengguna') ?>" class="menu-item">Manajemen Pengguna</a>
            <a href="<?= base_url('admin/manajemenjadwal') ?>" class="menu-item">Manajemen Jadwal</a>
            <a href="<?= base_url('admin/sukucadang') ?>" class="menu-item">Suku Cadang</a>
            <a href="<?= base_url('admin/statistik') ?>" class="menu-item">Statistik</a>
            <a href="<?= base_url('admin/laporan') ?>" class="menu-item">Laporan</a>
        </div>
        <div class="logout">
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="content-header">
            <h2>Data Suku Cadang</h2>
            <button id="btnOpenModalTambah" class="add-button">Tambah Suku Cadang</button>
        </div>
        <div class="sukucadang-container">
            <div class="filter-container">
                <div class="filter-group">
                    <label for="filterNama">Nama:</label>
                    <input type="text" id="filterNama" placeholder="Cari nama suku cadang" />
                </div>
                <div class="filter-group">
                    <label for="filterStatus">Status:</label>
                    <select id="filterStatus">
                        <option value="">Semua</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Menipis">Menipis</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>
                <button id="btnFilter" class="filter-button">Filter</button>
            </div>
            <table class="sukucadang-table">
                <thead>
                    <tr>
                        <th>Nama Suku Cadang</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="sukuCadangTableBody">
                    <!-- Data rows akan muncul di sini -->
                </tbody>
            </table>
            <div id="pagination" style="margin-top: 15px;"></div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambah">
        <div class="modal-content">
            <h3>Tambah Suku Cadang</h3>
            <form id="formTambah">
                <label for="tambahNama">Nama Suku Cadang:</label>
                <input type="text" id="tambahNama" required />

                <label for="tambahStok">Stok:</label>
                <input type="number" id="tambahStok" min="0" required />

                <label for="tambahStatus">Status:</label>
                <select id="tambahStatus" required>
                    <option value="">Pilih Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Menipis">Menipis</option>
                    <option value="Habis">Habis</option>
                </select>

                <div class="btn-group">
                    <button type="button" id="btnCloseModal">Batal</button>
                    <button type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit">
        <div class="modal-content">
            <h3>Edit Suku Cadang</h3>
            <form id="formEdit">
                <input type="hidden" id="editIndex" />
                <label for="editNama">Nama Suku Cadang:</label>
                <input type="text" id="editNama" required />

                <label for="editStok">Stok:</label>
                <input type="number" id="editStok" min="0" required />

                <label for="editStatus">Status:</label>
                <select id="editStatus" required>
                    <option value="">Pilih Status</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Menipis">Menipis</option>
                    <option value="Habis">Habis</option>
                </select>

                <div class="btn-group">
                    <button type="button" id="btnCloseEditModal">Batal</button>
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Data dummy suku cadang
        let sukuCadangData = [
            { nama: "Ban Sepeda", stok: 15, status: "Tersedia" },
            { nama: "Rem Depan", stok: 5, status: "Menipis" },
            { nama: "Lampu Belakang", stok: 0, status: "Habis" },
            { nama: "Gear", stok: 10, status: "Tersedia" },
            { nama: "Handlebar", stok: 3, status: "Menipis" },
            { nama: "Pedal", stok: 0, status: "Habis" },
            { nama: "Sadel", stok: 20, status: "Tersedia" },
            { nama: "Rantai", stok: 2, status: "Menipis" },
            { nama: "Ban Dalam", stok: 0, status: "Habis" },
            { nama: "Shockbreaker", stok: 8, status: "Tersedia" },
            { nama: "Velg", stok: 4, status: "Menipis" },
            { nama: "Kunci Stir", stok: 0, status: "Habis" },
            { nama: "Lampu Depan", stok: 10, status: "Tersedia" },
            { nama: "Kabel Rem", stok: 1, status: "Menipis" },
            { nama: "Spakbor", stok: 0, status: "Habis" },
        ];

        let currentPage = 1;
        const itemsPerPage = 5;

        // Elemen DOM
        const sukuCadangTableBody = document.getElementById("sukuCadangTableBody");
        const filterNama = document.getElementById("filterNama");
        const filterStatus = document.getElementById("filterStatus");
        const btnFilter = document.getElementById("btnFilter");
        const pagination = document.getElementById("pagination");

        const modalTambah = document.getElementById("modalTambah");
        const btnOpenModalTambah = document.getElementById("btnOpenModalTambah");
        const btnCloseModal = document.getElementById("btnCloseModal");
        const formTambah = document.getElementById("formTambah");

        const modalEdit = document.getElementById("modalEdit");
        const btnCloseEditModal = document.getElementById("btnCloseEditModal");
        const formEdit = document.getElementById("formEdit");
        const editIndexInput = document.getElementById("editIndex");
        const editNama = document.getElementById("editNama");
        const editStok = document.getElementById("editStok");
        const editStatus = document.getElementById("editStatus");

        // Fungsi tampilkan data ke tabel dengan paging dan filter
        function tampilkanData(page = 1) {
            const namaFilter = filterNama.value.toLowerCase().trim();
            const statusFilter = filterStatus.value;

            // Filter data
            let filteredData = sukuCadangData.filter(item => {
                const matchNama = item.nama.toLowerCase().includes(namaFilter);
                const matchStatus = statusFilter === "" || item.status === statusFilter;
                return matchNama && matchStatus;
            });

            // Pagination
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (page > totalPages) page = totalPages > 0 ? totalPages : 1;
            currentPage = page;

            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const pageData = filteredData.slice(start, end);

            // Tampilkan baris tabel
            sukuCadangTableBody.innerHTML = "";
            if(pageData.length === 0) {
                sukuCadangTableBody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:20px;">Data tidak ditemukan</td></tr>`;
            } else {
                pageData.forEach((item, index) => {
                    const globalIndex = start + index;
                    sukuCadangTableBody.innerHTML += `
                        <tr>
                            <td>${item.nama}</td>
                            <td>${item.stok}</td>
                            <td class="status-${item.status.toLowerCase()}">${item.status}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-edit" data-index="${globalIndex}">Edit</button>
                                    <button class="action-delete" data-index="${globalIndex}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }

            // Tampilkan pagination
            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            pagination.innerHTML = "";
            for(let i=1; i<=totalPages; i++) {
                const pageBtn = document.createElement("span");
                pageBtn.className = "page-item" + (i === currentPage ? " active" : "");
                pageBtn.textContent = i;
                pageBtn.addEventListener("click", () => {
                    tampilkanData(i);
                });
                pagination.appendChild(pageBtn);
            }
        }

        // Event untuk tombol Filter
        btnFilter.addEventListener("click", () => {
            tampilkanData(1);
        });

        // Event untuk tombol Tambah Suku Cadang buka modal
        btnOpenModalTambah.addEventListener("click", () => {
            formTambah.reset();
            modalTambah.style.display = "flex";
        });

        // Tutup modal Tambah
        btnCloseModal.addEventListener("click", () => {
            modalTambah.style.display = "none";
        });

        // Tambah data baru
        formTambah.addEventListener("submit", (e) => {
            e.preventDefault();
            const nama = document.getElementById("tambahNama").value.trim();
            const stok = Number(document.getElementById("tambahStok").value);
            const status = document.getElementById("tambahStatus").value;

            if(nama === "" || status === "" || isNaN(stok) || stok < 0) {
                alert("Mohon isi data dengan benar!");
                return;
            }

            sukuCadangData.push({ nama, stok, status });
            modalTambah.style.display = "none";
            tampilkanData(currentPage);
        });

        // Event klik di tabel untuk edit dan hapus (event delegation)
        sukuCadangTableBody.addEventListener("click", (e) => {
            if(e.target.classList.contains("action-edit")) {
                const index = e.target.dataset.index;
                bukaModalEdit(index);
            } else if(e.target.classList.contains("action-delete")) {
                const index = e.target.dataset.index;
                if(confirm("Yakin ingin menghapus data ini?")) {
                    sukuCadangData.splice(index, 1);
                    tampilkanData(currentPage);
                }
            }
        });

        // Buka modal edit dengan data yang dipilih
        function bukaModalEdit(index) {
            const data = sukuCadangData[index];
            editIndexInput.value = index;
            editNama.value = data.nama;
            editStok.value = data.stok;
            editStatus.value = data.status;
            modalEdit.style.display = "flex";
        }

        // Tutup modal edit
        btnCloseEditModal.addEventListener("click", () => {
            modalEdit.style.display = "none";
        });

        // Simpan perubahan edit
        formEdit.addEventListener("submit", (e) => {
            e.preventDefault();
            const index = editIndexInput.value;
            const nama = editNama.value.trim();
            const stok = Number(editStok.value);
            const status = editStatus.value;

            if(nama === "" || status === "" || isNaN(stok) || stok < 0) {
                alert("Mohon isi data dengan benar!");
                return;
            }

            sukuCadangData[index] = { nama, stok, status };
            modalEdit.style.display = "none";
            tampilkanData(currentPage);
        });

        // Tutup modal jika klik di luar konten modal
        window.addEventListener("click", (e) => {
            if(e.target === modalTambah) {
                modalTambah.style.display = "none";
            }
            if(e.target === modalEdit) {
                modalEdit.style.display = "none";
            }
        });

        // Tampilkan data awal
        tampilkanData();
    </script>
</body>
</html>
