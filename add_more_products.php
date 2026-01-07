<?php
include 'db.php';

$products = [
    // Laptops
    ['MacBook Air M3', 18999000, 'macbook_m3.png'],
    ['ASUS ROG Zephyrus G14', 28500000, 'rog_g14.png'],
    ['Lenovo Legion Slim 7', 24999000, 'legion_7.png'],
    ['Acer Swift Go 14', 12499000, 'swift_go.png'],

    // Accessories
    ['Sony WH-1000XM5', 4999000, 'sony_xm5.png'],
    ['Samsung Galaxy Watch 6', 3999000, 'watch_6.png'],
    ['Anker 737 PowerBank', 1999000, 'anker_pb.png'],
    ['Logitech MX Master 3S', 1699000, 'mx_master.png']
];

echo "<h3>Menambahkan Produk Baru...</h3><ul>";

foreach ($products as $p) {
    $name = mysqli_real_escape_string($conn, $p[0]);
    $price = $p[1];
    $img = $p[2];

    // Check if distinct
    $check = mysqli_query($conn, "SELECT id FROM products WHERE name='$name'");
    if (mysqli_num_rows($check) == 0) {
        $sql = "INSERT INTO products (name, price, gambar) VALUES ('$name', '$price', '$img')";
        if (mysqli_query($conn, $sql)) {
            echo "<li>Berhasil menambahkan: <strong>$name</strong></li>";

            // Create dummy image if not exists
            $target_file = "img/" . $img;
            if (!file_exists($target_file)) {
                if (copy("img/Lemon.png", $target_file)) {
                    echo " - Placeholder image created.";
                }
            }
        } else {
            echo "<li>Gagal menambahkan $name: " . mysqli_error($conn) . "</li>";
        }
    } else {
        echo "<li>$name sudah ada (Skip).</li>";
    }
}
echo "</ul>";
echo "<br><a href='products.php'>Lihat Produk</a>";
?>