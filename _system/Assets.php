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
        $this->Mail = json_decode(Sorgu("contact", "Settings", "id=1", 1)['contact'], true);
        $this->Seo = json_decode(Sorgu("seo", "Settings", "id=1", 1)['seo'], true);
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
</head>
<body style="margin:0px; background: #F4F8FB;">
<div width="100%" style="background: #F4F8FB; padding: 0px 0px; font-family:Poppins; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">

    <div style="padding: 40px; background: #fff;border-top: 3px solid #f26861; box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.1)">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
      
          <tr>
            ' . $Data['message'] . '
          </tr>
         
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> Bu Mail <a href="satis.me">'.$this->Seo['site_title'].'</a> tarafından hazırlanmıştır. <br>
        </p>
    </div>
  </div>
</div>
</body>
</html>';

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->IsHTML(true);
        $mail->SMTPDebug = 1;
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
