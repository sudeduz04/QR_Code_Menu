
<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cat = $_POST['category_id'];
    
    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time().'_'.$_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/".$imageName);
    }

    $conn->query("INSERT INTO products (category_id, name, description, price, image) 
                  VALUES ($cat, '$name', '$desc', $price, '$imageName')");
    echo '<div class="alert alert-success">Ürün başarıyla eklendi.</div>';
    echo '<meta http-equiv="refresh" content="2;url=index.php">';
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Ürün Ekle</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Ürün Adı</label>
                        <input type="text" name="name" id="product_name" class="form-control" placeholder="Ürün adı" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Açıklama"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Fiyat</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Fiyat" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Kategori Seçin</option>
                            <?php
                            $cats = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                            while($c = $cats->fetch_assoc()) {
                                echo "<option value='".$c['id']."'>".$c['name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Ürün Resmi</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary w-100">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>
