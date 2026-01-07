<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin']))
    header('Location: login_admin.php');
$trs = mysqli_query($conn, "SELECT * FROM transactions ORDER BY date DESC");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Transaksi - Admin</title>
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
        <h2>Riwayat Transaksi</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Metode Bayar</th>
                        <th>Total Belanja</th>
                        <th>Detail Item</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($t = mysqli_fetch_assoc($trs)): ?>
                        <tr>
                            <td>#<?= $t['id']; ?></td>
                            <td><?= date('d M Y H:i', strtotime($t['date'])); ?></td>
                            <td>
                                <span
                                    style="padding: 4px 8px; border-radius: 4px; background: #eee; font-weight: bold; font-size: 0.9rem;">
                                    <?= isset($t['payment_method']) ? $t['payment_method'] : 'Cash'; ?>
                                </span>
                            </td>
                            <td style="font-weight:bold; color:var(--dark)">Rp <?= number_format($t['total']); ?></td>
                            <td>
                                <ul style="list-style:none; padding:0; margin:0">
                                    <?php
                                    $d = mysqli_query($conn, "SELECT * FROM transaction_detail WHERE transaction_id=$t[id]");
                                    while ($x = mysqli_fetch_assoc($d)) {
                                        echo "<li style='border-bottom:1px solid #eee; padding:5px 0;'>$x[product_name] <span style='color:#777'>($x[qty]x)</span></li>";
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="admin.php" class="btn remove"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </div>
</body>

</html>