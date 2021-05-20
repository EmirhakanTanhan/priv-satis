<?php

function Sorgu($Select, $Table, $Where = NULL, $Limit = NULL, $Order = NULL)
{
    global $db;
    if ($Where) $_Where = " WHERE $Where";
    if ($Limit) $_Limit = " LIMIT $Limit";
    if ($Order) $_Order = " ORDER BY $Order";

    $Sorgu = "SELECT $Select FROM $Table $_Where $_Order $_Limit";
    $Sorgula = $db->query($Sorgu, \PDO::FETCH_ASSOC);
    if ($Sorgula->rowCount()) {
        if ($Limit == 1) {
            $Fetch = $Sorgula->fetch(\PDO::FETCH_ASSOC);
        } else {
            foreach ($Sorgula as $row) {
                $Fetch[] = $row;
            }
        }
    }
    return $Fetch;
}

function Process($Operation, $Table, $Data = NULL, $Where = NULL)
{ //$Operation : "insert" or "update" or "delete"
    global $db;
    $Column = array();
    $Value = array();

    if ($Data) { //array("Product_id" => 24, "User_id" => 76)
        foreach ($Data as $index => $piece) {
            array_push($Column, $index . "=?");
            array_push($Value, $piece);
        }
        $Column = implode(",", $Column);
    }

    if ($Operation == "update" or $Operation == "delete") {
        $id = Sorgu("id", $Table, $Where, 1)['id'];
        array_push($Value, $id);
    }

    if ($Operation == "insert") {                                //INSERT INTO $TABLE SET (DATA)
        $sql = "INSERT INTO" . " " . $Table . " SET " . $Column; //EXAMPLE:INSERT INTO BASKET SET Product_id = ?,User_id = ?
        $query = $db->prepare($sql);                             //EXAMPLE:execute(array("25","A34$DV€DF"));
        $insert = $query->execute($Value);
        if ($insert) {
            return $db->lastInsertId();
        }
    }
    if ($Operation == "update") {
        $sql = "UPDATE" . " " . $Table . " SET " . $Column . " WHERE id=?";
        $query = $db->prepare($sql);
        $update = $query->execute($Value);
        if ($update)
            return $query->rowCount();
    }
    if ($Operation == "delete") {
        $sql = "DELETE FROM" . " " . $Table . " WHERE id=?";
        $query = $db->prepare($sql);
        $delete = $query->execute($Value);
        if ($delete)
            return $query->rowCount();
    }
}

function UrlRead($Place = NULL)
{
    if (!$Place)
        return $_SERVER['REQUEST_URI'];
    else if ($Place == "all")
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    else
        return explode("/", $_SERVER['REQUEST_URI'])[$Place];
}

function Product($Category_id = NULL)
{
    $Where = NULL;
    if ($Category_id) {
        $Where = "id='$Category_id'";
    }
    $Data = Sorgu("*", "Category", $Where);
    foreach ($Data as $index => $category) {
        $Data[$index]['product'] = Sorgu("*", "Product", "Category_id='$category[id]'");
    }
    return $Data;
}

function User($User_given_id = NULL)
{
    if ($User_given_id)
        $User_id = $User_given_id;
    else
        $User_id = $_SESSION['User_id'];
    $Data = Sorgu("*", "Users", "id='$User_id'", 1);

    return $Data;
}

function Basket($Orders_id = NULL, $Users_id = NULL)
{
    if ($Users_id)
        $User_id = $Users_id;
    else if (!$Users_id)
        $User_id = $_SESSION['User_id'];

    $Total = 0;

    if ($Orders_id) $Where = "AND Orders_id='$Orders_id'"; else $Where = "AND Orders_id IS NULL";
    $Data = Sorgu("p.id, p.status, p.Category_id, p.name, p.discount, p.stock, p.type, p.description, p.link, p.image, b.history, b.price, b.discounted_price", "Basket AS b, Product AS p", "b.Users_id='$User_id' AND p.id=b.Product_id  $Where");
    if ($Data) {
        $Count = Sorgu("COUNT(id) AS id", "Basket", "Users_id='$User_id' $Where", 1)['id'];
        foreach ($Data as $index => $datum) {
            if ($datum['discounted_price'])
                $Price = number_format($datum["discounted_price"], "2");
            else
                $Price = number_format($datum["price"], "2");
            $Total += $Price;
        }
    }
    $Data['total'] = $Total;
    $Data['count'] = $Count;
    return $Data;
}

function Category($Category_id = NULL, $Category_name = NULL)
{
    if ($Category_id)
        $Data = Sorgu("name", "Category", "id='$Category_id'", 1)["name"];
    else if ($Category_name)
        $Data = Sorgu("id", "Category", "name='$Category_name'", 1)["id"];
    else
        $Data = Sorgu("id,name,description", "Category");

    return $Data;
}

function Stock($Product_id = NULL)
{
    $Where = NULL;
    if ($Product_id)
        $Where = "AND s.Product_id = '$Product_id'";
    $Data = Sorgu("s.id,s.history,s.status,s.Product_id,s.description,p.image,p.name,p.Category_id", "Stock AS s, Product AS p", "p.id=s.Product_id $Where");
    return $Data;
}

function PaymentMethod($Payment_id = NULL)
{
    if ($Payment_id)
        $Data = Sorgu("name", "Payments", "id='$Payment_id'", 1)["name"];
    else
        $Data = Sorgu("id,name", "Payments");

    return $Data;
}

function DiscountedPrice($Price, $Discount, $Order = NULL)
{   //$Order : "0"(find discounted price), "1"(find discount percentage)
    if ($Order == "0" or !$Order) {
        $Data = $Price - ($Price * ($Discount / 100));
        if ($Data == $Price) $Data = NULL;
    }
    if ($Order == "1")
        $Data = 100 / ($Price / ($Price - $Discount));

    return $Data;
}

function Paginator($Limit, $Table, $PageUrl, $Where = NULL, $User = 1)
{   //User = 0 (Admin), User = 1 (User)
    var_dump("deneme_paginator");
    if ($User == 1) {
        $User_id = $_SESSION['User_id'];
        $_User = "Users_id='$User_id'";
    }
    if ($Where) $_Where = "AND $Where";

    $Count = Sorgu("COUNT(id) AS id", $Table, $_User . $_Where, 1)['id'];
    if ($Count) {
        $Page = $PageUrl ? $PageUrl : 1;
        $Start = ($Page - 1) * $Limit;
        $LastPage = ceil($Count / $Limit);
    } else if (!$Count) {
        return 0;
    }

    $first_shown = ($Limit * $Page) - $Limit + 1;
    $last_shown = ($first_shown + $Limit - 1);
    if ($last_shown > $Count) $last_shown = $Count;

    $Data['Count'] = $Count;
    $Data['Limit'] = $Limit;
    $Data['first_shown'] = $first_shown;
    $Data['last_shown'] = $last_shown;
    $Data['Page'] = $Page;
    $Data['Start'] = $Start;
    $Data['LastPage'] = $LastPage;

    return $Data;
}

function TicketMessage($Ticket_id)
{
    $User_id = $_SESSION['User_id'];

    $Messages = Sorgu("*", "Ticket_message", "Ticket_id='$Ticket_id'", "", "id ASC");

    return $Messages;
}

function getUserIP()
{
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function subMenu()
{
    $Pages = Sorgu("id, Pages_id", "Pages");
    $count = array();

    foreach ($Pages as $index => $page) {
        if ($page['Pages_id']) {
            $count[$page['Pages_id']]++;
            $Data[$page['Pages_id']][$count[$page['Pages_id']]] = $page['id'];
        } else {
            $count[0]++;
            $Data[0][$count[0]] = $page['id'];
        }
    }

    return $Data;
}

function Post($Data = NULL)
{
    if ($Data)
        return $Data;
    else
        return json_decode(file_get_contents("php://input"), true);
}