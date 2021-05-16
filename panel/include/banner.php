<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/banner/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/banner/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/banner/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/banner/delete.php";
        else header("location:/404");
    }
?>