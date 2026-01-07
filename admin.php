<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin']))
    header('Location: login_admin.php');
$products = mysqli_query($conn, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - LemonStore</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        <h2>Tambah Produk Baru</h2>
        <form method="post" action="product_action.php" enctype="multipart/form-data">
            <label>Nama Produk</label>
            <input type="text" name="name" required>

            <label>Harga (Rp)</label>
            <input type="number" name="price" required>

            <label>Gambar Produk</label>
            <input type="file" name="gambar" required>

            <button name="add" class="btn add" style="width:100%">Tambah Produk</button>
        </form>

        <br><br><br>
        <h2>Daftar Produk</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($p = mysqli_fetch_assoc($products)): ?>
                        <tr>
                            <td>
                                <img src="img/<?= $p['gambar']; ?>"
                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td><strong><?= $p['name']; ?></strong></td>
                            <td>Rp <?= number_format($p['price']); ?></td>
                            <td class="action-links">
                                <a href="edit_product.php?id=<?= $p['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                                <a href="product_action.php?delete=<?= $p['id']; ?>"
                                    onclick="return confirm('Yakin hapus?');" style="color:var(--danger)"><i
                                        class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>