<?php

require 'models/homeModels.php';

$category = getAllCategory();

$projects = getAllProjects();

$skills = getAllSkills();

$schools = getAllSchools();

$company = getAllCompany();

$infos = getInfos();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    if ($email != "" && $subject != "" && $message != "") {
        if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-z]{2,6}$#", $email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $header = "MIME-Version: 1.0\r\n";
                $header .= 'From: "YassineBenHamdoune.fr"<contact@YassineBenHamdoune.fr>'."\n";
                $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
                $header .= 'Content-Transfer-Encoding: 8bit';

                $message = '
                <!DOCTYPE html>
                <html lang="">
                <body>
                    <h3>Message de : '.$email.'</h3>
                    <h4><u>Sujet du message</u> : '.$_POST['subject'].'</h4>
                    <blockquote>'.nl2br($_POST['message']).'</blockquote>
                </body>
                </html>
                ';

                mail("contact@YassineBenHamdoune.fr", "Nouveau message !", $message, $header);

                header('Location: https://YassineBenHamdoune.fr');
            }
        }
    }
}

require 'views/home.php';

?>
