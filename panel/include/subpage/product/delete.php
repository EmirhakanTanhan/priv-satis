<?php
$Product_id = UrlRead(4);

$Query = Process("delete", "Product", "", "id='$Product_id'");
if ($Query) header("location:/panel/products"); else header("location:/404");