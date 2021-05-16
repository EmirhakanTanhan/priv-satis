<?php
if (!$_SESSION['User_id']) header("location:/login");
if (is_numeric(UrlRead(2))) include "ticket/ticket.php";
else if (UrlRead(2) == 'new') include "ticket/new.php";
else header("location:/404");