<?php
define ('EMAIL','');
define ('PASS','');
	/*	// Import PHPMailer classes into the global namespace
	// code for php mailer
			// These must be at the top of your script, not inside a function
			require 'PHPMailer\src\Exception.php';
			require 'PHPMailer\src\PHPMailer.php';
			require 'PHPMailer\src\SMTP.php';

			require 'PHPMailer-5.2-stable\PHPMailerAutoload.php';
			//require 'credentials.php';

			$mail = new PHPMailer;

			$mail->SMTPDebug = 4;                               // Enable verbose debug output

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom(EMAIL, 'SAKEC-LMS');
			//$mail->addAddress("nikhil.jakharia@sakec.ac.in");     // Add a recipient
			$mail->addAddress("$receiver_email");     // Add a recipient

			$mail->addReplyTo(EMAIL);

			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Your Leave';
			$mail->Body    = 'your leave has been applied. pls login into system to check it';
			$mail->AltBody = 'your leave has been applied. pls login into system to check it';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}	*/
?>


