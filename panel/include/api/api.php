<?php
$Post = Post(); //Formdan göndermiyosan (mesela button), bunu kullan
if ($_SESSION['Admin_id']) {
    $Admin_id = $_SESSION['Admin_id'];
    $Admin = Query("*", "Admin", "id='$Admin_id'", 1);
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
                    $Query_edit_admin = Process("update", "Admin", array(
                        "name" => $name
                    ), "id='$Admin_id'");
                    if ($Query_edit_admin) $Return['STATUS'] = "SUCC_NAME";
                    break;

                case ($Admin['email'] != $email): //Update admin email
                    $ver_email = $email;
                    $ver_title = "Confirm your email address";
                    $ver_description = "Please click to button to confirm your new email address";
                    $ver_link = UrlRead("core") . "/panel/verification/" . "A" . GetLink(19); //Satis.emirhakan.com>>>>/panel/verification/>>>>A>>>>mq0A3CkbSW7VcI39IEa>>>>2b
                    $ver_change['Admin']['email'] = $email;                                                //------SERVER NAME---|------VER. URL------|VER. TYPE|----RANDOM LINK---|VER. ID HEX BASED INTEGER(added later)

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
                        $Return['STATUS'] = "SUCC_VER_REQ_SENT";
                        $Return['EMAIL'] = $ver_email;
                    }
                    break;
            }

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
            }
            break;

        case 'vercheck':
            $VerUrl = $_POST['ver_url']; //Page url >>>> http://satis.me/panel/verification/ADOI8U7oCXOJoJJxBDMF30
            $VerLink = explode("/", $VerUrl); //Explode the link out of the page url
            $VerLink = end($VerLink); //verification link >>>> ADOI8U7oCXOJoJJxBDMF30
            $VerType = substr($VerLink, 0, 1); //verification link >>>> A
            $VerId = hexdec(substr($VerLink, 20)); //verification id transformed to decimal from hexadecimal >>>> 30 (hex) >>>> 48 (dec)

            switch (true) {
                case (empty($VerLink) or strlen($VerLink) < 20):
                    $Return['STATUS'] = "ERR_INVALID_LINK_a";
                    break;
                case (!$VerDB = Query("*", "Verification", "id='$VerId'", 1) or $VerUrl != $VerDB['link']):
                    $Return['STATUS'] = "ERR_INVALID_LINK_b";
                    break;
            }
    }

} else {
    $Return['STATUS'] = 'ERR_LOGIN_REQUIRED';
}

echo json_encode($Return, JSON_UNESCAPED_UNICODE);
