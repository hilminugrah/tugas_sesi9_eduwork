<?php
session_start();
$host = "localhost";
$user = "root";  // Sesuaikan dengan username MySQL
$pass = "";      // Sesuaikan dengan password MySQL
$dbname = "ecommerce";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
