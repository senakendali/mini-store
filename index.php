<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers.php';

$products = [];
$transactions = [];

// STEP 2: Read Data
// TODO:
// Jika koneksi database sudah aktif, ambil data dari table products dan transactions.
// Hint products:
// $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
// $products = $stmt->fetchAll();
//
// Hint transactions:
// $stmt = $pdo->query("SELECT * FROM transactions ORDER BY id DESC");
// $transactions = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Store Transaction Flow</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="hero">
        <div class="container">
            <div class="hero-card">
                <div>
                    <span class="badge">CRUD & Data Flow Practice</span>
                    <h1>Mini Store Transaction Flow</h1>
                    <p>
                        Practice CRUD, data lifecycle, transaction flow, stock validation, and automatic stock reduction using PHP and MySQL.
                    </p>
                </div>
                <div class="flow-box">
                    <h3>Transaction Flow</h3>
                    <div class="flow-list">
                        <div class="flow-item">1. Select product</div>
                        <div class="flow-item">2. Input quantity</div>
                        <div class="flow-item">3. Validate stock</div>
                        <div class="flow-item">4. Save transaction</div>
                        <div class="flow-item">5. Reduce stock</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">
        <?php if (isset($_GET['message'])): ?>
            <div class="flash <?= e($_GET['type'] ?? 'info') ?>">
                <?= e($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <?php if (!$pdo): ?>
            <div class="flash info">
                Database connection is not active yet. Start from <strong>config/database.php</strong>.
            </div>
        <?php endif; ?>

        <section class="section grid-3">
            <div class="card concept-card">
                <strong>CRUD Concept</strong>
                <p class="muted">Create, read, update, and delete product data from database.</p>
            </div>
            <div class="card concept-card">
                <strong>Data Lifecycle</strong>
                <p class="muted">Input data, save to database, display to UI, process transaction, then update stock.</p>
            </div>
            <div class="card concept-card">
                <strong>Business Logic</strong>
                <p class="muted">Validate stock before saving transaction to prevent wrong process.</p>
            </div>
        </section>

        <section class="section grid-2">
            <div class="card">
                <h2>Add Product</h2>
                <p class="muted">Practice create data by sending form input to PHP.</p>

                <form action="actions/create-product.php" method="POST">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" placeholder="Example: Kopi Susu">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" placeholder="Example: 15000">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" placeholder="Example: 10">
                    </div>

                    <button class="btn btn-primary" type="submit">Save Product</button>
                </form>
            </div>

            <div class="card">
                <h2>Product Data</h2>
                <p class="muted">Practice read, update, and delete product data.</p>

                <?php if (empty($products)): ?>
                    <div class="empty-state">No product data yet. Complete the read logic in <strong>index.php</strong>.</div>
                <?php else: ?>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $index => $product): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= e($product['name']) ?></td>
                                        <td><?= formatRupiah((int) $product['price']) ?></td>
                                        <td>
                                            <span class="stock-pill <?= ((int) $product['stock'] <= 3) ? 'stock-low' : '' ?>">
                                                <?= (int) $product['stock'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="button-row">
                                                <a class="btn btn-warning" href="edit-product.php?id=<?= (int) $product['id'] ?>">Edit</a>
                                                <form action="actions/delete-product.php" method="POST" onsubmit="return confirm('Delete this product?')">
                                                    <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="section grid-2">
            <div class="card">
                <h2>Create Transaction</h2>
                <p class="muted">Practice transaction flow, stock validation, and automatic stock reduction.</p>

                <form action="actions/create-transaction.php" method="POST">
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select id="product_id" name="product_id">
                            <option value="">Select product</option>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= (int) $product['id'] ?>">
                                    <?= e($product['name']) ?> — Stock: <?= (int) $product['stock'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Example: 2">
                    </div>

                    <button class="btn btn-primary" type="submit">Create Transaction</button>
                </form>
            </div>

            <div class="card">
                <h2>Transaction History</h2>
                <p class="muted">Each valid transaction will be stored and displayed here.</p>

                <?php if (empty($transactions)): ?>
                    <div class="empty-state">No transaction data yet.</div>
                <?php else: ?>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $index => $transaction): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= e($transaction['product_name']) ?></td>
                                        <td><?= (int) $transaction['quantity'] ?></td>
                                        <td><?= formatRupiah((int) $transaction['price']) ?></td>
                                        <td><?= formatRupiah((int) $transaction['total_price']) ?></td>
                                        <td><?= e($transaction['created_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="section card">
            <h2>Logical Thinking Practice</h2>
            <p class="muted">Before writing transaction code, explain the process first.</p>
            <div class="code-note">
                User selects product → User enters quantity → PHP reads product data → System validates stock → If stock is enough, transaction is saved → Product stock is reduced → UI shows updated data
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">FlexLabs Software Engineering Practice</div>
    </footer>
</body>
</html>
