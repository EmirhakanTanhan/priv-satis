<?php
if ($_SESSION['Admin_id']) {
    if (UrlRead(3) == '') include "include/subpage/constant/index.php";
    else if (is_numeric(UrlRead(3))) include "include/subpage/constant/index.php";
    else if (UrlRead(3) == 'new123') include "include/subpage/constant/new.php";
    else if (UrlRead(3) == 'edit') include "include/subpage/constant/edit.php";
    else if (UrlRead(3) == 'delete123') include "include/subpage/constant/delete.php";
    else header("location:/404");
}
?>