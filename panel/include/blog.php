<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/blog/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/blog/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/blog/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/blog/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/blog/delete.php";
        else header("location:/404");
    }
?>