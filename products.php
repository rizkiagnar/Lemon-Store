<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = mysqli_query($conn, "SELECT * FROM products");

// Kelompokkan produk ke dalam 3 kategori
$laptops = [];
$gadgets = [];
$accessories = [];

while ($p = mysqli_fetch_assoc($products)) {
    $name = strtolower($p['name']);

    // Laptop - MacBook, ThinkPad, Swift, ROG, Legion, dll
    if (
        strpos($name, 'macbook') !== false || strpos($name, 'thinkpad') !== false ||
        strpos($name, 'swift') !== false || strpos($name, 'laptop') !== false ||
        strpos($name, 'rog') !== false || strpos($name, 'legion') !== false ||
        strpos($name, 'acer') !== false || strpos($name, 'asus') !== false
    ) {
        $laptops[] = $p;
    }
    // Gadget - Smartphone (iPhone, Samsung, Oppo, Vivo, Xiaomi, dll)
    elseif (
        strpos($name, 'iphone') !== false || strpos($name, 'samsung') !== false ||
        strpos($name, 'galaxy') !== false || strpos($name, 'oppo') !== false ||
        strpos($name, 'vivo') !== false || strpos($name, 'xiaomi') !== false ||
        strpos($name, 'note') !== false || strpos($name, 'ultra') !== false ||
        strpos($name, 'pro') !== false || strpos($name, 'find') !== false
    ) {
        $gadgets[] = $p;
    }
    // Aksesoris - Headphone, Mouse, Keyboard, Watch, Powerbank, dll
    else {
        $accessories[] = $p;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LemonStore - Gadget & Laptop</title>
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
                <a href="index.php">Beranda</a>
                <a href="cart_detail.php">
                    <i class="fas fa-shopping-cart"></i>
                    (<?php echo array_sum($_SESSION['cart']); ?>)
                </a>
            </nav>
        </div>
    </header>

    <!-- LAPTOP & NOTEBOOK -->
    <section class="container" id="laptop">
        <div class="category-header">
            <h2><i class="fas fa-laptop"></i> Laptop & Notebook</h2>
            <p class="text-center">Pilihan performa terbaik untuk profesional dan pelajar.</p>
        </div>
        <div class="produk-grid">
            <?php foreach ($laptops as $p): ?>
                <div class="card">
                    <div class="image-box">
                        <img src="img/<?= $p['gambar']; ?>" alt="<?= $p['name']; ?>">
                    </div>
                    <div class="card-content">
                        <h3><?= $p['name']; ?></h3>
                        <p class="harga">Rp <?= number_format($p['price'], 0, ',', '.'); ?></p>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                            <div class="card-actions">
                                <button type="submit" name="add" class="btn add">Tambah</button>
                                <button type="submit" name="remove" class="btn remove">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- GADGET / SMARTPHONE -->
    <section class="container" id="gadget" style="background-color: #f4f4f4; padding-top: 50px; padding-bottom: 50px;">
        <div class="category-header">
            <h2><i class="fas fa-mobile-alt"></i> Gadget & Smartphone</h2>
            <p class="text-center">iPhone, Samsung, Oppo, Vivo dan brand terpopuler.</p>
        </div>
        <div class="produk-grid">
            <?php foreach ($gadgets as $p): ?>
                <div class="card">
                    <div class="image-box">
                        <img src="img/<?= $p['gambar']; ?>" alt="<?= $p['name']; ?>">
                    </div>
                    <div class="card-content">
                        <h3>
                            <?= $p['name']; ?>
                        </h3>
                        <p class="harga">Rp
                            <?= number_format($p['price'], 0, ',', '.'); ?>
                        </p>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                            <div class="card-actions">
                                <button type="submit" name="add" class="btn add">Tambah</button>
                                <button type="submit" name="remove" class="btn remove">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- AKSESORIS -->
    <section class="container" id="aksesoris">
        <div class="category-header">
            <h2><i class="fas fa-headphones-alt"></i> Aksesoris</h2>
            <p class="text-center">Headphone, Mouse, Keyboard, Powerbank, dan lainnya.</p>
        </div>
        <div class="produk-grid">
            <?php foreach ($accessories as $p): ?>
                <div class="card">
                    <div class="image-box">
                        <img src="img/<?= $p['gambar']; ?>" alt="<?= $p['name']; ?>">
                    </div>
                    <div class="card-content">
                        <h3><?= $p['name']; ?></h3>
                        <p class="harga">Rp <?= number_format($p['price'], 0, ',', '.'); ?></p>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="id" value="<?= $p['id']; ?>">
                            <div class="card-actions">
                                <button type="submit" name="add" class="btn add">Tambah</button>
                                <button type="submit" name="remove" class="btn remove">Hapus</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>

</html>