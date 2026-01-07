<?php
session_start();
include 'db.php';
if (empty($_SESSION['cart'])) {
    header("Location: products.php");
    exit;
}

// Hitung total lagi untuk display
$grand = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));
    $grand += $p['price'] * $qty;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran - Lemon Gadget Store</title>
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
        <h2>Pilih Metode Pembayaran</h2>

        <div
            style="max-width: 500px; margin: auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="text-align: center; margin-bottom: 2rem;">
                <p>Total Pembayaran:</p>
                <h1 style="color: var(--primary);">Rp
                    <?= number_format($grand); ?>
                </h1>
            </div>

            <form action="checkout.php" method="post">
                <div style="margin-bottom: 1rem;">
                    <label
                        style="display: flex; align-items: center; padding: 1rem; border: 1px solid #ddd; border-radius: 8px; cursor: pointer;">
                        <input type="radio" name="payment_method" value="QRIS" required
                            style="width: auto; margin-right: 10px;">
                        <i class="fas fa-qrcode" style="font-size: 1.5rem; margin-right: 10px; color: #2c3e50;"></i>
                        <div>
                            <strong>QRIS</strong><br>
                            <small>Scan QR Code (Gopay, OVO, Dana, dll)</small>
                        </div>
                    </label>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label
                        style="display: flex; align-items: center; padding: 1rem; border: 1px solid #ddd; border-radius: 8px; cursor: pointer;">
                        <input type="radio" name="payment_method" value="Debit" required
                            style="width: auto; margin-right: 10px;">
                        <i class="fas fa-credit-card"
                            style="font-size: 1.5rem; margin-right: 10px; color: #2980b9;"></i>
                        <div>
                            <strong>Debit Transfer</strong><br>
                            <small>BCA, Mandiri, BNI, BRI</small>
                        </div>
                    </label>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label
                        style="display: flex; align-items: center; padding: 1rem; border: 1px solid #ddd; border-radius: 8px; cursor: pointer;">
                        <input type="radio" name="payment_method" value="Cash" required
                            style="width: auto; margin-right: 10px;">
                        <i class="fas fa-money-bill-wave"
                            style="font-size: 1.5rem; margin-right: 10px; color: #27ae60;"></i>
                        <div>
                            <strong>Tunai / COD</strong><br>
                            <small>Bayar di Tempat / Kasir</small>
                        </div>
                    </label>
                </div>

                <button class="btn add" style="width: 100%;">Bayar Sekarang <i class="fas fa-arrow-right"></i></button>
                <div style="text-align: center; margin-top: 1rem;">
                    <a href="cart_detail.php" style="color: #777;">Kembali ke Keranjang</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>