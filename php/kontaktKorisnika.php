<?php
session_start();
//header('Content-type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'php_mailer/src/Exception.php';
require 'php_mailer/src/PHPMailer.php';
require 'php_mailer/src/SMTP.php';
$status =404;
$data=null;

if(isset($_POST['provera']))
{   
    
    $greske = [];
    $naslov = $_POST['naslov'];
    $poruka = $_POST['poruka'];
    $regNaslov ="/^[A-z\s\!\?]{3,50}$/";
	$regPoruka ="/^[A-z\?\@\-\_\!\s]{3,500}$/";

    
    if(count($greske) >0)
    {   $status=422;
        echo "<ul>";
        foreach($greske as $greska)
        {
            echo "<li>$greska</li>";
        }
        echo "</ul>";
    }else
    {   
        $imePrezime=$_SESSION['korisnik']->imePrezime;
        $email=$_SESSION['korisnik']->email;
        
                       

                       
                       $mail = new PHPMailer(true);
           
                       try {
               //Server settings
               $mail->SMTPDebug = 0;
                $mail->SMTPOptions = array(
               'ssl' => array(
                   'verify_peer' => false,
                   'verify_peer_name' => false,
                   'allow_self_signed' => true
               )
           );                                          // Enable verbose debug output
               $mail->isSMTP();                                      // Set mailer to use SMTP
               $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
               $mail->SMTPAuth = true;                               // Enable SMTP authentication
               $mail->Username = 'nemanjaranisavljevic97@gmail.com';                 // SMTP username
               $mail->Password = 'beka123456';                           // SMTP password
               $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
               $mail->Port = 587;                                    // TCP port to connect to
           
               //Recipients
               $mail->setFrom('crazylordftw@gmail.com', $imePrezime.'(Bicycles)');
                $mail->addAddress('beka9977@gmail.com', 'Nemanja Ranisavljevic');     // Add a recipient
               // $mail->addAddress('ellen@example.com');               // Name is optional
               // $mail->addReplyTo('info@example.com', 'Information');
               // $mail->addCC('cc@example.com');
               // $mail->addBCC('bcc@example.com');
           
               //Attachments
               // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
               // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
           
               //Content
               $mail->isHTML(true);                                  // Set email format to HTML
               $mail->Subject =$naslov;
               $mail->Body="Poruka sa emaila ".$email."<br/>".$poruka;
               // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
               
               $mail->send();
           
              // echo 'Message has been sent';
               $status = 200;
               $data="Uspesno ste se registrovali";
           } catch (Exception $e) {
            $status = 500;
           }
           
    
    }
    
    
}


http_response_code($status);
    echo json_encode($data);

