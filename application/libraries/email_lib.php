<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Email_lib
{
	public function __construct()
	{
		
	}
 	
	function send_mail($email_data='')
	{
		extract($email_data);
		
		if(!isset($from))
			$from = '';
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From:'.$from;
		
		$user_name = $from;
		
		$user_name = "cs@jobmoq.pk";
		$user_pass = '';
		if($user_name == "sales@furniturenation.com")
			$user_pass = 'abc';
			
	
		
		include_once 'phpmailer.php';
			
			//Create a new PHPMailer instance
			$mail = new PHPMailer();
			
			//$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "secure.emailsrvr.com"; // sets the SMTP server
			$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
			$mail->Username   = $user_name; // SMTP account username
			$mail->Password   = $user_pass; 
			
		
			//Set who the message is to be sent from
			if($from == 'cs@jobmoq.pk')
				$mail->setFrom($from, 'Job Moqa');
			else
				$mail->setFrom($from);
			//Set who the message is to be sent to
			$mail->addAddress($to);
			if(isset($cc) && $cc != '')
			{	
				$arr_cc = explode(',',$cc);
				foreach($arr_cc as $t_cc)
					$mail->AddCC($t_cc);
			}
			//Set the subject line
			$mail->Subject = $subject;
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
			$mail->msgHTML($message);
			//Replace the plain text body with one created manually
			//$mail->AltBody = 'This is a plain-text message body';
			//Attach an image file
			//$mail->addAttachment('images/phpmailer_mini.png');
			
			//send the message, check for errors
			return $mail->send();
		
		//return mail($to,$subject,$message,$headers);
	}	
}
?>