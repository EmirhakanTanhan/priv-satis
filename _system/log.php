<?php
$UserIp = getUserIP();

if (UrlRead(1) != "api" and UrlRead(1) != "404") {
    if (strpos(UrlRead(), "/img/") === false) {
        $Operation = UrlRead();
    }
}

if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
} else if ($_SESSION['User_id']) {
    $User_id = $_SESSION['User_id'];
}

Process("insert", "Log", array(
    "ip" => $UserIp,
    "operation" => $Operation,
    "Users_id" => $User_id,
    "Admin_id" => $Admin_id
));