<?php
require_once('../all_function.php');

$matricule=addslashes($_POST['matricule']);
	$classe=addslashes($_POST['classe']);// code de la classe 
	$annee=addslashes($_POST['annee']);
	$eleve=addslashes($_POST['eleve']);
	$adresse=addslashes($_POST['adresse']);
	$objets=addslashes($_POST['objet']);
	$message=addslashes($_POST['message']);
	if($_FILES['photo']['name']<>""){
	$photo=$_FILES['photo']['name'];
    $dir="../pieces/";
	$chemin  =$photo;
	if(file_exists($dir.$chemin)){
		 unlink($dir.$chemin);
		}	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
	}
	else
	$chemin="";

//error_reporting(E_ALL);
error_reporting(E_STRICT);
date_default_timezone_set('America/Toronto');
require_once('../class.phpmailer.php');
$mail             = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "elimuprojet@gmail.com";  // GMAIL username
$mail->Password   = "passelimu";            // GMAIL password

// creer un compte email pour elimu
$mail->SetFrom('elimuprojet@gmail.com', 'TEST ELIMU');

$mail->AddReplyTo("elimuprojet@gmail.com","TEST ELIMU");

$mail->Subject    = $objets;

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


//$mail->MsgHTML();
//corp du mail
$mail->MsgHTML($message);
 
$mail->AddAddress($adresse);

if($chemin<>"")
$mail->AddAttachment("../pieces/".$chemin);  
//$lieu="../pieces/".$chemin;
   // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {

  echo "Message sent à ".$adresse." !";
}
	?>
