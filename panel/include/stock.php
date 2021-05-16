<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/stock/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/stock/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/stock/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/stock/delete.php";
        else header("location:/404");
    }
?>
