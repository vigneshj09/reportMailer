<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/PHPMailer.php';



require "config.php";


$query = mysqli_query($con,"select * from report");

if (mysqli_num_rows($query) > 0) {
    // Step 3: Compose Email
    $emailBody = "Dear Sir,\n\n Please find below the Daily Report (Tarapore Towers-TTB) for Week starting 26-Dec-23 to 01-Jan-24:\n\n";
    $emailBody .= "<tr><th>Date</th><th>Checked</th><th>Status</th></tr>";

    while ($result = mysqli_fetch_assoc($query)) {
        $emailBody .= "<tr><td>".$result['date']."</td>";
        $emailBody .= "<td>".$result['mode']."</td>";
        $emailBody .="<td>".$result['status']."</td> </tr>";
        $emailBody .= "\n-------------------------\n";
    }

    // Step 4: Send Email
    $mail = new PHPMailer(true);

    $name = "Weekly Report";  // Name of your website or yours
    $to = "vigneshj@eybus.in";  // mail of reciever
    $subject = "Weekly Report ( Tarapore Towers - TTB ) for Week";
    $body = "Send Mail Using PHPMailer - MS The Tech Guy";
    $from = "pagalavan@magdyn.in";  // you mail
    $password = "Pagalavan@12345";

    try {
        $mail->isSMTP();                   
        $mail->Host = "smtp.hostinger.com"; 
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 465;  
        $mail->SMTPSecure = "ssl";
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); 
        $mail->Subject = ("$subject");
        $mail->Body = $emailBody;

        $mail->send();
        echo 'Email sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "No data found in the database.";
}

?>