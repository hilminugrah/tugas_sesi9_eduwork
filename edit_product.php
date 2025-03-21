<?php
include 'db.php';

// Ambil data produk berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
}

// Proses Update Produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Cek jika user upload gambar baru
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE products SET name='$name', price='$price', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Edit Produk</title>
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
     <!-- end navbar -->
    <div class="container mt-5">
        <h1>Edit Produk</h1>
        <a href="index.php" class="btn btn-primary mb-3">Kembali</a>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" class="form-control" name="name" value="<?= $product['name'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Produk (Rp)</label>
                <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Produk</label>
                <textarea class="form-control" name="description" rows="4"><?= $product['description'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" name="image">
                <?php if ($product['image']): ?>
                    <p class="mt-2">Gambar Saat Ini:</p>
                    <img src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="150">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>


