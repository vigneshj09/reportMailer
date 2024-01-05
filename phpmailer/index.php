<?php
// ! Requried File paths to send the mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/PHPMailer.php';

require "../config.php";

//~ mail details
$curDate =date('d-M-y', strtotime("-0 days"));
$lastDate =date('d-M-y', strtotime("-6 days"));
$name = "Weekly Report";  
$to = "vigneshj@eybus.in";  
$subject = "Weekly Report ( Tarapore Towers - TTB ) for Week :".$lastDate." to ".$curDate." ";
$from = "pagalavan@magdyn.in";  
$password = "Pagalavan@12345";


$emailBody = "<html><body>";
$emailBody .= "<p>Dear Sir,<br/><br/>Please find below the Weekly Report (Tarapore Towers-TTB) for Week starting <b>".$lastDate."</b> to <b>".$curDate."</b> <br/></p>";
$emailBody .= "<table style='border-collapse: collapse; width: 100%;' border='1'>";
$emailBody .= "<thead style='background-color: #3498db; color: #fff;'><tr><th style='padding: 10px;'>Date</th><th style='padding: 10px;'>Checked</th><th style='padding: 10px;'>Status</th></tr></thead>";
$emailBody .= "<tbody>";

//! Check for each day if data is found or not
for ($i = 6; $i >= 0; $i--) {
    $currentDate = date('Y-m-d', strtotime("-$i days"));
    $dayQuery = mysqli_query($con, "
        SELECT * FROM report
        WHERE DATE(`date`) = '$currentDate'
    ");

    if (mysqli_num_rows($dayQuery) > 0) {
        $result = mysqli_fetch_assoc($dayQuery);
        // while ($result = mysqli_fetch_assoc($dayQuery)) {
            $emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'>" . date('d-M-y', strtotime($result['date'])) . "</td>";
            $emailBody .= "<td style='padding: 8px; border: 1px solid #ddd;'>" . ($result['mode'] == 'off' ? 'No' : 'Yes') . "</td>";
            $emailBody .= "<td style='padding: 8px; border: 1px solid #ddd;'>" . $result['status'] . "</td></tr>";
        // }
    } else {
        //~ Show data for the day if no actual data is found
        $emailBody .= "<tr><td style='padding: 8px; border: 1px solid #ddd;'>".date('d-M-y', strtotime($currentDate))."</td>";
        $emailBody .= "<td style='padding: 8px; border: 1px solid #ddd;'></td>";
        $emailBody .= "<td style='padding: 8px; border: 1px solid #ddd;'></td></tr>";
    }
}
$emailBody .= "</tbody></table><br/>";
// $emailBody .= "<p><b>Regards,</b><br/>Name<br/>+91 1234567890 | <a href='mailto:$from'>$from</a></p>";
$emailBody .= "</body></html>";

//~ Send Email
$mail = new PHPMailer(true);

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

    //~ Email Settings
    $mail->isHTML(true);
    $mail->setFrom($from, $name);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $emailBody;

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
