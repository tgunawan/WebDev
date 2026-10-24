<?php

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