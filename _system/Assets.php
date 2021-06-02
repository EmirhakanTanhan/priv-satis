<?php


use _system\PHPMailer\PHPMailer;
use _system\PHPMailer\SMTP;
use _system\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

require 'db.inc.php';

class Assets
{

    public function __construct()
    {
        $this->Mail = json_decode(Query("contact", "Settings", "id=1", 1)['contact'], true);
        $this->Seo = json_decode(Query("seo", "Settings", "id=1", 1)['seo'], true);
    }

    /**
     * @param $Mail
     * @param $Konu
     * @param $Icerik
     * @throws PhpMailer\Exception
     */
    public function MailGonder($Data)
    {

        $Message = '
        <p style="font-size: 18px">' . $Data['message'] . '</p> 
        <a style="font-size: 18px" href="' . $Data['link'] . '" target="_blank">Confirm</a>
        <br>
        <p style="font-size: 14px; color: #b2b2b5"> This e-mail was sent by <a href="' . UrlRead("core") . '">' . $this->Seo['site_title'] . '</a>.</p>
';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->IsHTML(true);
        $mail->SMTPDebug = 0;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;


        // MAĞAZA MAİL AYAR
        $mail->Host = $this->Mail['smtp_host'];
        $mail->SMTPSecure = $this->Mail['smtp_secure'];
        $mail->Port = $this->Mail['smtp_port'];
        $mail->Username = $this->Mail['smtp_user']; //GÖNDERENİN MAİL ADRESİ
        $mail->Password = $this->Mail['smtp_pass'];


        $mail->setFrom($this->Mail['smtp_user']); //GÖNDERENİN GÖZÜKMESİNİ İSTEDİĞİ MAİL ADRESİ //DEFAULT OLARAK USERNAMEDEN ÇEK
        $mail->addReplyTo($this->Mail['smtp_user']); //CEVAP VERİLEN MAİL
        $mail->addAddress($Data['email']); //GÖNDERİLEN KİŞİNİN MAİLİ
        $mail->Subject = $Data['subject'];
        $mail->Body = $Message;


        $mail->msgHTML($Message);

        if (!$mail->send()) {
            return $mail->ErrorInfo;
        } else {
            return 'OK';
        }

    }
}
