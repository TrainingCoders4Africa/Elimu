<?php
$matricule=$_SESSION['matricule'];
$classe=securite_bdd($_GET['classe']);
$eleve=securite_bdd($_GET['eleve']);
$adresse=securite_bdd($_GET['adresse']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
?>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data" >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD>
		<TD class=petit>&nbsp;<input type=hidden name="matricule" id="matricule" value="<?php echo $matricule;?>"></TD>
			<TD class=petit>&nbsp;<input type=hidden name="eleve" id="eleve" value="<?php echo $eleve;?>"></TD>
		</TR>
<tr><td><B>Object</B> : <input type="text" name="objet" size="45" maxlength="100"  required/></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
	<?php
	echo'
	<tr><td width="100%"><B>Message </B>: ';
				$sBasePath = $_SERVER['PHP_SELF'] ;
				$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

				$oFCKeditor = new FCKeditor('FCKeditor1') ;
				$oFCKeditor->BasePath	= $sBasePath ;
				//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
				$oFCKeditor->Create() ;
	
	?>
   <!-- <tr><td><B>Message </B>: </td><td><textarea id="textar" name="message" cols="80" rows="10" required ></textarea></td>
	<td><input type="text" name="message" size="45" maxlength="100"  required/></td>!-->
	</tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
	<TR>
<TD ><B>&nbsp;Piéce </B><INPUT TYPE="file" name="photo"></TD></TR>
<tr><td></td><td></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</tbody>

<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>
<tr><TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $classe;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="adresse" value="<?php echo $adresse;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="annee" value="<?php echo $annee;?>"></TD></tr>
</table>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["eleve"]) ) {
$matricule=addslashes($_POST['matricule']);
	$classe=addslashes($_POST['classe']);// code de la classe 
	$annee=addslashes($_POST['annee']);
	$eleve=addslashes($_POST['eleve']);
	$adresse=addslashes($_POST['adresse']);
	$objets=addslashes($_POST['objet']);
	$message=$_POST['FCKeditor1'];
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
//require_once('../class.phpmailer.php');
$mail             = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.yourdomain.com"; // SMTP server
//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
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

}
?>