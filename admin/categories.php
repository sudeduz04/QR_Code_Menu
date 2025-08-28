<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

// Kategori silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Önce resim dosyasını bulup sil
    $res = $conn->query("SELECT image FROM categories WHERE id=$delete_id");
    if ($res->num_rows > 0) {
        $image_to_delete = $res->fetch_assoc()['image'];
        if ($image_to_delete && file_exists("../uploads/" . $image_to_delete)) {
            unlink("../uploads/" . $image_to_delete);
        }
    }

    $conn->query("DELETE FROM categories WHERE id=$delete_id");
    echo '<div class="alert alert-success">Kategori başarıyla silindi.</div>';
    echo '<meta http-equiv="refresh" content="2;url=categories.php">';
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Kategori Yönetimi</h2>
    <a href="add_category.php" class="btn btn-primary btn-sm">+ Yeni Kategori Ekle</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Resim</th>
                    <th>Kategori Adı</th>
                    <th class="text-center">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
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
                    <td class="text-center">
                        <a href="edit_category.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Düzenle</a>
                        <a href="categories.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bu kategoriyi ve içindeki tüm ürünleri silmek istediğinizden emin misiniz?');"><i class="bi bi-trash"></i> Sil</a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center text-muted'>Henüz kategori eklenmemiş.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("layout/footer.php"); ?>
