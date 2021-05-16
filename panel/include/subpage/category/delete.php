<?php
$Category_id = UrlRead(4);

$Products = Sorgu("id", "Product", "Category_id='$Category_id'");
foreach ($Products as $product) {
    $Query = Process("delete","Product","","id='$product[id]'");
}
$Query = Process("delete", "Category","","id='$Category_id'");

if ($Query) header("location:/panel/category"); else header("location:/404");