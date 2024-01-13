<?php 
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    
        function sendEmail($pdf){
            require 'Library/phpmailer/src/PHPMailer.php';
            require 'Library/phpmailer/src/SMTP.php';
            require 'Library/phpmailer/src/Exception.php';
            if(!isset($_SESSION['user'])){
                header("Location: login.html");
            }
            else{
                $email = $_SESSION['user'];
            }

            $mail = new PHPMailer(true);
        
            try {
                $mail->SMTPDebug = 0;                   
                $mail->isSMTP();                                          
                $mail->Host       = 'smtp.gmail.com';                   
                $mail->SMTPAuth   = true;                                    
                $mail->Username   = 'saloc2204@gmail.com';                     
                $mail->Password   = 'nayu symp mvkf jrbj';                              
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                $mail->setFrom('salmondavid089@gmail.com', 'SALOC');
                $mail->addAddress($email);    
        
                $mail->isHTML(true);                                  
                $mail->Subject = utf8_decode('¡Gracias por tu Compra! - Saloc');
                $cuerpo = '<div style="background-color: #004346; width: 100%; height: 3em; border-radius: 0.3em;">
                               <img src="Images/logoSaloc2.png" alt="Saloc">
                           </div>
                           <div style="background-color: lightgray; width: 100%; height: 5em; border-radius: 0.3em;">
                               <h1 style="color: #694B34; font-weight: bold; text-align: center;">Gracias por su compra</h1>
                               <p style="font-family: Dosis, sans-serif; text-align: center;">Nos llena de alegría saber que has elegido nuestro 
                                producto y confiado en la calidad que ofrecemos. En Saloc, nos esforzamos 
                                constantemente por proporcionar productos que superen las expectativas de nuestros clientes, 
                                y tu elección nos impulsa a seguir ofreciendo lo mejor.</p><br>
                                <p style="font-family: Dosis, sans-serif; text-align: center;">Adjuntamos su comprobante de compra</p>
                            </div>';
                //$mail->addAttachment('Library/ComprobanteSaloc.pdf', 'Comprobante.pdf');
                $mail->addAttachment($pdf, 'ComprobanteSaloc.pdf');
                $mail->Body    = utf8_decode($cuerpo);
        
                $mail->setLanguage('es','C:/xampp/htdocs/saloc/Library/phpmailer.lang-es.php');
        
                $mail->send();
                unlink($pdf);
                echo '<h1 style="color: green; font-weight: bold; text-align: center;">Se envió el correo de manera correcta</h1>';
                header("Location: index.html");
            } catch (Exception $e) {
                echo "Error al enviar el correo electrónico de la compra: {$mail->ErrorInfo}";
                exit;   
            }
        }
?>