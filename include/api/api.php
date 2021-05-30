<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
if ($_SESSION['User_id']) {
    $User_id = $_SESSION['User_id'];
    $User = User();
}
$Return['STATUS'] = NULL;


if (UrlRead(2) == 'login') {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if (empty($email) or empty($pass)) {
        $Return['STATUS'] = "empty";
    }
    if (!$Return['STATUS']) {
        $_User = Query("*", "Users", "email='$email'", 1);
        if ($_User) {
            if (password_verify($pass, $_User['password'])) {
                $_SESSION['User_id'] = $_User['id'];
                $Return['STATUS'] = "login_success";
            } else {
                $Return['STATUS'] = "invalid_user";
            }
        } else {
            $Return['STATUS'] = "invalid_user";
        }
    }
}

if (UrlRead(2) == 'signup') {
    $agreement = $_POST['agreement'];
    $name = ucfirst($_POST['name']);
    $surname = ucfirst($_POST['surname']);
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_repeat = $_POST['pass_repeat'];

    if ($agreement == 1) {
        if (empty($name) or empty($surname) or empty($email) or empty($pass) or empty($pass_repeat)) {
            $Return['STATUS'] = "empty";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Return['STATUS'] = "invalid_email";
        } else if (!preg_match("/^[a-zA-Z]*$/", $name) or !preg_match("/^[a-zA-Z]*$/", $surname)) {
            $Return['STATUS'] = "invalid_name";
        } else if ($pass !== $pass_repeat) {
            $Return['STATUS'] = "invalid_pass";
        }

        $UserCheck = Query("email", "Users", "email='$email'", 1)['email'];
        if ($UserCheck) {
            $Return['STATUS'] = "email_exists";
        } else if (!$Return['STATUS'] and $name and $surname and $email and $pass and $pass_repeat) {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

            $Query = Process("insert", "Users", array(
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "password" => $hashed_pass
            ));
            if ($Query) {
                $Return['STATUS'] = "signup_success";
            } else {
                $Return['STATUS'] = "unknown_error";
            }
        }
    } else {
        $Return['STATUS'] = "unchecked_agreement";
    }
}

if ($User_id) {

    if (UrlRead(2) == "basketadd") {
        $Product_id = $Post['id'];
        $Product = Query("*", "Product", "id='$Product_id'", 1);
        $Basket = Query("*", "Basket", "Product_id='$Product_id' AND Users_id='$User_id' AND Orders_id IS NULL", 1);
        if (!$Basket) {
            $Query = Process("insert", "Basket", array(
                "Product_id" => $Product_id,
                "Users_id" => $User_id,
                "price" => $Product['price'],
                "discounted_price" => DiscountedPrice($Product['price'], $Product['discount'])
            ));
        } else {
            $Query = true;
        }

        $Count = Query("COUNT(id) AS id", "Basket", "Users_id='$User_id' AND Orders_id IS NULL", 1)['id'];
        if ($Query) {
            $Return['BasketCount'] = $Count;
            $Return['STATUS'] = 'add_success';
        } else {
            $Return['STATUS'] = 'unknown_error';
        }
    }

    if (UrlRead(2) == "basketremove") {
        $Product_id = $Post['id'];
        $Query = Process("delete", "Basket", null, "Users_id='$User_id' AND Product_id='$Product_id' AND Orders_id IS NULL");
        $Check = Query("*", "Basket", "Users_id='$User_id' AND Orders_id IS NULL");

        if ($Query and !$Check) {
            $Return['STATUS'] = "remove_success_basket_empty";
        } else if ($Query) {
            $Return['STATUS'] = "remove_success";
        } else {
            $Return['STATUS'] = "unknown_error";
        }
    }

    if (UrlRead(2) == "editdetails") {
        if ($_POST['name']) $name = ucfirst($_POST['name']); else $name = $User['name'];
        if ($_POST['surname']) $surname = ucfirst($_POST['surname']); else $surname = $User['surname'];
        if ($_POST['email']) $email = $_POST['email']; else $email = $User['email'];
        if ($_POST['phone']) $phone = $_POST['phone']; else $phone = $User['phone'];
        if ($_POST['hash']) $hash = $_POST['hash']; else $hash = $User['hash'];
        if ($_POST['address']) $address = $_POST['address']; else $address = $User['address'];

        if (empty($_POST['name']) and empty($_POST['surname']) and empty($_POST['email']) and empty($_POST['phone']) and empty($_POST['hash']) and empty($_POST['address'])) {
            $Return['STATUS'] = "empty";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $Return['STATUS'] = "invalid_email";
        } else if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            $Return['STATUS'] = "invalid_name";
        } else if (!preg_match("/^[a-zA-Z]*$/", $surname)) {
            $Return['STATUS'] = "invalid_surname";
        } else if (!preg_match("/^[0-9]*$/", $phone)) {
            $Return['STATUS'] = "invalid_phone";
        } else if (!preg_match("/^[0-9]*$/", $hash)) {
            $Return['STATUS'] = "invalid_hash";
        }
        $UserCheck = Query("email", "Users", "email='$email'", 1)['email'];
        if ($UserCheck and $User['email'] != $email) {
            $Return['STATUS'] = "email_exist";
        } else if (!$Return['STATUS']) {
            $Query = Process("update", "Users", array(
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "phone" => $phone,
                "hash" => $hash,
                "address" => $address
            ), "id='$User_id'");
            if ($Query) {
                $Return['STATUS'] = "detail_success";
            } else {
                $Return['STATUS'] = "unknown_error";
            }
        }
    }

    if (UrlRead(2) == 'changepassword') {
        $old_pass = $_POST['old_pass'];
        $pass = $_POST['pass'];
        $pass_repeat = $_POST['pass_repeat'];

        if (empty($old_pass) or empty($pass) or empty($pass_repeat)) {
            $Return['STATUS'] = "empty";
        } else if ($pass != $pass_repeat) {
            $Return['STATUS'] = "incompatible_pass";
        } else if (password_verify($old_pass, $User['password'])) {
            if ($old_pass == $pass) {
                $Return['STATUS'] = "same_pass";
            } else {
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                $Query = Process("update", "Users", array(
                    "password" => $hashed_pass
                ), "id='$User_id'");
                if ($Query) {
                    $Return['STATUS'] = "pass_success";
                } else {
                    $Return['STATUS'] = "unknown_error";
                }
            }
        } else {
            $Return['STATUS'] = "invalid_pass";
        }
    }

    if (UrlRead(2) == 'placeorder') {
        $payment_id = $_POST['payments_id'];
        $Basket = Basket();

        if (empty($payment_id) or empty($Basket['total'])) {
            $Return['STATUS'] = "empty";
        } else if ($Basket['total'] <= 0) {
            $Return['STATUS'] = "invalid_total";
        } else {
            $Orders_id = Process("insert", "Orders", array(
                "Payments_id" => $payment_id,
                "price" => $Basket['total'],
                "Users_id" => $User_id
            ));
            if ($Orders_id) {
                foreach ($Basket as $index => $Product) {
                    if ($index !== "total" and $index !== "count") {
                        $Query = Process("update", "Basket", array(
                            "Orders_id" => $Orders_id
                        ), "Users_id='$User_id' AND Product_id='$Product[id]' AND Orders_id IS NULL");
                        if (!$Query) {
                            $Return['STATUS'] = "unknown_error_editbasket";
                        }
                    }
                }
                if ($Return['STATUS'] != "unknown_error_editbasket") {
                    $Return['STATUS'] = "placeorder_success";
                    $Return['Orders_id'] = $Orders_id;
                }
            } else $Return['STATUS'] = "unknown_error_placeorder";
        }
    }

    if (UrlRead(2) == 'cancelorder') {
        $order_id = $Post['id'];

        $Query = Process("update", "Orders", array(
            "status" => 2
        ), "id='$order_id' AND Users_id='$User_id'");

        if ($Query) {
            $Return['STATUS'] = "cancelorder_success";
        } else {
            $Return['STATUS'] = "unknown_error";
        }
    }

    if (UrlRead(2) == 'newticket') {
        $name = $_POST['name'];
        $description = $_POST['description'];

        if (empty($name) or empty($description)) {
            $Return['STATUS'] = "empty";
        } else {
            $Ticket_process = Process("insert", "Ticket", array(
                "Users_id" => $User_id,
                "name" => $name,
                "description" => $description
            ));
            if ($Ticket_process) {
                $TicketMessage_process = Process("insert", "Ticket_message", array(
                    "Ticket_id" => $Ticket_process,
                    "Users_id" => $User_id,
                    "description" => $description
                ));
                if ($TicketMessage_process) {
                    $Return['STATUS'] = "newticket_success";
                } else {
                    $Return['STATUS'] = "unknown_error";
                }
            } else {
                $Return['STATUS'] = "unknown_error";
            }
        }
    }

    if (UrlRead(2) == 'NewTicketMessage') {
        $description = $_POST['description'];
        $ticket_id = $_POST['ticketId'];

        if (!empty($description)) {
            $NewTicketMessage_process = Process("insert", "Ticket_message", array(
                "Ticket_id" => $ticket_id,
                "Users_id" => $User_id,
                "description" => $description
            ));
            if ($NewTicketMessage_process) {
                $Return['STATUS'] = 'newticketmessage_success';
            } else {
                $Return['STATUS'] = 'unknown_error';
            }
        }
    }


} else
    if (UrlRead(2) != 'login' and UrlRead(2) != 'signup') $Return['STATUS'] = 'login_required';

echo json_encode($Return, JSON_UNESCAPED_UNICODE);

