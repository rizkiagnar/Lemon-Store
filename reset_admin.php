<?php
include 'db.php';
// Hapus user lama biar bersih
mysqli_query($conn, "DELETE FROM admin"); // Optional: truncate or delete specific
// Insert user baru: admin / admin
$pass = md5('admin');
$sql = "INSERT INTO admin (username, password) VALUES ('admin', '$pass')";
if (mysqli_query($conn, $sql)) {
    echo "<h1>Admin Reset Berhasil!</h1>";
    echo "<p>Username: <strong>admin</strong></p>";
    echo "<p>Password: <strong>admin</strong></p>";
    echo "<a href='login_admin.php'>Login Sekarang</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>