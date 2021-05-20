<?php
$Constant_id = UrlRead(4);

$Query = Process("delete", "Constant", "", "id='$Constant_id'");
if ($Query) header("location:/panel/constant"); else header("location:/404");