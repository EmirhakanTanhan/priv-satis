<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
    $Admin = Sorgu("*", "Admin", "id='$Admin_id'", 1);
}
$Return['STATUS'] = NULL;

if ($Admin_id) {

    if (UrlRead(3) == "adminedit") {
        if (empty($_POST['name']) and empty($_POST['email']) and empty($_POST['pass'])) {
            $Return['STATUS'] = "empty";
        } else {
            $name = ucfirst($_POST['name']);
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $Return['STATUS'] = "invalid_email";
            } else if (!preg_match("/^\p{L}+$/", $name)) {
                $Return['STATUS'] = "invalid_name";
            } else if (!password_verify($pass, $Admin['password'])) {
                $Return['STATUS'] = "invalid_pass";
            } else {

            }

        }

    }
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);