<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
    $Admin = Sorgu("*", "Admin", "id='$Admin_id'", 1);
}
$Return['STATUS'] = null;

if ($Admin_id) {

    switch (UrlRead(3)) {
        case 'adminedit':
            $name = ucfirst($_POST['name']);
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            switch (true) {
                case (empty($name) or empty($email) or empty($pass)):
                    $Return['STATUS'] = "empty";
                    break;
                case ($Admin['name'] == $name and $Admin['email'] == $email):
                    $Return['STATUS'] = "unchanged";
                    break;
                case (!filter_var($email, FILTER_VALIDATE_EMAIL)):
                    $Return['STATUS'] = "invalid_email";
                    break;
                case (!preg_match("/^\p{L}+$/", $name)):
                    $Return['STATUS'] = "invalid_name";
                    break;
                case (!password_verify($pass, $Admin['password'])):
                    $Return['STATUS'] = "invalid_pass";
                    break;

                case ($Admin['email'] == $email): //Update admin name
                    $Query_edit_admin = Process("update", "Admin", array(
                        "name" => $name
                    ), "id='$Admin_id'");
                    if ($Query_edit_admin) $Return['STATUS'] = "success_edit_name";
                    break;

                case ($Admin['email'] != $email): //Update admin email
                    $ver_email = $email;
                    $ver_title = "Confirm your email address";
                    $ver_description = "Please click to button to confirm your new email address";
                    $ver_link = UrlRead("core") . "/panel/verification/" . GetLink(20); //Satis.emirhakan.com>>>>/panel/verification/>>>>jmq0A3CkbSW7VcI39IEa
                    $ver_change['Admin']['name'] = $name;
                    $ver_change['Admin']['email'] = $email;

                    //Create verification data
                    $Query_verification = Process("insert", "Verification", array(
                        "status" => 0,
                        "email" => $ver_email,
                        "title" => $ver_title,
                        "description" => $ver_description,
                        "link" => $ver_link,
                        "Admin_id" => $Admin_id,
                        "changes" => json_encode($ver_change, JSON_UNESCAPED_UNICODE)
                    ));

                    //Update link by putting the row's id in the end of the link as hexadecimal value.
                    $Query_verification_link_update = Process("update", "Verification", array(
                        "link" => $ver_link . dechex($Query_verification)
                    ), "id='$Query_verification'");

                    if ($Query_verification_link_update and $Query_verification) {
                        SendMail($Query_verification);
                        $Return['STATUS'] = "success_ver_req_sent";
                        $Return['EMAIL'] = $ver_email;
                    }
                    break;
            }
    }

} else {
    $Return['STATUS'] = 'login_required';
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);