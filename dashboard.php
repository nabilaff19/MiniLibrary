<?php
// Mulai session
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header("Location: index.php");
    exit;
}

// Ambil data dari session
$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MiniLibrary</title>
    <link rel="stylesheet" href="dashboard.css"> <!-- Link to external CSS file -->
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Logo -->
        <img src="2-removebg-preview.png" alt="MiniLibrary Logo" class="logo">

        <!-- Admin Info -->
        <div class="admin-info" id="adminInfo">
            <!-- Menampilkan nama dan email dari session -->
            <a href="profil.php" class="link">
                <div class="name"><?php echo htmlspecialchars($name); ?></div>
                <div class="email"><?php echo htmlspecialchars($email); ?></div>
            </a>
        </div>
        
        <!-- Divider -->
        <div class="divider"></div>

        <!-- Menu Items -->
        <div class="menu-item">
            <img src="Desain_tanpa_judul-removebg-preview.png" alt="Data Buku">
            <span><a href="databuku.php" class="link">Data Buku</a></span>
        </div>
        <div class="menu-item">
            <img src="Desain_tanpa_judul__3_-removebg-preview.png" alt="Data Anggota">
            <span><a href="dataanggota.php" class="link">Data Anggota</a></span>
        </div>
        <div class="menu-item">
            <img src="Desain_tanpa_judul__1_-removebg-preview.png" alt="Data Peminjaman">
            <span><a href="datapeminjaman.php" class="link">Data Peminjaman</a></span>
        </div>

        <!-- Divider -->
        <div class="divider"></div>

        <div class="menu-item">
            <img src="Desain_tanpa_judul__2_-removebg-preview.png" alt="Ringkasan">
            <span><a href="ringkasan.php" class="link">RINGKASAN</a></span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Burger menu -->
        <div class="toggle-menu" id="toggleMenu" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Teks Selamat Datang -->
        <div class="welcome-text">
            Selamat Datang, <?php echo htmlspecialchars($name); ?> di MiniLibrary!
        </div>

        <!-- Logout Button -->
        <div class="logout">
            <img src="image-removebg-preview (22).png" alt="Logout Icon">
            <span><a href="logout.php" class="link">Logout</a></span>
        </div>


        <!-- Kotak Statistik, Pengumuman, Buku Terpopuler -->
        <div class="boxes">
            <div class="box">
                <img src="image-removebg-preview (23).png" alt="Statistik Hari Ini">
                <p><b>STATISTIK HARI INI</b></p>
                <p>Peminjaman: 15 buku</p>
                <p>Pengembalian: 8 buku</p>
            </div>
            <div class="box">
                <img src="image-removebg-preview (24).png" alt="Pengumuman">
                <p><b>PENGUMUMAN</b></p>
                <p>MiniLibrary libur pada tanggal 25 Desember 2024</p>
            </div>
            <div class="box">
                <img src="image-removebg-preview (25).png" alt="Buku Terpopuler">
                <p><b>BUKU TERPOPULER</b></p>
                <div class="buku-populer">
                    <ol>
                        <li>Matematika Diskrit - 10 kali dipinjam</li>
                        <li>Pemrograman Python - 8 kali dipinjam</li>
                        <li>Aljabar Linear - 7 kali dipinjam</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="quote-section">
            <img src="kawaii.png" alt="Kawaii Image">
            <p>"Buku adalah jendela dunia. Mari kita buka jendela itu bersama MiniLibrary!"</p>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const adminInfo = document.getElementById('adminInfo');
            
            // Toggle sidebar expanded class
            sidebar.classList.toggle('expanded');
            mainContent.classList.toggle('expanded'); 

            if (sidebar.classList.contains('expanded')) {
                adminInfo.classList.remove('hidden'); // Menampilkan informasi admin jika sidebar diperbesar
            } else {
                adminInfo.classList.add('hidden'); // Menyembunyikan informasi admin jika sidebar diperkecil
            }
        }
    </script>
</body>
</html>
