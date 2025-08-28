<?php
include "db.php";

$categories_result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
$categories = [];
while ($row = $categories_result->fetch_assoc()) {
    $categories[] = $row;
}

$pageTitle = "Restoran Menüsü";
include "layout/header.php"; 
?>

<header class="hero-section" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1974&auto=format&fit=crop');">
    <div class="container">
        <h1 class="hero-title">Lezzet Keşfi</h1>
        <p class="hero-subtitle">Damak zevkinize uygun kategorilerimizi inceleyin</p>
    </div>
</header>

<div class="container py-5">
    <div class="row g-4 g-lg-5">
        <?php if (count($categories) > 0): ?>
            <?php foreach ($categories as $category): ?>
            <div class="col-md-6 col-lg-4">
                <a href="menu.php?category_id=<?php echo $category['id']; ?>" class="card category-card text-white text-decoration-none">
                    <img src="uploads/<?php echo htmlspecialchars($category['image'] ?? 'placeholder.jpg'); ?>" class="card-img" alt="<?php echo htmlspecialchars($category['name']); ?>">
                    <div class="card-img-overlay">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-dark text-center">Henüz hiç kategori eklenmemiş.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include "layout/footer.php"; ?>