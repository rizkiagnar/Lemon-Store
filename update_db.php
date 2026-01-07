<?php
include 'db.php';

$sql = "ALTER TABLE transactions ADD COLUMN payment_method VARCHAR(50) NOT NULL DEFAULT 'Cash' AFTER total";
if (mysqli_query($conn, $sql)) {
    echo "Kolom payment_method berhasil ditambahkan.";
} else {
    echo "Error (mungkin kolom sudah ada): " . mysqli_error($conn);
}
echo "<br><a href='index.php'>Kembali</a>";
?>