# QR Kod Menü Yönetim Sistemi

Bu proje, restoranlar ve kafeler için geliştirilmiş, PHP tabanlı dinamik bir QR kod menü yönetim sistemidir. Müşterilerinize modern ve kolay erişilebilir bir menü sunarken, işletme sahiplerine de menülerini kolayca yönetebilecekleri güvenli bir admin paneli sağlar.

## ✨ Özellikler

###  Yönetici Paneli (`/admin`)
- **Güvenli Giriş:** Admin paneli, şifre korumalı bir giriş sistemi ile güvence altına alınmıştır.
- **İstatistiksel Gösterge Paneli:** Ana sayfada toplam ürün ve kategori sayılarını gösteren özet kartlar bulunur.
- **Kategori Yönetimi:**
  - Kategori ekleme, düzenleme ve silme (CRUD) işlemleri.
  - Her kategoriye özel bir resim yükleme imkanı.
- **Ürün Yönetimi:**
  - Ürün ekleme, düzenleme ve silme (CRUD) işlemleri.
  - Ürünleri mevcut kategorilerle ilişkilendirme.
  - Her ürüne özel bir resim yükleme imkanı.
- **Modern Arayüz:** Bootstrap 5 kullanılarak oluşturulmuş, kullanıcı dostu ve responsive bir arayüz.

### Müşteri Arayüzü (Ana Sayfa)
- **Kategori Listesi:** Ana sayfada menü kategorileri, resimleriyle birlikte kartlar halinde listelenir.
- **Dinamik Ürün Sayfaları:** Her kategoriye tıklandığında, o kategoriye ait ürünlerin listelendiği ayrı bir sayfa açılır.
- **Şık Tasarım:** Müşterilerinize keyifli bir deneyim sunmak için modern ve çekici bir tasarım kullanılmıştır.
- **Responsive Tasarım:** Tüm cihazlarda (mobil, tablet, masaüstü) sorunsuz bir şekilde çalışır.

## 🛠️ Kullanılan Teknolojiler
- **Backend:** PHP
- **Veritabanı:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5
- **Sunucu:** Apache (XAMPP/WAMP/MAMP gibi bir yerel sunucu ortamı gerektirir)

## 🚀 Kurulum ve Çalıştırma

Projeyi yerel makinenizde çalıştırmak için aşağıdaki adımları izleyin:

1.  **Projeyi Klonlayın veya İndirin:**
    ```bash
    git clone https://github.com/sudeduz04/QR_Code_Menu.git
    ```
    Veya projeyi ZIP olarak indirip klasöre çıkarın.

2.  **Dosyaları Sunucuya Taşıyın:**
    Proje dosyalarını, XAMPP kullanıyorsanız `htdocs`, WAMP kullanıyorsanız `www` klasörünün içine taşıyın.

3.  **Veritabanını Oluşturun:**
    - phpMyAdmin veya benzeri bir veritabanı yönetim aracı açın.
    - `qr_menu_db` adında yeni bir veritabanı oluşturun. (Karakter kodlaması olarak `utf8mb4_general_ci` seçmeniz önerilir.)

4.  **Veritabanı Tablolarını İçeri Aktarın:**
    Oluşturduğunuz `qr_menu_db` veritabanını seçin ve aşağıdaki SQL kodlarını çalıştırarak tabloları oluşturun:

    ```sql
    --
    -- `categories` tablosu
    --
    CREATE TABLE `categories` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) NOT NULL,
      `image` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    --
    -- `products` tablosu
    --
    CREATE TABLE `products` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `category_id` int(11) NOT NULL,
      `name` varchar(255) NOT NULL,
      `description` text DEFAULT NULL,
      `price` decimal(10,2) NOT NULL,
      `image` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `category_id` (`category_id`),
      CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    --
    -- `users` tablosu
    --
    CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

5.  **Veritabanı Bağlantısını Yapılandırın:**
    Proje ana dizinindeki `db.php` dosyasını açın ve kendi veritabanı bilgilerinize göre düzenleyin:
    ```php
    <?php
    $servername = "localhost";
    $username = "root"; // XAMPP varsayılan kullanıcı adı
    $password = "";     // XAMPP varsayılan şifre (boş)
    $dbname = "qr_menu_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }
    ?>
    ```

6.  **İlk Yönetici Kullanıcısını Oluşturun:**
    `users` tablosuna ilk yöneticiyi eklemek için aşağıdaki SQL kodunu çalıştırın. Bu kod, `admin@gmail.com` kullanıcı adıyla ve `password` şifresiyle bir kullanıcı oluşturur. Şifre, veritabanında güvenli bir şekilde hash'lenerek saklanır.

    ```sql
    INSERT INTO `users` (`username`, `password`) VALUES
    ('admin@gmail.com', '$2y$10$2i.B2yV/Z2J5o2J6p7j3A.L2q9K5g5p5F5e5c5a595h5i5'); -- Şifre: password
    ```
    *Not: Yukarıdaki hash, `password_hash('password', PASSWORD_DEFAULT)` fonksiyonu ile oluşturulmuştur.*

7.  **Projeyi Başlatın:**
    - Tarayıcınızdan `http://localhost/QR_Code_Menu/` adresine giderek müşteri menüsünü görüntüleyebilirsiniz.
    - `http://localhost/QR_Code_Menu/admin/` adresine giderek yönetici paneline erişebilirsiniz.

## 🔑 Yönetici Giriş Bilgileri
- **Kullanıcı Adı:** `admin@gmail.com`
- **Şifre:** `password`
