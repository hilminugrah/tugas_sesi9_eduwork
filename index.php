<?php
include 'db.php';

// Tambahkan ke keranjang
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1;

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
    echo "<script>alert('Produk berhasil ditambahkan ke keranjang!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>CRUD E-Commerce</title>
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
      </ul>
    </div>
  </div>
</nav>
     <!-- end navbar -->
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Produk</h1>
        <a href="add_product.php" class="btn btn-primary mb-3">Tambah Produk</a>
        <a href="keranjang.php" class="btn btn-primary mb-3">pergi ke keranjang</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='uploads/" . $row['image'] . "' width='100'></td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>Rp " . number_format($row['price'], 2) . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>
                        <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
