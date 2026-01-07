<?php
include 'db.php';

echo "<h2>Fixing Database...</h2>";

// 1. Cek Table transactions
$check = mysqli_query($conn, "SHOW COLUMNS FROM transactions LIKE 'payment_method'");
if (mysqli_num_rows($check) == 0) {
    // Column does not exist, add it
    $sql = "ALTER TABLE transactions ADD COLUMN payment_method VARCHAR(50) NOT NULL DEFAULT 'Cash' AFTER total";
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green'>BERHASIL: Kolom payment_method ditambahkan.</p>";
    } else {
        echo "<p style='color:red'>GAGAL: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color:blue'>INFO: Kolom payment_method sudah ada.</p>";
}

// 2. Cek apakah ada kolom lain yg kurang (misal gambar di products)
$check_img = mysqli_query($conn, "SHOW COLUMNS FROM products LIKE 'gambar'");
if (mysqli_num_rows($check_img) == 0) {
    mysqli_query($conn, "ALTER TABLE products ADD COLUMN gambar VARCHAR(255) NOT NULL AFTER price");
    echo "<p style='color:green'>BERHASIL: Kolom gambar (products) ditambahkan.</p>";
}

echo "<hr><p>Database Fix Selesai. Silakan coba Checkout lagi.</p>";
echo "<a href='index.php'>Ke Beranda</a>";
?>