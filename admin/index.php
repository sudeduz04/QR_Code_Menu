<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

// İstatistikleri çek
$total_products = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$total_categories = $conn->query("SELECT COUNT(*) as count FROM categories")->fetch_assoc()['count'];

// Silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Önce resim dosyasını bulup silmek daha iyi bir pratiktir
    $res = $conn->query("SELECT image FROM products WHERE id=$delete_id");
    if ($res->num_rows > 0) {
        $image_to_delete = $res->fetch_assoc()['image'];
        if ($image_to_delete && file_exists("../uploads/" . $image_to_delete)) {
            unlink("../uploads/" . $image_to_delete);
        }
    }

    $conn->query("DELETE FROM products WHERE id=$delete_id");
    echo '<div class="alert alert-success">Ürün başarıyla silindi.</div>';
    // Sayfanın yeniden yönlendirilmesi, silme işleminden sonra temiz bir URL sağlar.
    echo '<meta http-equiv="refresh" content="2;url=index.php">';
}
?>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card text-white bg-primary shadow-sm h-100">
            <div class="card-body text-center">
                <h1 class="display-4"><i class="bi bi-box-seam"></i></h1>
                <h5 class="card-title">Toplam Ürün</h5>
                <p class="card-text fs-2 fw-bold"><?php echo $total_products; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card text-white bg-success shadow-sm h-100">
            <div class="card-body text-center">
                <h1 class="display-4"><i class="bi bi-tags"></i></h1>
                <h5 class="card-title">Toplam Kategori</h5>
                <p class="card-text fs-2 fw-bold"><?php echo $total_categories; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Ürün Listesi</h4>
        <a href="add_product.php" class="btn btn-primary btn-sm">+ Yeni Ürün Ekle</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Resim</th>
                    <th>Ürün Adı</th>
                    <th>Fiyat</th>
                    <th>Kategori</th>
                    <th class="text-center">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <?php if($row['image']): ?>
                        <img src="../uploads/<?php echo $row['image']; ?>" width="50" class="img-thumbnail">
                        <?php else: ?>
                        <span class="text-muted">Resim Yok</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['price']; ?> ₺</td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td class="text-center">
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Düzenle</a>
                        <a href="index.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?');"><i class="bi bi-trash"></i> Sil</a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-muted'>Henüz ürün eklenmemiş.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("layout/footer.php"); ?>
