<?php
    $Link = $Response->UrlRead(2);

    $Page = $Db->Sorgu("*","Page","link='$Link'","1");
    if (!$Page) header("location:/404");