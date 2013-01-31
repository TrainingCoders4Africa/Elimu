<?php
require_once('../all_function.php');
	$outil = addslashes($_POST['outil']);// l'option message email ou sms
	$matricule=addslashes($_POST['matricule']);
	$classe=addslashes($_POST['classe']);// code de la classe 
$annee=annee_academique();
switch ($outil)
{
	case 'MAIL':
//if($outil='MAIL'){
//require_once('../class.phpmailer.php');
	$host="smtp.gmail.com";
	$port="465";
	$username="elimuprojet@gmail.com";
	$password="passelimu";
		
	$host="smtp.gmail.com";
	$port=465;
	$username="elimuprojet@gmail.com";
	$password="passelimu";
	
	$expediteur="elimuprojet@gmail.com";
	$reponse="elimuprojet@gmail.com";
	$nom="ELIMU";
	$objet=$_POST['objet'];
	$message=$_POST['message'];//
	//$fichier=$_POST['fichier'];
		if($_FILES['fichier']['name']<>""){
	$fichier=$_FILES['fichier']['name'];
    $dir="../pieces/";
	$fichiers  =$fichier;
	if(file_exists($dir.$fichiers)){
		 unlink($dir.$fichiers);
		}	
 	move_uploaded_file($_FILES['fichier']['tmp_name'], $dir.$_FILES['fichier']['name']);
 	//rename($dir.$fichier,$dir.$logo);
	}
	else
	$fichiers="";
	$adresse="hrakotoarison4@gmail.com";
		$tab=array();
	$i=0;
	//recuperation des email d'une classe
	function adressedest($clas,$annee){
		$i=0;
		$requete='SELECT email_tuteur8 email FROM eleves WHERE matricule in (select eleve from inscription where classe="'.$clas.'" and annee="'.$annee.'") and email_tuteur8 <>""';
		$resultat=mysql_query($requete);
			while($ligne=mysql_fetch_assoc($resultat)){
				$tab[$i]=$ligne["email"];		
				$i++;				
			}			
		return $tab;
	}
	
	function envoiMail($host,$port,$username,$password,$expediteur,$reponse,$nom,$objet,$message,$classe,$annee,$fichier)
	{
		//require_once('class.phpmailer.php');
		require_once('../class.phpmailer.php');
		// creer un compte email pour elimu
			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			
			$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
													   // 1 = errors and messages
													   // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = $host;	   		      // sets GMAIL as the SMTP server
			$mail->Port       = $port;                // set the SMTP port for the GMAIL server
			$mail->Username   = $username;			  // GMAIL username
			$mail->Password   = $password; 
			$mail->SetFrom($expediteur, $nom);
			$mail->AddReplyTo($expediteur, $nom);
			$mail->Subject    = $objet;
			$mail->MsgHTML($message);
			if($fichier<>"")
			$mail->AddAttachment("../pieces/".$fichier);     
			$var[]=array();
			$var=adressedest($classe,$annee);
			echo"Nombre d'element: ";
			echo count(adressedest($classe,$annee));
			echo "<br>";
			foreach($var as $val){	
			$mail->AddAddress($val);		
			}
			if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
								} 
			else {
			  echo "Message sent!";
				}
	}
	
	envoiMail($host,$port,$username,$password,$expediteur,$reponse,$nom,$objet,$message,$classe,$annee,$fichiers);
		
	break;
	//sms au tuteurs de la classe choisi
case 'SMS':
		$CONFIG_KANNEL_HOST="localhost";
		$CONFIG_KANNEL_PORT="8011";
		$in_msg =addslashes($_POST['message']);	
		//fonction envoie de mail
		function sendSmsMessage($in_phoneNumber, $in_msg){
	   $url = '/send/sms/'.urlencode(utf8_encode($in_phoneNumber)).'/'.urlencode(utf8_encode($in_msg));
	   $results = file('http://localhost:8011'.$url);
		}
			//recuperation des téléphones des tuteurs  d'une classe
		function telephonedest($clas,$annee){
		$i=0;
		$requete='SELECT tel_tuteur8 tel FROM eleves WHERE matricule in (select eleve from inscription where classe="'.$clas.'" and annee="'.$annee.'") and tel_tuteur8 <>""';
		$resultat=mysql_query($requete);
			while($ligne=mysql_fetch_assoc($resultat)){
				$tab[$i]=$ligne["tel"];		
				$i++;				
			}			
		return $tab;
		}

		$var[]=array();
			$var=telephonedest($classe,$annee);
			echo"Nombre d'element: ";
			echo count(telephonedest($classe,$annee));
			echo "<br>";
			foreach($var as $val){	
			sendSmsMessage($val, $in_msg);	
			}
			
			break;
		}

?>
