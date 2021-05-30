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
                if ($VerDB['Admin_id']) $VerId = $VerDB['Admin_id'];
                if ($VerDB['Users_id']) $VerId = $VerDB['Users_id'];

                $VerChanges = json_decode($VerDB['changes'], true); // "Admin":{"email":"me@emirhakan.com"}
                foreach ($VerChanges as $tableName => $verChanges) {         // "Admin" => {"email":"me@emirhakan.com"}
                    foreach ($verChanges as $columnName => $verChange) {     // "email" => "me@emirhakan.com"
                        $Query_apply_changes = Process("update", "$tableName", array(
                            $columnName => $verChange
                        ), "id='$VerId'");
                    }
                }
                if ($Query_apply_changes) {
                    $Query_update_status = Process("update", "Verification", array(
                        "status" => 1
                    ), "id='$VerDB[id]'");
                }
                if ($Query_apply_changes and $Query_update_status) {
                    session_unset();
                    session_destroy();
                    $Return['STATUS'] = "SUCC_APPLY_CHANGE";
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
                    $ver_description = "Please click to button to confirm your new email address";
                    $ver_link = UrlRead("core") . "/panel/verification/" . "A" . GetLink(19); //Satis.emirhakan.com>>>>/panel/verification/>>>>A>>>>mq0A3CkbSW7VcI39IEa>>>>2b
                    $ver_change['Admin'] = array("email" => $email);                                      //------SERVER NAME---|------VER. URL------|VER. TYPE|----RANDOM LINK---|VER. ID HEX BASED INTEGER(added later)

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

    }
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);
