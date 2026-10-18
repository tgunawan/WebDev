# intro PHP
PHP (PHP: Hypertext Preprocessor) adalah bahasa pemrograman yang dirancang terutama untuk pengembangan web backend. PHP berjalan di server dan menghasilkan HTML yang kemudian dikirim ke browser.

## Jika dianalogikan:
HTML = tampilan
CSS = desain
JavaScript = interaksi di browser
PHP = logika di server

- file .php dapat di tulis bersamaan dengan html

- Output dengan echo
echo digunakan untuk menampilkan output.

- Tipe Data Dasar PHP
Beberapa tipe data yang umum digunakan:

| Tipe Data | Contoh |
|-----------|--------|
| String | "Indomie" |
| Integer | 3500    |
| Float | 10.5 |
| Boolean | true / false |
| Array | ["Indomie", "Teh"] |

## Operator Aritmatika
PHP dapat melakukan operasi matematika.
Operator
Fungsi
- '+' = Penjumlahan
- '-'= Pengurangan
- '*' = Perkalian
- / = Pembagian
- % = Modulus

## Operator Perbandingan
Branching membutuhkan operator perbandingan.
| Operator | Arti |
| --- | --- |
| `==` | Sama dengan |
| `===` | Identik |
| `!=` | Tidak sama |
| `>` | Lebih besar |
| `<` | Lebih kecil |
| `>=` | Lebih besar atau sama |
| `<=` | Lebih kecil atau sama |

## Branching / conditional


'<?php

$total = 300000;

if ($total >= 500000) {
    $diskon = 20;
} elseif ($total >= 250000) {
    $diskon = 15;
} elseif ($total >= 100000) {
    $diskon = 10;
} else {
    $diskon = 0;
}

echo "Diskon: $diskon%";
$total = 300000;

$potongan = $total * $diskon / 100;

$total_bayar = $total - $potongan;

echo "Total: Rp$total<br>";
echo "Diskon: $diskon%<br>";
echo "Potongan: Rp$potongan<br>";
echo "Total Bayar: Rp$total_bayar";

?>

## Operator Logika || Multiple condition

- AND && Kedua kondisi harus benar.

if ($total >= 100000 && $member == true) {
    echo "Mendapatkan diskon member";
}

- OR || Salah satu kondisi benar.

if ($total >= 100000 || $member == true) {
    echo "Mendapatkan promo";
}

- NOT ! Membalik kondisi.

if (!$member) {
    echo "Bukan member";
}

## Nested branching

Nested branching adalah branching yang berada di dalam branching lainnya.
Contoh:
<?php

$total = 150000;
$member = true;

if ($total >= 100000) {

    if ($member == true) {
        echo "Diskon 10% untuk member";
    } else {
        echo "Diskon 5% untuk non-member";
    }

} else {
    echo "Tidak mendapatkan diskon";
}

?>

### note
echo tidak bisa menjalankan perhitungan semua perhitungan ada di variable, echo hanya menampilkan hasil dari variable tersebut. 

