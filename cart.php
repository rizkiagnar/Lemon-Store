<?php
session_start();
$id = (int) $_POST['id'];
if (!isset($_SESSION['cart'][$id]))
    $_SESSION['cart'][$id] = 0;
if (isset($_POST['add']))
    $_SESSION['cart'][$id]++;
if (isset($_POST['remove']) && $_SESSION['cart'][$id] > 0)
    $_SESSION['cart'][$id]--;
header("Location: products.php");
?>