<?php 
 session_start(); 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Order</title>
    <style>
        /* CSS untuk Card makanan */
.card {
    width: 200px;
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px;
    float: left;
    text-align: center;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Styling gambar makanan di dalam Card */
.card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 4px;
}

/* Styling teks informasi makanan di dalam Card */
.card p {
    margin: 5px 0;
    color: #333;
}

/* Tombol pilih di dalam Card */
.card button {
    background-color: #007BFF;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* Ketika cursor diarahkan ke tombol pilih */
.card button:hover {
    background-color: #0056b3;
}

/* CSS untuk kolom hasil pilihan user */
.kolom-kanan {
    width: 250px;
    float: right;
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Styling teks hasil pilihan */
#hasil-pilihan {
    margin-bottom: 10px;
}

#hasil-pilihan p {
    margin: 5px 0;
    color: #333;
}

/* Styling total harga */
#total-harga {
    font-weight: bold;
    color: #007BFF;
}

    </style>
</head>
<body>
    <h1>Makanan Tersedia</h1>
    <div class="kolom-kiri">
        <?php
        // Data makanan dalam SESSION berupa array
        $data_makanan = isset($_SESSION['data_makanan']) ? $_SESSION['data_makanan'] : array();

        // Menampilkan data makanan dalam bentuk Card
        foreach ($data_makanan as $index => $makanan) {
            echo '<div class="card">';
            echo '<img src="' . $makanan['foto'] . '" width="100" height="100"><br>';
            echo 'Kode: ' . $makanan['kode'] . '<br>';
            echo 'Nama: ' . $makanan['nama'] . '<br>';
            echo 'Harga: ' . "Rp. " . number_format($makanan['harga'], 0, ',', '.') . '<br>' . '<br>';
            echo '<button class="btn-pilih" data-index="' . $index . '">Pilih</button>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="kolom-kanan">
        <h2>Pilihanku</h2>
        <div id="hasil-pilihan"></div>
        <p>Total Harga: Rp. <span id="total-harga">0</span></p>
    </div>

    <script src="jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var totalHarga = 0;

            // Ketika tombol pilih di klik
            $(".btn-pilih").click(function() {
                var index = $(this).data('index');
                var makanan = <?php echo json_encode($data_makanan); ?>;
                var selectedMakanan = makanan[index];

                // Menambahkan nama makanan dan harganya ke kolom sebelah kanan
                $("#hasil-pilihan").append('<p>' + selectedMakanan.nama + ' = ' + selectedMakanan.harga + '</p>');

                // Menambahkan harga makanan ke total harga
                totalHarga += parseInt(selectedMakanan.harga);
                $("#total-harga").text(totalHarga);

                // Menonaktifkan tombol pilih agar tidak bisa dipilih lagi
                $(this).attr("disabled", "disabled");
            });
        });
    </script>
</body>
</html>