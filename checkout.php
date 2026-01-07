<?php
session_start();
include 'db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: products.php");
    exit;
}

// 1. Calculate Total
$grand = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $id = (int) $id;
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    if ($query && mysqli_num_rows($query) > 0) {
        $p = mysqli_fetch_assoc($query);
        $grand += $p['price'] * $qty;
    }
}

// 2. Get Payment Method
$payment_method = isset($_POST['payment_method']) ? mysqli_real_escape_string($conn, $_POST['payment_method']) : 'Cash';

// 3. Self-Healing: Check if 'payment_method' column exists, if not add it
$check_col = mysqli_query($conn, "SHOW COLUMNS FROM transactions LIKE 'payment_method'");
if (mysqli_num_rows($check_col) == 0) {
    mysqli_query($conn, "ALTER TABLE transactions ADD COLUMN payment_method VARCHAR(50) NOT NULL DEFAULT 'Cash' AFTER total");
}

// 4. Insert Transaction
$insert_trx = "INSERT INTO transactions (date, total, payment_method) VALUES (NOW(), '$grand', '$payment_method')";
if (mysqli_query($conn, $insert_trx)) {
    $tid = mysqli_insert_id($conn);

    // 5. Insert Details
    foreach ($_SESSION['cart'] as $id => $qty) {
        $id = (int) $id;
        $q_prod = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
        if ($q_prod && mysqli_num_rows($q_prod) > 0) {
            $p = mysqli_fetch_assoc($q_prod);
            $pname = mysqli_real_escape_string($conn, $p['name']);
            $price = $p['price'];
            mysqli_query($conn, "INSERT INTO transaction_detail (transaction_id, product_name, qty, price)
                                 VALUES ('$tid', '$pname', '$qty', '$price')");
        }
    }

    // 6. Clear Cart & Redirect
    unset($_SESSION['cart']);
    header("Location: payment_instruction.php?method=$payment_method&tid=$tid");
    exit;
} else {
    // Fallback: If error is still about column, try one last force fix or die with message
    echo "Error processing transaction: " . mysqli_error($conn);
    // Attempt to debug
    echo "<br>Trying to fix database... Refresh page.";
    mysqli_query($conn, "ALTER TABLE transactions ADD COLUMN payment_method VARCHAR(50) NOT NULL DEFAULT 'Cash'");
}
?>