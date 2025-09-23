<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_barang = $_POST['nama'];
    $keterangan_barang = $_POST['keterangan'];
    $harga = $_POST['harga'];

    // Pastikan folder img ada
    if (!file_exists('img')) {
        mkdir('img', 0777, true);
    }

    $foto = $_FILES['foto']['name'];
    $target_dir = 'img/';
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO tb_barang (nama, keterangan, foto, harga) VALUES ('$nama_barang', '$keterangan_barang', '$foto', '$harga')";
        if ($conn->query($sql) === TRUE) {
            header('Location: adminpage.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$result = $conn->query("SELECT * FROM tb_barang");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Tambah Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Nama Barang:</label>
        <input type="text" name="nama" required>
        <label>Keterangan Barang:</label>
        <input type="text" name="keterangan" required>
        <label>Foto:</label>
        <input type="file" name="foto" required>
        <label>Harga:</label>
        <input type="number" name="harga" required>
        <input type="submit" name="submit" value="Tambah">
    </form>

    <h2>Daftar Barang</h2>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Keterangan Barang</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1; // Inisialisasi nomor urut
        while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama']; ?></td>

            <td><?php echo $row['keterangan']; ?></td>
            <td><img src="img/<?php echo $row['foto']; ?>" width="100"></td>
            <td><?php echo $row['harga']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
