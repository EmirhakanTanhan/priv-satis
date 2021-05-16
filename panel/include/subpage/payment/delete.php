<?php
$Payment_id = UrlRead(4);

if ($Payment_id != 1 and $Payment_id != 2) {
    $Query = Process("delete", "Payment", "", "id='$Payment_id'");
}
if ($Query) header("location:/panel/payment"); else header("location:/404");