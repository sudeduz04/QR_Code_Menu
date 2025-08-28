
<?php 
include 'auth_check.php';
include("../db.php"); 
include("layout/header.php"); 

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    
    $imageName = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time().'_'.$_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/".$imageName);
    }

    $conn->query("INSERT INTO categories (name, image) VALUES ('$name', '$imageName')");
    echo '<div class="alert alert-success">Kategori başarıyla eklendi.</div>';
    echo '<meta http-equiv="refresh" content="2;url=categories.php">';
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Kategori Ekle</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Kategori Adı</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Kategori adı" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Kategori Resmi</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" name="save" class="btn btn-primary w-100">Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>
