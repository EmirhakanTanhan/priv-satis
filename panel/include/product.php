<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/product/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/product/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/product/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/product/delete.php";
        else header("location:/404");
    }
?>