<?php
// Koneksi ke database
include 'koneksi.php';

// Handle Tambah/Edit Peminjaman
if (isset($_POST['simpan'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : ''; // ID dari hidden input
    $judul_buku = isset($_POST['judul_buku']) ? $_POST['judul_buku'] : '';
    $nama_anggota = isset($_POST['nama_anggota']) ? $_POST['nama_anggota'] : '';
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : '';
    $tanggal_kembali = isset($_POST['tanggal_kembali']) ? $_POST['tanggal_kembali'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // Validasi input
    if (empty($judul_buku) || empty($nama_anggota) || empty($tanggal_pinjam) || empty($tanggal_kembali) || empty($status)) {
        die('Error: Semua kolom wajib diisi!');
    }

    // Jika ID ada, maka update, jika tidak maka insert
    if ($id) {
        $query = "UPDATE peminjaman SET judul_buku='$judul_buku', nama_anggota='$nama_anggota', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali', status='$status' WHERE id_peminjaman='$id'";
    } else {
        $query = "INSERT INTO peminjaman (judul_buku, nama_anggota, tanggal_pinjam, tanggal_kembali, status) VALUES ('$judul_buku', '$nama_anggota', '$tanggal_pinjam', '$tanggal_kembali', '$status')";
    }

    if (!mysqli_query($conn, $query)) {
        die('Query error: ' . mysqli_error($conn));
    }

    header("Location: datapeminjaman.php");
    exit();
}

// Handle Hapus Peminjaman
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM peminjaman WHERE id_peminjaman='$id'";

    if (!mysqli_query($conn, $query)) {
        die('Query error: ' . mysqli_error($conn));
    }
    header("Location: datapeminjaman.php");
    exit();
}

// Fetch Data Peminjaman
$peminjaman = mysqli_query($conn, "SELECT * FROM peminjaman");

if (!$peminjaman) {
    die('Query error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniLibrary - Data Peminjaman</title>
    <link rel="stylesheet" href="datapeminjaman.css">
</head>
<body>
    <div class="container">
        <h1>
            <a href="dashboard.php" class="back-icon">
                <img src="image-removebg-preview (21).png" alt="Back">
            </a>
            MiniLibrary - Data Peminjaman
        </h1>
        <button class="tambah-peminjaman" onclick="scrollToForm()">Tambah Peminjaman</button>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($peminjaman)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>" . htmlspecialchars($row['judul_buku']) . "</td>
                        <td>" . htmlspecialchars($row['nama_anggota']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal_pinjam']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal_kembali']) . "</td>
                        <td>" . htmlspecialchars($row['status']) . "</td>
                        <td>
                            <button onclick=\"editPeminjaman(" . htmlspecialchars(json_encode($row)) . ")\">Edit</button>
                            <a href=\"datapeminjaman.php?hapus={$row['id_peminjaman']}\" onclick=\"return confirm('Hapus peminjaman ini?')\">Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <form id="form-peminjaman" method="POST">
            <input type="hidden" name="id" id="id">
            <h3>Tambah/Edit Peminjaman</h3>
            <label>Judul Buku</label>
            <input type="text" name="judul_buku" id="judul_buku" required>
            <label>Nama Anggota</label>
            <input type="text" name="nama_anggota" id="nama_anggota" required>
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required>
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" id="tanggal_kembali" required>
            <label>Status</label>
            <input type="text" name="status" id="status" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>
    </div>

    <script>
        function scrollToForm() {
            document.getElementById('form-peminjaman').scrollIntoView({ behavior: 'smooth' });
        }

        function editPeminjaman(data) {
            document.getElementById('id').value = data.id_peminjaman;
            document.getElementById('judul_buku').value = data.judul_buku;
            document.getElementById('nama_anggota').value = data.nama_anggota;
            document.getElementById('tanggal_pinjam').value = data.tanggal_pinjam;
            document.getElementById('tanggal_kembali').value = data.tanggal_kembali;
            document.getElementById('status').value = data.status;
            scrollToForm();
        }
    </script>
</body>
</html>
