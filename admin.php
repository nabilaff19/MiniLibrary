<?php
// Koneksi ke database
$host = 'localhost';  // Ganti dengan host database Anda
$dbname = 'MiniLibrary';
$username = 'root';    // Ganti dengan username database Anda
$password = '';        // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Menambahkan admin baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Enkripsi password menggunakan password_hash()
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data admin baru
    $stmt = $pdo->prepare('INSERT INTO admins (username, password, name, email) VALUES (:username, :password, :name, :email)');
    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password,
        'name' => $name,
        'email' => $email
    ]);

    echo "Admin baru berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Admin - MiniLibrary</title>
</head>
<body>
    <h1>Tambah Admin Baru</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="name">Nama:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <button type="submit">Tambah Admin</button>
    </form>
</body>
</html>
