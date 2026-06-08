<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers.php';

$id = $_GET['id'] ?? null;
$product = null;

// STEP 4: Read Single Product for Edit
// TODO:
// Ambil data product berdasarkan id dari URL.
// Hint:
// $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
// $stmt->execute([$id]);
// $product = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main class="container section">
        <div class="card">
            <div class="button-row" style="justify-content: space-between; margin-bottom: 18px;">
                <div>
                    <h2>Edit Product</h2>
                    <p class="muted">Practice update data from database.</p>
                </div>
                <a class="btn btn-light" href="index.php">Back</a>
            </div>

            <?php if (!$product): ?>
                <div class="empty-state">
                    Product data is not loaded yet. Complete the logic in <strong>edit-product.php</strong>.
                </div>
            <?php else: ?>
                <form action="actions/update-product.php" method="POST">
                    <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">

                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" value="<?= e($product['name']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" value="<?= (int) $product['price'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" value="<?= (int) $product['stock'] ?>">
                    </div>

                    <button class="btn btn-primary" type="submit">Update Product</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
