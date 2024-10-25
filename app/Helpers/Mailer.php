<?php

namespace App\Helpers;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;


/* Example:

    $this->Mailer->renderAndSend(
        'test',  >>> test.mt.php
        [
            'name' => 'name',
            'age' => 10
        ],
        'example@mail.hu',
        'subject'
    )

*/

class Mailer
{
    function renderAndSend($file, $data, $address, $subject)
    {
        ob_start();

        $path = "app/Views/templates/mails/$file.mt.php";

        // Ellenőrizzük, hogy a fájl létezik-e
        if (file_exists($path)) {
            // Változók beállítása
            foreach ($data as $key => $value) {
                $$key = $value; // Dinamikusan létrehozunk változókat a $data tömb kulcsainak megfelelően
            }

            // Sablonfájl beolvasása
            include($path);

            // Sablonfájl tartalmának mentése a változóba
            $body = ob_get_clean();

            // E-mail elküldése
            self::send($address, $body, $subject); // Feltehetően itt meghívnánk egy másik függvényt, ami elküldi az e-mailt
        } else {
            // Hibás fájlelérés esetén hibaüzenet kiírása
            echo "Error: File $path not found";
            exit;
        }
    }



    public function send($address, $body, $subject)
    {
        try {
            $mail = new PHPMailer(true);

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            // $mail->SMTPDebug = 3;

            $mail->CharSet = 'UTF-8';
            $mail->IsSMTP();
            $mail->SMTPAuth = false;

            $mail->Host = $_SERVER['MAILER_HOST'];

            // Setting the sender's email address
            $mail->setFrom($_SERVER['MAILER_SET_FROM'], $_SERVER['MAILER_SET_TO']);
            $mail->addBCC('kbuprogram@max.hu');                           // Titkos másolat (BCC)

            // Adding the recipient's email address
            $mail->addAddress($address);

            $mail->isHTML(true);
            $mail->WordWrap = 50;

            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
        } catch (Exception $e) {
            var_dump($e);
            return false;
        }
    }
}
