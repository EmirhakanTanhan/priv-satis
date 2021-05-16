<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/category/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/category/category.php";
        else if (UrlRead(3) == 'new') include "include/subpage/category/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/category/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/category/delete.php";
        else header("location:/404");
    }
?>