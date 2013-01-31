<?php
//require_once('class.phpmailer.php');
require_once('../all_function.php');
require_once('../class.phpmailer.php');

$outil = addslashes($_POST['outil']);// l'option message email ou sms
	$matricule=addslashes($_POST['matricule']);
	$classe=addslashes($_POST['classe']);// code de la classe 
	$annee=addslashes($_POST['annee']);
$msg=$_POST['message'];
$objet=$_POST['objet'];
$obj="ELIMU";
echo "OBJET= ".$obj."<br>";
echo "MESSAGE= ".$msg."<br>";
//include 'connexion.php';
	//$red="cm2";
	$requete="select email_tuteur8 email from eleves where matricule in(select eleve from inscription where classe='$classe' and annee='$annee')
	and email_tuteur8 <>''";
	$resultat=mysql_query($requete);
	while($ligne=mysql_fetch_assoc($resultat)){

$mail             = new PHPMailer();
$body             = file_get_contents('contents.html');
$body             = preg_replace('/[\]/','',$body);
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
$mail->SetFrom('elimuprojet@gmail.com', $obj);
$mail->AddReplyTo("elimuprojet@gmail.com",$obj);
$mail->Subject    = $objet;
$mail->MsgHTML($msg);
//$mail->AddAddress($address, "John Doe");
$mail->AddAddress($ligne["email"]);
		//echo "mail: ".$ligne["email"];
		echo "<br>";
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}
}
?>
