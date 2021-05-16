<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/support/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/support/index.php";
        else if (UrlRead(3) == 'new') include "include/subpage/support/new.php";
        else if (UrlRead(3) == 'edit') include "include/subpage/support/edit.php";
        else if (UrlRead(3) == 'delete') include "include/subpage/support/delete.php";
        else header("location:/404");
    }
?>