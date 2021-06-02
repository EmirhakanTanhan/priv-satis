<?php
ob_start();
session_start();
//ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING);
setlocale(LC_TIME, 'tr_TR.UTF-8');
date_default_timezone_set('Europe/Istanbul');

require "../_system/db.inc.php";
require "../_system/function.php";

if ($_SESSION['Admin_id']) {
    require "../_system/log.php";
}

if (UrlRead(2) != 'api') {
    include "Doc/css.php";
    if ($_SESSION['Admin_id'] and in_array(UrlRead(2), array('', 'general', 'contents', 'menus', 'constant', 'banner', 'products',
            'orders', 'category', 'users', 'blog', 'support', 'stocks', 'payment', 'logs', 'profile')) == true) {
        include "Doc/header.php";
    }
}


if ($_SESSION['Admin_id']) {
    switch (UrlRead(2)) {
        case 'api':
            include "include/api/api.php";
            break;

        case '':
            include "include/index.php";
            break;

        case 'general':
            include "include/general.php";
            break;

        case 'contents':
            include "include/content.php";
            break;

        case 'menus':
            include "include/menu.php";
            break;

        case 'constant':
            include "include/constant.php";
            break;

        case 'banner':
            include "include/banner.php";
            break;

        case 'products':
            include "include/product.php";
            break;

        case 'orders':
            include "include/order.php";
            break;

        case 'category':
            include "include/category.php";
            break;

        case 'users':
            include "include/user.php";
            break;

        case 'blog':
            include "include/blog.php";
            break;

        case 'support':
            include "include/support.php";
            break;

        case 'stocks':
            include "include/stock.php";
            break;

        case 'payment':
            include "include/payment.php";
            break;

        case 'logs':
            include "include/log.php";
            break;

        case 'logout':
            include "include/auth/logout.php";
            break;

        case 'profile':
            include "include/auth/profile.php";
            break;

        case 'verification':
            include "include/auth/verification.php";
            break;

        case 'login':
        case 'forgot-password' :
            header("location:/panel");
            break;

        default:
            include "include/404.php";
            break;
    }
} else {
    switch (UrlRead(2)) {
        case 'api':
            include "include/api/api.php";
            break;

        case 'login':
            include "include/auth/login.php";
            break;

        case 'forgot-password':
            include "include/auth/forgotpassword.php";
            break;

        case 'verification':
            include "include/auth/verification.php";
            break;

        default:
            header("location:/panel/login");
            break;
    }
}

if (UrlRead(2) != 'api') {
    if ($_SESSION['Admin_id'] and in_array(UrlRead(2), array('', 'general', 'contents', 'menus', 'constant', 'banner', 'products',
            'orders', 'category', 'users', 'blog', 'support', 'stocks', 'payment', 'logs', 'profile')) == true) {
        include "Doc/footer.php";
    }
    include "Doc/js.php";
}
