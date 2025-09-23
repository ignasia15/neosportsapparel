<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crudneo";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Sports Apparel</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<!-- navbar -->
<header>
    <a href="#" class="logo"><img src="img/neomerah.png" alt=""></a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#shop">Shop</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
</header>
<!-- home -->
<section class="home" id="home">
    <div class="home-text">
        <span>Welcome To</span>
        <h1>Neo Sports Apparel</h1>
        <h2>Apparel Sahabatmu</h2>
        <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A" class="btn">Join Now</a>
    </div>
    <div class="home-img">
        <img src="img/home.png" alt="">
    </div>
</section>

<!-- about -->
<section class="about" id="about">
    <div class="about-img">
        <img src="img/about.png" alt="">
    </div>
    <div class="about-text">
        <h2>Tentang Neo Sports Apparel</h2>
        <p>NEO SPORTS APPAREL adalah brand usaha jasa penyedia perlengkapan
        olahraga yang berdiri sejak 17 Agustus 2022 di Kepanjen, Kabupaten Malang.
        Fokus pada produksi berbagai macam produk kebutuhan olahraga.
        Sesuai pesanan dan permintaan pembeli.</p>
        <p>Produk kebutuhan olahraga yang dimaksud adalah jersey, celana pendek,
        rompi, tas, sepatu, dan kaos kaki. Sedangkan cabang olahraga meliputi
        sepakbola, futsal, basket, voli, badminton, e-sport, gowes, trail, mancing, dll.</p>
        <a href="https://www.instagram.com/neosportsapparel/" class="btn">Learn More</a>
    </div>
</section>

<!-- produk -->
<section class="shop" id="shop">
    <div class="heading">
        <span>Shop Now</span>
        <h1>Produk Kami</h1>
    </div>
    <div class="shop-container">
        <div class="box">
            <div class="box-img-1">
                <img src="img/jersey.png" alt="">
            </div>
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <h2>Standar</h2>
            <span>Rp 145.000,00</span>
            <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A" class="btn">Order Now</a>
        </div>
        <div class="box">
            <div class="box-img-1">
                <img src="img/jersey.png" alt="">
            </div>
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <h2>Medium</h2>
            <span>Rp 150.000,00</span>
            <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A" class="btn">Order Now</a>
        </div>
        <div class="box">
            <div class="box-img-1">
                <img src="img/jersey.png " alt="">
            </div>
            <div class="stars">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star-half'></i>
            </div>
            <h2>Premium</h2>
            <span>Rp 170.000,00</span>
            <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A" class="btn">Order Now</a>
        </div>
    </div>
</section>

<!-- Katalog -->
<section class="shop" id="shop">
    <div class="heading">
        <span>Shop Now</span>
        <h1>Katalog Kami</h1>
    </div>
    <div class="s-container swiper">
        <div class="slider-wrapper swiper-wrapper">
            <?php
                $sql = "SELECT * FROM tb_barang";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    while ($barang = mysqli_fetch_array($query)) :
            ?>
            <div class="box swiper-slide">
    <div class="box-img">
        <img src="img/<?= $barang['foto']; ?>" alt="" height="150" width="150">
    </div>
    <div class="box-content">
        <div class="stars">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star-half'></i>
        </div>
        <h2><?= $barang['nama']; ?></h2>
        <span><?= $barang['harga']; ?></span>
        <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A" class="btn">Order Now</a>
    </div>
</div>

            <?php
                    endwhile;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            grabCursor: true,
            spaceBetween: 30,
            slidesPerView: 3, /* Mengatur berapa kotak yang tampil sekaligus */
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
            }
        });
    </script>
</section>



<!-- contact -->
<section class="contact" id="contact">
    <div class="social">
        <a href="https://www.instagram.com/neosportsapparel/"><i class='bx bxl-instagram'></i></a>
        <a href="https://www.tiktok.com/@neosportsapparel?lang=en"><i class='bx bxl-tiktok'></i></a>
        <a href="https://api.whatsapp.com/send?phone=6281219193700&text=Halo%20Admin%2C%20mau%20tanya%20dong%0A"><i class='bx bxl-whatsapp'></i></a>
    </div>
    <div class="links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Use</a>
        <a href="#">Our Company</a>
    </div>
    <p>&#169; Neo Sports Apparel 2022</p>
</section>

<script src="js/main.js"></script>
</body>
</html>
