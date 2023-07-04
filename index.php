<?php
// Memulai atau melanjutkan SESSION
session_start();

// Fungsi untuk menambahkan data makanan ke dalam SESSION
function tambahDataMakanan($kode, $nama, $harga, $foto) {
    // Mengecek apakah SESSION 'data_makanan' sudah ada atau belum
    if (!isset($_SESSION['data_makanan'])) {
        $_SESSION['data_makanan'] = array();
    }

    // Menambahkan data makanan ke dalam SESSION sebagai array baru
    $_SESSION['data_makanan'][] = array(
        'kode' => $kode,
        'nama' => $nama,
        'harga' => $harga,
        'foto' => $foto
    );
}

// Memeriksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    $kode_makanan = $_POST['kode_makanan'];
    $nama_makanan = $_POST['nama_makanan'];
    $harga_makanan = $_POST['harga_makanan'];
    $url_foto_makanan = $_POST['url_foto_makanan'];

    // Memanggil fungsi untuk menambahkan data makanan ke dalam SESSION
    tambahDataMakanan($kode_makanan, $nama_makanan, $harga_makanan, $url_foto_makanan);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Makanan</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Form Data Makanan</h1>
    <div class="card">
        <form method="post" action="">
            <span class="card-p"><label>Kode Makanan:</label></span>
            <input type="text" name="kode_makanan"><br><br>

            <span class="card-p"><label>Nama Makanan:</label></span>
            <input type="text" name="nama_makanan"><br><br>

            <span class="card-p"><label>Harga Makanan:</label></span>
            <input type="text" name="harga_makanan"><br><br>

            <span class="card-p"><label>URL Foto Makanan:</label></span>
            <input type="text" name="url_foto_makanan"><br><br>
            <div class="card-btn">
                <input type="submit" name="submit" value="Simpan">
            </div>
        </form>
        <a href="order.php"><button>Lihat Orderan</button></a>
    </div>       
    <br><br><br>
    <h2>Data Makanan yang Telah Disimpan:</h2>
    <table id="display">
        <tr>
            <th>Kode</th>
            <th>Nama Makanan</th>
            <th>Harga</th>
            <th>URL Foto</th>
        </tr>
        <?php
        // Menampilkan data makanan yang telah disimpan dalam SESSION
        if (isset($_SESSION['data_makanan'])) {
            foreach ($_SESSION['data_makanan'] as $makanan) {
                echo "<tr>";
                echo "<td>" . $makanan['kode'] . "</td>";
                echo "<td>" . $makanan['nama'] . "</td>";
                echo "<td>" . $makanan['harga'] . "</td>";
                echo "<td class='card-img'><img src='" . $makanan['foto'] . "' width='100' height='100'></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>
</html>