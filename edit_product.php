<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin']))
    header('Location: login_admin.php');
$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header-flex">
            <div class="logo-group">
                <img src="img/Lemon.png" alt="Logo">
                <p class="logo"><span>Lemon</span>Store Admin</p>
            </div>
            <nav class="nav-card">
                <a href="admin.php">Produk</a>
                <a href="transaction_history.php">Transaksi</a>
                <a href="logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Edit Produk</h2>
        <form method="post" action="product_action.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="gambarLama" value="<?= $p['gambar']; ?>">

            <label>Nama Produk</label>
            <input type="text" name="name" value="<?= $p['name']; ?>" required>

            <label>Harga (Rp)</label>
            <input type="number" name="price" value="<?= $p['price']; ?>" required>

            <label>Gambar Saat Ini</label><br>
            <img src="img/<?= $p['gambar']; ?>" style="width: 120px; border-radius: 8px; margin: 10px 0;">
            <br>
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="gambar">

            <div style="display:flex; gap:10px; margin-top:20px">
                <a href="admin.php" class="btn remove" style="text-align:center; flex:1">Batal</a>
                <button name="update" class="btn add" style="flex:1">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</body>

</html>