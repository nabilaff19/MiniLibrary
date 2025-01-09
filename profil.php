<?php
session_start();

if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('koneksi.php');


$name = $_SESSION['name'];
$email = $_SESSION['email'];

$sql = "SELECT * FROM admins WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $username = $row['username'];
    $name = $row['name'];
    $email = $row['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - MiniLibrary</title>
    <link rel="stylesheet" href="profil.css"> <!-- Pastikan link ke file CSS -->
</head>
<body>
    <div class="container">
        <!-- Logo di atas -->
        <div class="logo">
            <img src="2-removebg-preview.png" alt="MiniLibrary Logo">
        </div>

        <!-- Menampilkan data profil -->
        <div class="info">
            <div class="info-item">
                <p><strong>Username:</strong> <?php echo $username; ?></p>
            </div>
            <div class="info-item">
                <p><strong>Nama:</strong> <?php echo $name; ?></p>
            </div>
            <div class="info-item">
                <p><strong>Email:</strong> <?php echo $email; ?></p>
            </div>
            <div class="info-item">
                <p><strong>Password:</strong> ****</p> <!-- Password disembunyikan -->
            </div>
        </div>

        <!-- Tombol kembali -->
        <a href="dashboard.php" class="back-button">Kembali</a>
    </div>
</body>
</html>
