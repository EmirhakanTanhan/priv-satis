<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
    $Admin = Sorgu("*", "Admin", "id='$Admin_id'", 1);
}
$Return['STATUS'] = NULL;

if ($Admin_id) {

    if (UrlRead(3) == 'adminedit') {
        if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['pass'])) {
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
                $randomLink = GetLink(20);
                $siteAdress = UrlRead("core");

                $ver_email = $email;
                $ver_title = "Confirm your email address";
                $ver_description = "Please click to button to confirm your new email address";
                $ver_link = $siteAdress . "/panel/verification/" . $randomLink;

                $Query_verification = Process("insert", "Verification", array(
                    "status" => 0,
                    "email" => $ver_email,
                    "title" => $ver_title,
                    "description" => $ver_description,
                    "link" => $ver_link
                ));

                if ($Query_verification) {
                    $Return['STATUS'] = "create_link_success";
                }
            }

        }

    }
} else {
    $Return['STATUS'] = 'login_required';
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);