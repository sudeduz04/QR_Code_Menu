<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

$category_id = $_GET['id'];

// Kategori bilgilerini çek
$result = $conn->query("SELECT * FROM categories WHERE id = $category_id");
$category = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    
    $imageName = $category['image']; // Mevcut resmi koru
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Eski resmi sil
        if ($imageName && file_exists("../uploads/" . $imageName)) {
            unlink("../uploads/" . $imageName);
        }
        // Yeni resmi yükle
        $imageName = time().'_'.$_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/".$imageName);
    }

    $conn->query("UPDATE categories SET name = '$name', image = '$imageName' WHERE id = $category_id");

    echo '<div class="alert alert-success">Kategori başarıyla güncellendi.</div>';
    echo '<meta http-equiv="refresh" content="2;url=categories.php">';
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Kategori Düzenle</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Adı</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $category['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Kategori Resmi</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="form-text text-muted">Mevcut resim: <?php echo $category['image']; ?></small><br>
                        <?php if($category['image']): ?>
                        <img src="../uploads/<?php echo $category['image']; ?>" width="100" class="img-thumbnail mt-2">
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>
