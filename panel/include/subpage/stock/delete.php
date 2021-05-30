<?php
$Stock_id = UrlRead(4);
$Product_id = Query("Product_id", "Stock", "id='$Stock_id'", 1)['Product_id'];

$Query = Process("delete", "Stock", "", "id='$Stock_id'");
if ($Query) {
    $Product_stock_num = Query("stock", "Product", "id='$Product_id'", 1)['stock'];
    $Product_stock_num = $Product_stock_num - 1;
    if ($Product_stock_num <= 0) $Product_stock_num = 0;

    $Query = Process("update", "Product", array(
        "stock" => $Product_stock_num,
    ), "id='$Product_id'");
}
if ($Query) header("location:/panel/stocks"); else header("location:/404");