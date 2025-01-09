<?php
// Menghubungkan ke database
include('koneksi.php');

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari admin berdasarkan username
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah admin ditemukan
    if ($row = mysqli_fetch_assoc($result)) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = "Username atau password salah!";
        }
    } else {
        $error_message = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MiniLibrary</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7e4e4; /* Latar belakang cream */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px; /* Jarak lebih besar ke kotak login */
        }

        .login-container {
            background-color: #ffffff; /* Warna putih untuk kotak login */
            border: 4px solid #FACACA; /* Pinggiran warna pink */
            border-radius: 20px;
            padding: 30px;
            width: 350px; /* Lebar lebih besar */
            box-shadow: 0 4px 10px rgba(176, 94, 94, 0.1);
            text-align: center;
        }

        .login-container img {
            max-width: 180px; /* Ukuran logo lebih besar */
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 12px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-container button {
            background-color: #FACACA; /* Tombol warna pink */
            color: #333;
            padding: 12px;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
            width: 40%;
            font-weight: bold;
        }

        .login-container button:hover {
            background-color: #F6D5D5; /* Warna tombol saat hover */
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Tulisan Login di luar kotak -->
    <h1>Login</h1>

    <div class="login-container">
        <!-- Logo -->
        <img src="2-removebg-preview.png" alt="MiniLibrary Logo">
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <!-- Form Login -->
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
