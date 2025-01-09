<?php
include 'koneksi.php';

// Handle Tambah/Edit Buku
if (isset($_POST['simpan'])) {
    $id = $_POST['id'] ?? '';
    $judul_buku = $_POST['judul_buku'];
    $penulis = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok = $_POST['stok'];

    if ($id) {
        // Update Buku
        $query = "UPDATE buku SET judul_buku='$judul_buku', penulis='$penulis', tahun_terbit='$tahun_terbit', stok='$stok' WHERE id_admin='$id'";
    } else {
        // Tambah Buku
        $query = "INSERT INTO buku (judul_buku, penulis, tahun_terbit, stok) VALUES ('$judul_buku', '$penulis', '$tahun_terbit', '$stok')";
    }
    mysqli_query($conn, $query);
    header("Location: databuku.php");
}


// Handle Hapus Buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM buku WHERE id_admin='$id'";
    mysqli_query($conn, $query);
    header("Location: databuku.php");
}

// Fetch Data Buku
$buku = mysqli_query($conn, "SELECT * FROM buku");

// Cek jika query gagal
if (!$buku) {
    die('Query error: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniLibrary - Data Buku</title>
    <link rel="stylesheet" href="databuku.css">
</head>
<body>
    <div class="container">
        <h1>
            <a href="dashboard.php" class="back-icon">
                <img src="image-removebg-preview (21).png" alt="Back">
            </a>
            MiniLibrary - Data Buku
        </h1>
        <button class="tambah-buku" onclick="scrollToForm()">Tambah Buku</button>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($buku)) {
                    // Hapus baris ini
                    // var_dump($row); 
                    if (isset($row['id_admin'])) {
                        echo "<tr>
                            <td>$no</td>
                            <td>{$row['judul_buku']}</td>
                            <td>{$row['penulis']}</td>
                            <td>{$row['tahun_terbit']}</td>
                            <td>{$row['stok']}</td>
                            <td>
                                <button onclick=\"editBuku(" . htmlspecialchars(json_encode($row)) . ")\">Edit</button>
                                <a href=\"index.php?hapus={$row['id_admin']}\" onclick=\"return confirm('Hapus buku ini?')\">Hapus</a>
                            </td>
                        </tr>";
                        $no++;
                    } else {
                        // Jika id_admin tidak ada, tampilkan pesan error
                        echo "<tr><td colspan='6'>ID tidak ditemukan untuk buku ini.</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <form id="form-buku" method="POST">
            <input type="hidden" name="id" id="id">
            <h3>Tambah/Edit Buku</h3>
            <label>Judul Buku</label>
            <input type="text" name="judul_buku" id="judul_buku" required>
            <label>Penulis</label>
            <input type="text" name="penulis" id="penulis" required>
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" required>
            <label>Stok</label>
            <input type="number" name="stok" id="stok" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>
    </div>

                
    <script>
        function scrollToForm() {
            document.getElementById('form-buku').scrollIntoView({ behavior: 'smooth' });
        }

        function editBuku(data) {
            document.getElementById('id').value = data.id_admin;
            document.getElementById('judul_buku').value = data.judul_buku;
            document.getElementById('penulis').value = data.penulis;
            document.getElementById('tahun_terbit').value = data.tahun_terbit;
            document.getElementById('stok').value = data.stok;
            scrollToForm();
        }
    </script>
</body>
</html>
