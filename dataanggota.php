<?php
// Koneksi ke database
include 'koneksi.php';

// Handle Tambah/Edit Anggota
if (isset($_POST['simpan'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : ''; // ID dari hidden input
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : ''; // Ambil nilai NIM dari input form
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $kontak = isset($_POST['kontak']) ? $_POST['kontak'] : '';

    // Validasi input: NIM wajib diisi
    if (empty($nim)) {
        die('Error: NIM wajib diisi!');
    }

    // Validasi input lainnya
    if (empty($nama) || empty($fakultas) || empty($kontak)) {
        die('Error: Semua kolom wajib diisi!');
    }

    // Jika ID ada, maka update, jika tidak maka insert
    if ($id) {
        $query = "UPDATE anggota SET nama='$nama', nim='$nim', fakultas='$fakultas', kontak='$kontak' WHERE id_anggota='$id'";
    } else {
        $query = "INSERT INTO anggota (nama, nim, fakultas, kontak) VALUES ('$nama', '$nim', '$fakultas', '$kontak')";
    }

    if (!mysqli_query($conn, $query)) {
        die('Query error: ' . mysqli_error($conn)); // Debug query error
    }

    header("Location: dataanggota.php");
    exit();
}

// Handle Hapus Anggota
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM anggota WHERE id_anggota='$id'";

    if (!mysqli_query($conn, $query)) {
        die('Query error: ' . mysqli_error($conn));
    }
    header("Location: dataanggota.php");
    exit();
}

// Fetch Data Anggota
$anggota = mysqli_query($conn, "SELECT * FROM anggota");

if (!$anggota) {
    die('Query error: ' . mysqli_error($conn)); // Debug jika query gagal
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniLibrary - Data Anggota</title>
    <link rel="stylesheet" href="dataanggota.css">
</head>
<body>
    <div class="container">
    <h1>
            <a href="dashboard.php" class="back-icon">
                <img src="image-removebg-preview (21).png" alt="Back">
            </a>
            MiniLibrary - Data Buku
        </h1>
        <button class="tambah-anggota" onclick="scrollToForm()">Tambah Anggota</button>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Fakultas</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Fetch semua data anggota
                while ($row = mysqli_fetch_assoc($anggota)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['nim']) . "</td>
                        <td>" . htmlspecialchars($row['fakultas']) . "</td>
                        <td>" . htmlspecialchars($row['kontak']) . "</td>
                        <td>
                            <button onclick=\"editAnggota(" . htmlspecialchars(json_encode($row)) . ")\">Edit</button>
                            <a href=\"dataanggota.php?hapus={$row['id_anggota']}\" onclick=\"return confirm('Hapus anggota ini?')\">Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <form id="form-anggota" method="POST">
            <input type="hidden" name="id" id="id">
            <h3>Tambah/Edit Anggota</h3>
            <label>Nama</label>
            <input type="text" name="nama" id="nama" required>
            <label>NIM</label>
            <input type="text" name="nim" id="nim" required> <!-- NIM wajib -->
            <label>Fakultas</label>
            <input type="text" name="fakultas" id="fakultas" required>
            <label>Kontak</label>
            <input type="text" name="kontak" id="kontak" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>
    </div>

    <script>
        function scrollToForm() {
            document.getElementById('form-anggota').scrollIntoView({ behavior: 'smooth' });
        }

        function editAnggota(data) {
            document.getElementById('id').value = data.id_anggota;
            document.getElementById('nama').value = data.nama;
            document.getElementById('nim').value = data.nim; // Set NIM dengan benar
            document.getElementById('fakultas').value = data.fakultas;
            document.getElementById('kontak').value = data.kontak;
            scrollToForm();
        }
    </script>
</body>
</html>
