<?php
// Memulai session
session_start();

// Menghapus semua data session
session_unset();

// Mengakhiri session
session_destroy();

// Redirect ke halaman login (index.php)
header("Location: index.php");
exit;
?>
