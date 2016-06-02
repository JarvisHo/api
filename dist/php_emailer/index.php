<?php

if(isset($_POST['action'])){

    if(isset($_POST['email']) AND isset($_POST['subject']) AND isset($_POST['body'])) {

        if ((!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email']))){

            SendMail($_POST['email'], $_POST['subject'], $_POST['body']);

        }
    }
}

function SendMail($ToEmail, $MessageSUBJECT, $MessageBODY)
{
    mb_internal_encoding('UTF-8');
//    iconv_set_encoding("internal_encoding", "UTF-8");
    require_once('class.phpmailer.php'); // Add the path as appropriate
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "info@pawmaji.com";
    $mail->Password = "Sil240sx";
    $mail->SetFrom("info@pawmaji.com","泡麻吉客服");
    $mail->CharSet = "utf-8";
    $mail->Subject = mb_encode_mimeheader($MessageSUBJECT, "UTF-8");
    $mail->Body = $MessageBODY;
    $mail->AddAddress($ToEmail);

    if (!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
    } else {
        return "Sent";
    }
}