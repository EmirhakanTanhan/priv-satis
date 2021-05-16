<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/content/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/content/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/content/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/content/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/content/delete.php";
        else header("location:/404");
    }
?>