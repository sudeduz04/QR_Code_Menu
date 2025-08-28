<?php
require_once "db.php";

$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
if ($category_id == 0) { header("Location: index.php"); exit(); }

$category_result = $conn->query("SELECT * FROM categories WHERE id = $category_id");
if ($category_result->num_rows == 0) { header("Location: index.php"); exit(); }
$category = $category_result->fetch_assoc();

$products_result = $conn->query("SELECT * FROM products WHERE category_id = $category_id ORDER BY name ASC");
$products = [];
while ($row = $products_result->fetch_assoc()) {
    $products[] = $row;
}

$pageTitle = htmlspecialchars($category['name']) . " - Ürünler";
include "layout/header.php";

// Kategori resmini hero alanı arkaplanı olarak kullan
$hero_bg_image = $category['image'] ? 'uploads/' . htmlspecialchars($category['image']) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop';
?>

<header class="hero-section" style="background-image: url('<?php echo $hero_bg_image; ?>');">
    <div class="container">
        <h1 class="hero-title"><?php echo htmlspecialchars($category['name']); ?></h1>
        <p class="hero-subtitle">Bu kategorideki özel lezzetlerimiz</p>
    </div>
</header>

<div class="container py-5">
    <a href="index.php" class="back-link">&larr; Tüm Kategoriler</a>

    <div class="product-list">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img src="uploads/<?php echo htmlspecialchars($product['image'] ?? 'placeholder.jpg'); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                <div class="product-details">
                    <h5 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
                <div class="product-price">
                    <?php echo number_format($product['price'], 2); ?> ₺
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-dark text-center">Bu kategoride henüz ürün bulunmamaktadır.</div>
        <?php endif; ?>
    </div>
</div>

<?php include "layout/footer.php"; ?>