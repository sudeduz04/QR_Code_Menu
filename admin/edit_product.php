<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

$product_id = $_GET['id'];

// Ürün bilgilerini çek
$result = $conn->query("SELECT * FROM products WHERE id = $product_id");
$product = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cat = $_POST['category_id'];
    
    $imageName = $product['image']; // Mevcut resmi koru
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

    $conn->query("UPDATE products SET 
                    category_id = $cat, 
                    name = '$name', 
                    description = '$desc', 
                    price = $price, 
                    image = '$imageName' 
                  WHERE id = $product_id");

    echo '<div class="alert alert-success">Ürün başarıyla güncellendi.</div>';
    echo '<meta http-equiv="refresh" content="2;url=index.php">';
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Ürün Düzenle</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Ürün Adı</label>
                        <input type="text" name="name" id="product_name" class="form-control" value="<?php echo $product['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea name="description" id="description" class="form-control"><?php echo $product['description']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Fiyat</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Kategori Seçin</option>
                            <?php
                            $cats = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                            while($c = $cats->fetch_assoc()) {
                                $selected = ($c['id'] == $product['category_id']) ? 'selected' : '';
                                echo "<option value='".$c['id']."' $selected>".$c['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ürün Resmi</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small class="form-text text-muted">Mevcut resim: <?php echo $product['image']; ?></small><br>
                        <?php if($product['image']): ?>
                        <img src="../uploads/<?php echo $product['image']; ?>" width="100" class="img-thumbnail mt-2">
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary w-100">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>
