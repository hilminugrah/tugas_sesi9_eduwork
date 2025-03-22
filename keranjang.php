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
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <title>Produk - E-Commerce</title>
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
        <a href="cart.php" class="btn btn-primary mb-3">Lihat Keranjang (<?= array_sum($_SESSION['cart']) ?>)</a>
        <a href="index.php" class="btn btn-primary mb-3">ke tambah produk</a>

        <div class="row">
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="uploads/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['name'] ?>" style="height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text">Rp <?= number_format($row['price'], 2) ?></p>
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="add_to_cart" class="btn btn-primary">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
