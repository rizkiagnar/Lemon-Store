<?php
include 'db.php';

function uploadImage()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah ada gambar yang diupload
    if ($error === 4) {
        return 'default.jpg';
    }

    // Cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang anda upload bukan gambar!');</script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar (contoh 2MB)
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }

    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // Pastikan folder img ada
    if (!file_exists('img')) {
        mkdir('img', 0777, true);
    }

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = (int) $_POST['price'];

    $gambar = uploadImage();
    if (!$gambar) {
        // Jika gagal upload (validasi)
        echo "<script>alert('Gagal upload gambar!'); window.location.href='admin.php';</script>";
        exit;
    }

    $query = "INSERT INTO products (name, price, gambar) VALUES ('$name', '$price', '$gambar')";
    if (mysqli_query($conn, $query)) {
        header('Location: admin.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['update'])) {
    $id = (int) $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = (int) $_POST['price'];
    $gambarLama = $_POST['gambarLama'];

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadImage();
        if (!$gambar) {
            echo "<script>alert('Gagal upload gambar baru!'); window.location.href='edit_product.php?id=$id';</script>";
            exit;
        }
    }

    $query = "UPDATE products SET name='$name', price='$price', gambar='$gambar' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header('Location: admin.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // Hapus file gambar dari folder
    $q = mysqli_query($conn, "SELECT gambar FROM products WHERE id=$id");
    $data = mysqli_fetch_assoc($q);
    if ($data && $data['gambar'] != 'default.jpg' && file_exists("img/" . $data['gambar'])) {
        unlink("img/" . $data['gambar']);
    }

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header('Location: admin.php');
}
?>