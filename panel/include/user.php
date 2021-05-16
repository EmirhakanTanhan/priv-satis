<?php
    if ($_SESSION['Admin_id']) {
        if (UrlRead(3) == '') include "include/subpage/user/index.php";
        else if (is_numeric(UrlRead(3))) include "include/subpage/user/user.php";
        else header("location:/404");
    }
?>