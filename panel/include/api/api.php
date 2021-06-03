<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
$Url = UrlRead(3);
if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
    $Admin = Query("*", "Admin", "id='$Admin_id'", 1);
}
$Return['STATUS'] = null;


switch (UrlRead(3)) {

    case 'verlogin':
        $email = $_POST['email'];
        $pass = $_POST['password'];
        switch (true) {
            case (empty($email) or empty($pass)):
                $Return['STATUS'] = "ERR_EMPTY";
                break;
            case (!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $Return['STATUS'] = "ERR_INVALID_EMAIL";
                break;

            case ((!$_Admin = Query("*", "Admin", "email='$email'", 1)) or !password_verify($pass, $_Admin['password'])):
                $Return['STATUS'] = "ERR_INVALID_USER_OR_PASS";
                break;
            default:
                $_SESSION['Admin_id'] = $_Admin['id'];
                $_SESSION['email'] = $_Admin['email'];
                $_SESSION['name'] = $_Admin['name'];
                $Return['STATUS'] = "SUCC_LOGIN";
                break;
        }
        break;

    case 'verchangepass':
        $VerUrl = $_POST['ver_url']; //Page url >>>> http://satis.me/panel/verification/ADOI8U7oCXOJoJJxBDMF30?status=SUCC_APPLY_CHANGE
        $VerUrl = explode("?", $VerUrl)[0]; //Page url >>>> http://satis.me/panel/verification/ADOI8U7oCXOJoJJxBDMF30
        $VerLink = explode("/", $VerUrl); //Explode the link out of the page url
        $VerLink = end($VerLink); //verification link >>>> ADOI8U7oCXOJoJJxBDMF30
        $VerId = hexdec(substr($VerLink, 20)); //verification id transformed to decimal from hexadecimal >>>> 30 (hex) >>>> 48 (dec)

        $pass = $_POST['password_new'];
        $pass_rpt = $_POST['password_new_repeat'];

        $Return['LINK'] = $VerLink;

        switch (true) {
            case (empty($VerLink) or strlen($VerLink) < 20):
                $Return['STATUS'] = "ERR_INVALID_LINK_a";
                break;
            case (!$VerDB = Query("*", "Verification", "id='$VerId'", 1) or $VerUrl != $VerDB['link'] or $VerDB['status'] == 1):
                $Return['STATUS'] = "ERR_INVALID_LINK_b";
                break;
            case (empty($pass) or empty($pass_rpt)):
                $Return['STATUS'] = "ERR_EMPTY";
                break;
            case ($pass != $pass_rpt):
                $Return['STATUS'] = "ERR_INVALID_PASS_RPT";
                break;

            default:
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

                $Process_change_pass = Process("update", "Admin", array(
                    "password" => $hashed_pass
                ), "id='$VerDB[Admin_id]'");

                if ($Process_change_pass) {
                    $Process_update_status = Process("update", "Verification", array(
                        "status" => 1
                    ), "id='$VerDB[id]'");
                }

                if ($Process_update_status) {
                    $Return['STATUS'] = "SUCC_PASS_CHANGED";
                }
                break;
        }
        break;

    case 'vercheck':
        $VerUrl = $_POST['ver_url']; //Page url >>>> http://satis.me/panel/verification/ADOI8U7oCXOJoJJxBDMF30
        $VerLink = explode("/", $VerUrl); //Explode the link out of the page url
        $VerLink = end($VerLink); //verification link >>>> ADOI8U7oCXOJoJJxBDMF30
        $VerType = substr($VerLink, 0, 1); //verification link >>>> A
        $VerId = hexdec(substr($VerLink, 20)); //verification id transformed to decimal from hexadecimal >>>> 30 (hex) >>>> 48 (dec)

        $Return['LINK'] = $VerLink;

        switch (true) {
            case (empty($VerLink) or strlen($VerLink) < 20):
                $Return['STATUS'] = "ERR_INVALID_LINK_a";
                break;
            case (!$VerDB = Query("*", "Verification", "id='$VerId'", 1) or $VerUrl != $VerDB['link'] or $VerDB['status'] == 1):
                $Return['STATUS'] = "ERR_INVALID_LINK_b";
                break;

            default:
                $VerId = $VerDB['Admin_id'];

                if ($VerDB['changes']) {
                    $VerChanges = json_decode($VerDB['changes'], true); // "Admin":{"email":"me@emirhakan.com"}
                    foreach ($VerChanges as $tableName => $verChanges) {         // "Admin" => {"email":"me@emirhakan.com"}
                        foreach ($verChanges as $columnName => $verChange) {     // "email" => "me@emirhakan.com"
                            $Process_apply_changes = Process("update", "$tableName", array(
                                $columnName => $verChange
                            ), "id='$VerId'");
                        }
                    }
                    if ($Process_apply_changes) {
                        $Process_update_status = Process("update", "Verification", array(
                            "status" => 1
                        ), "id='$VerDB[id]'");
                    }
                }


                if (!$VerDB['changes'] xor $Process_update_status) {
                    session_unset();
                    session_destroy();
                    $Return['STATUS'] = "SUCC_APPLY_CHANGE";
                }
                break;
        }

        break;

    case 'forgotpassword':
        $email = $_POST['email'];

        switch (true) {
            case (empty($email)):
                $Return['STATUS'] = "ERR_EMPTY";
                break;
            case (!filter_var($email, FILTER_VALIDATE_EMAIL)):
                $Return['STATUS'] = "ERR_INVALID_EMAIL";
                break;
            case (!$_Admin = Query("*", "Admin", "email='$email'", 1)):
                $Return['STATUS'] = "ERR_INVALID_USER";
                break;

            default:
                $ver_email = $email;
                $ver_title = "Reset your password";
                $ver_description = "You can reset your password through the link below:";              // "B" is for resetting password
                $ver_link = UrlRead("core") . "/panel/verification/" . "B" . GetLink(19); //Satis.emirhakan.com>>>>/panel/verification/>>>>B>>>>mq0A3CkbSW7VcI39IEa>>>>2b
                //------SERVER NAME---|------VER. URL------|VER. TYPE|----RANDOM LINK---|VER. ID HEX BASED INTEGER(added later)

                //Create verification data
                $Process_verification = Process("insert", "Verification", array(
                    "status" => 0,
                    "email" => $ver_email,
                    "title" => $ver_title,
                    "description" => $ver_description,
                    "link" => $ver_link,
                    "Admin_id" => $_Admin['id']
                ));

                //Update link by putting the row's id in the end of the link as hexadecimal value.
                $Process_verification_link_update = Process("update", "Verification", array(
                    "link" => $ver_link . dechex($Process_verification)
                ), "id='$Process_verification'");

                if ($Process_verification_link_update and $Process_verification) {
                    SendMail($Process_verification);
                    $Return['STATUS'] = "SUCC_VER_REQ_SENT";
                    $Return['EMAIL'] = $ver_email;
                }
                break;
        }
        break;
}

if ($Admin_id) {
    switch (UrlRead(3)) {

        case 'adminedit':
            $name = ucfirst($_POST['name']);
            $email = $_POST['email'];
            $pass = $_POST['pass'];

            switch (true) {
                case (empty($name) or empty($email) or empty($pass)):
                    $Return['STATUS'] = "ERR_EMPTY";
                    break;
                case ($Admin['name'] == $name and $Admin['email'] == $email):
                    $Return['STATUS'] = "ERR_UNCHANGED";
                    break;
                case (!filter_var($email, FILTER_VALIDATE_EMAIL)):
                    $Return['STATUS'] = "ERR_INVALID_EMAIL";
                    break;
                case (!preg_match("/^\p{L}+$/", $name)):
                    $Return['STATUS'] = "ERR_INVALID_NAME";
                    break;
                case (!password_verify($pass, $Admin['password'])):
                    $Return['STATUS'] = "ERR_INVALID_PASS";
                    break;
                case ($Admin['name'] != $name and $Admin['email'] != $email):
                    $Return['STATUS'] = "ERR_OVER_REQUEST";
                    break;

                case ($Admin['name'] != $name): //Update admin name
                    $Process_edit_admin = Process("update", "Admin", array(
                        "name" => $name
                    ), "id='$Admin_id'");
                    if ($Process_edit_admin) $Return['STATUS'] = "SUCC_NAME";
                    break;

                case ($Admin['email'] != $email): //Update admin email
                    $ver_email = $email;
                    $ver_title = "Confirm your email address";
                    $ver_description = "You can confirm your email through the link below:";               // "A" is for confirming email
                    $ver_link = UrlRead("core") . "/panel/verification/" . "A" . GetLink(19); //Satis.emirhakan.com>>>>/panel/verification/>>>>A>>>>mq0A3CkbSW7VcI39IEa>>>>2b
                    $ver_change['Admin'] = array("email" => $email);                                       //------SERVER NAME---|------VER. URL------|VER. TYPE|----RANDOM LINK---|VER. ID HEX BASED INTEGER(added later)

                    //Create verification data
                    $Process_verification = Process("insert", "Verification", array(
                        "status" => 0,
                        "email" => $ver_email,
                        "title" => $ver_title,
                        "description" => $ver_description,
                        "link" => $ver_link,
                        "Admin_id" => $Admin_id,
                        "changes" => json_encode($ver_change, JSON_UNESCAPED_UNICODE)
                    ));

                    //Update link by putting the row's id in the end of the link as hexadecimal value.
                    $Process_verification_link_update = Process("update", "Verification", array(
                        "link" => $ver_link . dechex($Process_verification)
                    ), "id='$Process_verification'");

                    if ($Process_verification_link_update and $Process_verification) {
                        SendMail($Process_verification);
                        $Return['STATUS'] = "SUCC_VER_REQ_SENT";
                        $Return['EMAIL'] = $ver_email;
                    }
                    break;
            }
            break;

        case 'changepass':
            $pass_old = $_POST['pass_old'];
            $pass_new = $_POST['pass_new'];
            $pass_new_rpt = $_POST['pass_new_rpt'];

            switch (true) {
                case (empty($pass_old) or empty($pass_new) or empty($pass_new_rpt)):
                    $Return['STATUS'] = "ERR_EMPTY";
                    break;
                case ($pass_new != $pass_new_rpt):
                    $Return['STATUS'] = "ERR_INVALID_PASS_RPT";
                    break;
                case (!password_verify($pass_old, $Admin['password'])):
                    $Return['STATUS'] = "ERR_INVALID_PASS";
                    break;
                default:
                    $hashed_pass = password_hash($pass_new, PASSWORD_DEFAULT);

                    //deneme
            }

            break;
    }
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);
