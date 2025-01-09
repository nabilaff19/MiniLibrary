<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniLibrary</title>
    <style>
        /* Mengatur margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f7e4e4; /* Warna pink muda */
        }

        /* Bagian untuk latar belakang */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('download (2).jpeg') no-repeat center center/cover;
            filter: blur(5px); /* Membuat gambar buram */
            z-index: -1;
        }

        /* Bagian untuk logo */
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }

        .logo-container img {
            width: 350px; /* Ukuran logo */
            margin-bottom: 20px;
        }

        .description {
            width: 80%;
            background: linear-gradient(to bottom, #fff7e6, #f7e4e4); /* Perpaduan warna cream dan pink */
            color: #333;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Tombol login */
        .login-button {
            position: absolute;
            top: 20px;
            right: 20px;
            text-decoration: none;
            background: #FACACA; /* Warna tombol */
            color: #333;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background: #F6D5D5; /* Warna hover tombol */
        }
    </style>
</head>
<body>
    <!-- Latar belakang -->
    <div class="background"></div>

    <!-- Tombol Login -->
    <a href="login.php" class="login-button">Login</a>

    <!-- Logo dan deskripsi -->
    <div class="logo-container">
        <img src="2-removebg-preview.png" alt="MiniLibrary Logo">
        <div class="description">
            <h1>MiniLibrary</h1>
            <p>
                MiniLibrary adalah platform pengelolaan perpustakaan modern yang mempermudah akses informasi 
                dan layanan perpustakaan. Dengan MiniLibrary, pengguna dapat menemukan informasi koleksi buku, 
                data anggota, dan layanan peminjaman dengan mudah dan cepat.
            </p>
        </div>
    </div>
</body>
</html>
