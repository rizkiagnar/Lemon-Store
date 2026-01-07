<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="header-flex">
            <div class="logo-group">
                <img src="img/Lemon.png" alt="Logo">
                <p class="logo"><span>Lemon</span>Gadget</p>
            </div>
            <nav class="nav-card">
                <a href="index.php">Beranda</a>
                <a href="products.php">Shop</a>
                <a href="cart_detail.php">
                    <i class="fas fa-shopping-cart"></i>
                    (<?php echo array_sum($_SESSION['cart']); ?>)
                </a>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Keranjang Belanja</h2>
        <?php if (empty($_SESSION['cart'])): ?>
            <div style="text-align: center; padding: 50px;">
                <h3>Keranjang Anda Kosong</h3>
                <a href="products.php" class="btn add">Mulai Belanja</a>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $grand = 0;
                        foreach ($_SESSION['cart'] as $id => $qty):
                            $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));
                            $total = $qty * $p['price'];
                            $grand += $total; ?>
                            <tr>
                                <td>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <img src="img/<?= $p['gambar']; ?>"
                                            style="width:50px; height:50px; border-radius:5px; object-fit:cover">
                                        <strong><?= $p['name']; ?></strong>
                                    </div>
                                </td>
                                <td><?= $qty; ?></td>
                                <td>Rp <?= number_format($p['price']); ?></td>
                                <td>Rp <?= number_format($total); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="3" style="text-align: right; padding-right: 20px;">Grand Total</td>
                            <td style="color: var(--primary); font-size: 1.2rem;">Rp <?= number_format($grand); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="text-align: right; margin-top: 20px;">
                <a href="products.php" class="btn remove" style="margin-right: 10px;">Lanjut Belanja</a>
                <a href="payment.php" class="btn add">Lanjut Pembayaran <i class="fas fa-arrow-right"></i></a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>