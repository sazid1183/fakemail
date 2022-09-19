<?php
include('smtp/PHPMailerAutoload.php');
$html='Msg';
$sending_my_mail = smtp_mailer($mm_to, $mm_subject, $mm_body);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	// $mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "fakesite83@gmail.com";	//Write email sending from here
	$mail->Password = "";	//Write email sending from password here
	$mail->SetFrom("");  //Write email sending from here
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		
	}
}
?>