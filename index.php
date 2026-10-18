<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Aplikasi Kasir PHP</h1>
    <a href="barang.php"> Inventory</a><br>
    <a href="tambah_barang.php"> Add Inventory</a><br>
    <?php
        require "koneksi.php";
        $query = "SELECT * FROM barang";
        $result = mysqli_query($conn, $query);
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $data["id_barang"]; ?></td>
            <td><?= $data["nama_barang"]; ?></td>
            <td><?= $data["harga"]; ?></td>
            <td><?= $data["stok"]; ?></td>
        </tr>
        <?php } ?>
    </table>


</body>
</html>
 
   
   <?php

    //require "koneksi.php";

    //$query = "SELECT * FROM barang";

    //$result = mysqli_query($conn, $query);

    // while ($data = mysqli_fetch_assoc($result)) {

    //     echo "Nama: " . $data["nama_barang"] . "<br>";
    //     echo "Harga: Rp" . $data["harga"] . "<br>";
    //     echo "Stok: " . $data["stok"] . "<br>";
    //     echo "<hr>";

    // }

    ?>

<?php
        // require "koneksi.php"; // mabil file koneksi untuk menguhubungkam ke database

        
       // $query = "SELECT * FROM barang";    //Menyimpan perintah SQL.Ambil semua data dari table barang.

        //$result = mysqli_query($conn, $query); //menyimpan hasil query dengan koneksi yang di buat pada file koneksi
        //echo $result; // akan memunculkan error karena object hasil query yang dihasilkan bukan string
        // $data = mysqli_fetch_assoc($result); // ambil data array dari database
        //echo $data;// masih error karena data adalah array belum string
        // echo $data["nama_barang"]; // hanya ambil 1 data saja

        // while ($data = mysqli_fetch_assoc($result)) { // mengulang ambil 1 baris data selama masih ada barisnya
        //     echo $data["nama_barang"]; // tampilkan data kolom nama_barang
        //     echo "<br>"; // 
        // }



        // echo "<br>Hello Kasir PHP <br>";
        // $nama = "Indomie";
        // echo $nama;

        // $nama_barang = "indomie";
        // $harga = 3500;
        // $jumlah = 100;
        // $diskon = 0;

        // $total = $harga*$jumlah;
        // if($total >= 50000){
        //     $diskon = 5; 
        // } elseif ($total>=100000) {
        //     $diskon = 10; 
        // } else {
        //     $diskon=0;
        // }
        // $potongan = $total*$diskon/100;
        // $totalbayar =$total-$potongan;
        // echo "Diskon: $diskon %<br>";
        // echo "Total Pembayaran Kamu $total<br>";
        // echo "Total diskon Kamu $diskon jadi $potongan <br>";
        // echo "Total setelah diskon Kamu $totalbayar <br>";
    ?>