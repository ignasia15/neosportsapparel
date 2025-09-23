<?php
// Koneksi ke database
include "inc/koneksi.php";

// Kode 9 digit otomatis
$carikode = mysqli_query($koneksi, "SELECT id_buku FROM tb_buku ORDER BY id_buku DESC");
$datakode = mysqli_fetch_array($carikode);
$kode = isset($datakode['id_buku']) ? $datakode['id_buku'] : 'B000'; 
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1) {
    $format = "B00" . $tambah;
} else if (strlen($tambah) == 2) {
    $format = "B0" . $tambah;
} else {
    $format = "B" . $tambah;
}
?>

<section class="content-header">
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Buku</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>ID Buku</label>
                            <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $format; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku" required>
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" id="pengarang" class="form-control" placeholder="Nama Pengarang" required>
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" placeholder="Penerbit" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="th_terbit" id="th_terbit" class="form-control" placeholder="Tahun Terbit" required>
                        </div>

                        <div class="form-group">
                            <label>Kategori Buku</label>
                            <select name="kategori_buku" id="kategori_buku" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <?php
                                // Ambil data kategori dari tabel kategori_buku
                                $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                                while ($kategori = mysqli_fetch_array($query_kategori)) {
                                    echo "<option value='".$kategori['id_kategori']."'>".$kategori['kategori']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Stok Buku</label>
                            <input type="text" name="stok" id="stok" class="form-control" placeholder="Jumlah Stok" required>
                        </div>

                        <div class="form-group">
                            <label>Gambar Buku</label>
                            <input type="file" name="gambar" id="gambar" class="form-control">
                        </div>
                    </div>

                    <div class="box-footer">
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                        <a href="?page=MyApp/data_buku" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['Simpan'])) {
    $id_buku = $_POST['id_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $th_terbit = $_POST['th_terbit'];
    $kategori_buku = $_POST['kategori_buku'];
    $stok = $_POST['stok'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    if ($gambar) {
        $target_dir = "dist/img/";
        $target_file = $target_dir . basename($gambar);
        
        // Pastikan file yang diupload adalah gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (in_array($imageFileType, $allowed_extensions)) {
            // Pindahkan file gambar ke folder dist/img/
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                // Masukkan data ke tabel tb_buku
                $sql_simpan = "INSERT INTO tb_buku (id_buku, judul_buku, pengarang, penerbit, th_terbit, kategori, stok, gambar) 
                               VALUES ('$id_buku', '$judul_buku', '$pengarang', '$penerbit', '$th_terbit', '$kategori', '$stok', '$gambar')";
            } else {
                // Gagal upload
                echo "<script>
                    Swal.fire({title: 'Upload Gambar Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=MyApp/add_buku';
                        }
                    })</script>";
                exit;
            }
        } else {
            echo "<script>
                Swal.fire({title: 'Format Gambar Tidak Dikenal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=MyApp/add_buku';
                    }
                })</script>";
            exit;
        }
    } else {
        // Jika tidak ada gambar yang diupload
        $sql_simpan = "INSERT INTO tb_buku (id_buku, judul_buku, pengarang, penerbit, th_terbit, kategori, stok, gambar) 
                       VALUES ('$id_buku', '$judul_buku', '$pengarang', '$penerbit', '$th_terbit', '$kategori', '$stok', '$gambar')";
    }

    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_buku';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_buku';
            }
        })</script>";
    }
}
?>