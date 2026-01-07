<?php
$host = "localhost";
$user = "root";
$pass = "";

$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 1. Create Database
$sql = "CREATE DATABASE IF NOT EXISTS lemonstore";
if (mysqli_query($conn, $sql)) {
    echo "Database lemonstore berhasil dibuat/sudah ada.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

mysqli_select_db($conn, "lemonstore");

// 2. Create Table admin
$sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Tabel admin berhasil dibuat.<br>";
    // Insert default admin if not exists
    $check = mysqli_query($conn, "SELECT * FROM admin WHERE username='admin'");
    if (mysqli_num_rows($check) == 0) {
        $pass = md5("admin");
        mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('admin', '$pass')");
        echo "User admin default (user: admin, pass: admin) berhasil ditambahkan.<br>";
    }
} else {
    echo "Error creating table admin: " . mysqli_error($conn) . "<br>";
}

// 3. Create Table products
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    gambar VARCHAR(255) NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Tabel products berhasil dibuat.<br>";

    // Check if 'gambar' column exists (in case table existed before)
    $check_col = mysqli_query($conn, "SHOW COLUMNS FROM products LIKE 'gambar'");
    if (mysqli_num_rows($check_col) == 0) {
        mysqli_query($conn, "ALTER TABLE products ADD COLUMN gambar VARCHAR(255) NOT NULL");
        echo "Kolom gambar berhasil ditambahkan ke tabel products.<br>";
    }
} else {
    echo "Error creating table products: " . mysqli_error($conn) . "<br>";
}

// 4. Create Table transactions
$sql = "CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATETIME NOT NULL,
    total INT NOT NULL,
    payment_method VARCHAR(50) NOT NULL DEFAULT 'Cash'
)";
if (mysqli_query($conn, $sql)) {
    echo "Tabel transactions berhasil dibuat.<br>";
} else {
    echo "Error creating table transactions: " . mysqli_error($conn) . "<br>";
}

// 5. Create Table transaction_detail
$sql = "CREATE TABLE IF NOT EXISTS transaction_detail (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    qty INT NOT NULL,
    price INT NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Tabel transaction_detail berhasil dibuat.<br>";
} else {
    echo "Error creating table transaction_detail: " . mysqli_error($conn) . "<br>";
}

?>
<br>Setup Selesai. Silakan hapus file ini jika sudah tidak diperlukan.
<a href="index.php">Ke Home</a>