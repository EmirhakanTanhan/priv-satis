<?php
if (!$_SESSION['User_id']) header("location:/login");
if (UrlRead(2) == '') include "account/index.php";
else if (is_numeric(UrlRead(2))) include "account/index.php";
else if (UrlRead(2) == 'order') include "account/order.php";
else header("location:/404");