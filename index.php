<?php
session_start();
include 'db.php';
// Inisialisasi cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lemon Gadget store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="header-flex">
            <div class="logo-group">
                <img src="img/Lemon.png" alt="Logo">
                <p class="logo"><span>Lemon</span>Store</p>
            </div>
            <nav class="nav-card">
                <a href="products.php">Shop</a>
                <a href="login_admin.php">Login Admin</a>
            </nav>
        </div>
    </header>


    <div class="container text-center"
        style="padding: 4rem 1rem; background: linear-gradient(to right, #fff, #f9f9f9);">
        <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--dark);">Upgrade Gadget Impianmu Hari Ini!</h1>
        <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">
            Temukan koleksi Smartphone, Laptop, dan Aksesoris terbaru dengan harga terbaik dan garansi resmi.
        </p>
        <a href="products.php" class="btn add"
            style="padding: 12px 30px; font-size: 1.2rem; border-radius: 50px; box-shadow: 0 4px 15px rgba(241, 196, 15, 0.4);">
            <i class="fas fa-shopping-bag"></i> Mulai Belanja
        </a>
    </div>
    <h2>Kategori Pilihan</h2>
    <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
        <div
            style="flex: 1; min-width: 250px; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <i class="fas fa-mobile-alt" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h3>Smartphone</h3>
            <p>iPhone, Sharma, & Android terbaru dengan harga terbaik.</p>
        </div>
        <div
            style="flex: 1; min-width: 250px; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <i class="fas fa-laptop" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h3>Laptop</h3>
            <p>Laptop kerja, gaming, dan ultrabook untuk produktivitas Anda.</p>
        </div>
        <div
            style="flex: 1; min-width: 250px; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <i class="fas fa-headphones-alt" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
            <h3>Aksesoris</h3>
            <p>Headset, Powerbank, dan Casing original bergaransi.</p>
        </div>
    </div>

    <div
        style="margin-top: 4rem; text-align: left; background: white; padding: 3rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
            <div style="flex: 1;">
                <h2 style="text-align: left;">Tentang Lemon Store</h2>
                <p style="line-height: 1.6; color: #555;">
                    Lemon Store adalah pusat belanja elektronik terpercaya yang menyediakan berbagai macam
                    gadget terkini.
                    Kami berkomitmen untuk memberikan produk <strong>100% Original</strong> dengan <strong>Garansi
                        Resmi</strong>.
                    Nikmati pengalaman berbelanja yang aman, cepat, dan nyaman bersama kami.
                </p>
                <ul style="margin-top: 1rem; list-style: none;">
                    <li><i class="fas fa-check" style="color: var(--success); margin-right: 10px;"></i> Stok Selalu
                        Update</li>
                    <li><i class="fas fa-check" style="color: var(--success); margin-right: 10px;"></i> Layanan
                        Purna Jual Terbaik</li>
                    <li><i class="fas fa-check" style="color: var(--success); margin-right: 10px;"></i> Pengiriman
                        Aman ke Seluruh Indonesia</li>
                </ul>
            </div>
            <div style="flex: 1; text-align: center;">
                <img src="img/Lemon.png" style="width: 100%; border-radius: 10px;" alt="Gadget Store">
            </div>
        </div>
    </div>
    </div>

    <footer style="text-align: center; padding: 2rem; background: #333; color: white; margin-top: 3rem;">
        <p>&copy; 2026 LemonStore. All rights reserved.</p>
    </footer>
</body>

</html>