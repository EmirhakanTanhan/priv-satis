<?php
$Blog_id = UrlRead(4);

if ($Blog_id != 1) {
    $Query = Process("delete", "Pages", "", "id='$Blog_id'");
}
if ($Query) header("location:/panel/blog"); else header("location:/404");