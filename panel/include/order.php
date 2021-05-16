<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/order/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/order/order.php";
        else header("location:/404");
    }
?>
