<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Upload Gambar
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO products (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Tambah Produk</title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Burger</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Daftar produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="keranjang.php">Keranjang</a>
        </li>
    </div>
  </div>
</nav>
     <!-- end navbar -->
    <div class="container mt-5">
        <h1>Tambah Produk</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Produk</button>
        </form>
    </div>
</body>
</html>
