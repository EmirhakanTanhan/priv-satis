<?php
$Banner_id = UrlRead(4);

$Query = Process("delete", "Banner", "", "id='$Banner_id'");
if ($Query) header("location:/panel/banner"); else header("location:/404");