<?php


namespace application\lib;


class Email
{
    public function sendMail($email, $headline, $text) {

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: <romantest31@gmail.com>' . "\r\n";

        mail($email, $headline, $text, $headers);
    }
}