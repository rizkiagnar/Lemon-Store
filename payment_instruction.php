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
    <title>Instruksi Pembayaran - Lemon Gadget</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .instruction-card {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .amount-display {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark);
            margin: 20px 0;
        }
    </style>
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

    <div class="container">
        <h2 style="text-align: center; margin-top: 2rem;">Selesaikan Pembayaran</h2>

        <div class="instruction-card">
            <?php if ($method == 'QRIS'): ?>
                <h3>Scan QRIS</h3>
                <div
                    style="background: #f8f9fa; display: inline-block; padding: 20px; border-radius: 10px; border: 2px dashed #ddd; margin: 20px 0;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png"
                        alt="QRIS Code" style="width: 200px; height: 200px; object-fit: contain;">
                </div>
                <p style="color: #666;">Scan kode di atas menggunakan E-Wallet Anda.</p>
                <div class="amount-display">Rp
                    <?= number_format($total_bayar); ?>
                </div>

            <?php elseif ($method == 'Debit'): ?>
                <h3><i class="fas fa-university"></i> Transfer Bank</h3>
                <p style="margin-top:10px;">Silakan transfer ke salah satu rekening berikut:</p>

                <div
                    style="text-align: left; margin-top: 20px; background: #f0f8ff; padding: 15px; border-radius: 8px; border-left: 5px solid #3498db;">
                    <p style="font-size: 0.9rem; margin-bottom: 5px;">Bank BCA</p>
                    <strong style="font-size: 1.2rem;">123-456-7890</strong>
                    <p style="font-size: 0.8rem; margin-top: 5px;">a.n Lemon Gadget Store</p>
                </div>

                <div
                    style="text-align: left; margin-top: 15px; background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 5px solid #ffc107;">
                    <p style="font-size: 0.9rem; margin-bottom: 5px;">Bank Mandiri</p>
                    <strong style="font-size: 1.2rem;">987-654-3210</strong>
                    <p style="font-size: 0.8rem; margin-top: 5px;">a.n Lemon Gadget Store</p>
                </div>

                <div class="amount-display">Total: Rp
                    <?= number_format($total_bayar); ?>
                </div>

            <?php else: ?>
                <i class="fas fa-box-open" style="font-size: 4rem; color: #27ae60; margin-bottom: 20px;"></i>
                <h3>Cash On Delivery</h3>
                <p>Pesanan Anda siap diproses.</p>
                <p style="margin: 20px 0; color: #666;">
                    Siapkan uang tunai sebesar<br><strong style="font-size: 1.4rem; color:var(--dark)">Rp
                        <?= number_format($total_bayar); ?>
                    </strong><br>saat kurir tiba.
                </p>
            <?php endif; ?>

            <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #eee;">

            <a href="success.php?tid=<?= $tid; ?>&method=<?= $method; ?>" class="btn add"
                style="width: 100%; display: block; text-align: center;">
                <i class="fas fa-check-circle"></i> Saya Sudah Bayar / Konfirmasi
            </a>
        </div>
    </div>
</body>

</html>