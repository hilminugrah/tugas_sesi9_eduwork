<?php
include 'db.php';

// Hapus produk dari keranjang
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: cart.php");
}

// Update kuantitas
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$product_id] = $quantity;
    header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Keranjang Belanja</title>
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
        <h1>Keranjang Belanja</h1>
        <a href="index.php" class="btn btn-primary mb-3">Kembali ke Produk</a>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Keranjang Anda kosong.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kuantitas</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalHarga = 0;
                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        $sql = "SELECT * FROM products WHERE id = $product_id";
                        $result = $conn->query($sql);
                        $product = $result->fetch_assoc();
                        $subtotal = $product['price'] * $quantity;
                        $totalHarga += $subtotal;
                    ?>
                        <tr>
                            <td><img src="uploads/<?= $product['image'] ?>" width="80"></td>
                            <td><?= $product['name'] ?></td>
                            <td>Rp <?= number_format($product['price'], 2) ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="number" name="quantity" value="<?= $quantity ?>" min="1">
                                    <button type="submit" name="update_quantity" class="btn btn-sm btn-success">Update</button>
                                </form>
                            </td>
                            <td>Rp <?= number_format($subtotal, 2) ?></td>
                            <td>
                                <a href="cart.php?remove=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h4>Total Harga: Rp <?= number_format($totalHarga, 2) ?></h4>
        <?php endif; ?>
    </div>
</body>
</html>
