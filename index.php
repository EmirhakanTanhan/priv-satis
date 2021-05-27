<?php
ob_start();
session_start();
//ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING);
setlocale(LC_TIME, 'tr_TR.UTF-8');
date_default_timezone_set('Europe/Istanbul');

require "_system/db.inc.php";
include "_system/function.php";

if ($_SESSION['User_id']) {
    require "_system/log.php";
}

if (UrlRead(1) != 'api') {
    include "Doc/css.php";
    if (in_array(UrlRead(1), array('', 'account', 'basket', 'page', 'checkout')) == true)
        include "Doc/header.php";
}

switch (UrlRead(1)) {
    case '':
        include "include/index.php";
        break;

    case 'admin':
        include "include/admin/index.php";
        break;

    case 'api':
        include "include/api/api.php";
        break;

    case 'login':
        include "include/login/login.php";
        break;

    case 'signup':
        include "include/login/signup.php";
        break;

    case 'logout':
        include "include/login/logout.php";
        break;

    case 'account':
        include "include/account.php";
        break;

    case 'ticket':
        include "include/ticket.php";
        break;

    case 'basket':
        include "include/basket.php";
        break;

    case 'checkout':
        include "include/checkout.php";
        break;

    case 'page':
        include "include/page.php";
        break;

    default:
        include "include/404.php";
        break;
}

if (UrlRead(1) != 'api') {
    if (in_array(UrlRead(1), array('', 'account', 'basket', 'page', 'checkout')) == true)
        include "Doc/footer.php";
    include "Doc/js.php";
}

