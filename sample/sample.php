<?php

function salam($nama) {
    echo "Selamat datang".$nama."<br>";
    echo "Selamat datang";
}

salam(4);
echo "<br><br><br>";
function hitungTotal($harga, $jumlah) {

    $total = $harga * $jumlah;

    return $total;
}
$total = hitungTotal(5000, 3);
$angka=45;
echo $total+$angka."<br>";



function getBarang($conn) {

    $query = "SELECT * FROM barang";

    $result = mysqli_query($conn, $query);

    return $result;
}

require "../koneksi.php";


$dataBarang = getBarang($conn);

while ($data = mysqli_fetch_assoc($dataBarang)) {

    echo $data["nama_barang"];
    echo "<br>";

}

function getJumlahBarangPerKategori($conn) {

    $query = "SELECT
                k.nama_kategori,
                COUNT(b.id_barang) AS jumlah_barang
              FROM kategori AS k
              LEFT JOIN barang AS b
              ON k.id_kategori = b.id_kategori
              GROUP BY k.id_kategori, k.nama_kategori";

    return mysqli_query($conn, $query);
}

$result = getJumlahBarangPerKategori($conn);


while ($data = mysqli_fetch_assoc($result)) {

    echo $data["nama_kategori"];
    echo " : ";
    echo $data["jumlah_barang"];
    echo "<br>";
}
    ?>


<!-- chart.php -->
<?php

// require "koneksi.php";

// function getJumlahBarangPerKategori($conn) {

//     $query = "SELECT
//                 k.nama_kategori,
//                 COUNT(b.id_barang) AS jumlah_barang
//               FROM kategori AS k
//               LEFT JOIN barang AS b
//               ON k.id_kategori = b.id_kategori
//               GROUP BY k.id_kategori, k.nama_kategori";

//     return mysqli_query($conn, $query);
// }

$result = getJumlahBarangPerKategori($conn);

$dataPoints = [];

while ($data = mysqli_fetch_assoc($result)) { //mengambil data database satu per satu.
//mysqli_fetch_assoc() biasanya menghasilkan nilai dari database sebagai string.

    $dataPoints[] = [
        "label" => $data["nama_kategori"],
        "y" => (int) $data["jumlah_barang"] // perlu convert jadi int / angka
    ];

}

?>

<!DOCTYPE html>
<html>

<head>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</head>

<body>

    <h1>Jumlah Barang per Kategori</h1>

    <div
        id="chartContainer"
        style="height: 370px; width: 100%;">
    </div>

    <script>

        window.onload = function () {

            var dataPoints =
                <?= json_encode($dataPoints); ?>; //convert database PHP ke JavaScript

            var chart = new CanvasJS.Chart(
                "chartContainer",
                {

                    title: {
                        text: "Jumlah Barang per Kategori"
                    },

                    axisY: {
                        title: "Jumlah Barang"
                    },

                    data: [
                        {
                            type: "column",
                            dataPoints: dataPoints
                        }
                    ]

                }
            );

            chart.render();

        }

    </script>
</body>
</html>
