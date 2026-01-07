<?php
session_start();
include 'db.php';

$method = isset($_GET['method']) ? $_GET['method'] : 'Cash';
$tid = isset($_GET['tid']) ? (int) $_GET['tid'] : 0;
$total_bayar = 0;

if ($tid > 0) {
    $q = mysqli_query($conn, "SELECT * FROM transactions WHERE id=$tid");
    if ($q && mysqli_num_rows($q) > 0) {
        $trx = mysqli_fetch_assoc($q);
        $total_bayar = $trx['total'];
        if (isset($trx['payment_method'])) {
            $method = $trx['payment_method'];
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pembayaran Berhasil - Lemon Gadget</title>
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
            </nav>
        </div>
    </header>

    <div class="container" style="text-align: center; padding-top: 50px;">
        <div
            style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); max-width: 600px; margin: auto;">
            <i class="fas fa-check-circle" style="font-size: 6rem; color: var(--success); margin-bottom: 20px;"></i>
            <h2 style="color: var(--dark); margin-bottom: 10px;">Pembayaran Terkonfirmasi!</h2>
            <p style="color: #777; font-size: 1.1rem;">Terima kasih, pesanan Anda sedang kami proses.</p>

            <div style="margin-top: 30px; border-top: 2px dashed #eee; padding-top: 20px;">
                <p style="font-size: 0.9rem; color: #888;">Order ID: #<?= $tid; ?></p>
                <h1 style="color: var(--dark); margin: 15px 0;">Rp <?= number_format($total_bayar); ?></h1>

                <div
                    style="display: inline-block; background: #e8f8f5; color: #27ae60; padding: 5px 15px; border-radius: 20px; font-weight: bold; margin-bottom: 15px;">
                    STATUS: LUNAS / SELESAI
                </div>
                <p>Metode Pembayaran: <strong style="color: var(--primary);"><?= $method; ?></strong></p>
            </div>
        </div>

        <br>
        <a href="products.php" class="btn add">Belanja Lagi</a>
    </div>
</body>

</html>