<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/payment/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/payment/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/payment/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/payment/delete.php";
        else header("location:/404");
    }
?>