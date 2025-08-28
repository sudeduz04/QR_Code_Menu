<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">QR Menü Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarYonetimDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Yönetim
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarYonetimDropdown">
                            <li><a class="dropdown-item" href="index.php">Ürünler</a></li>
                            <li><a class="dropdown-item" href="categories.php">Kategoriler</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarEkleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ekle
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarEkleDropdown">
                            <li><a class="dropdown-item" href="add_product.php">Ürün Ekle</a></li>
                            <li><a class="dropdown-item" href="add_category.php">Kategori Ekle</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php" target="_blank">Siteyi Göster</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
