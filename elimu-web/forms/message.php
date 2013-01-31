<!-- 
This is an example of what your HTTP command would like like in FrontlineSMS:

http://localhost:8090/c4aSMS/index.php?sender_number=${sender_number}&keyword=${keyword}&content=${message_content}&date=${date}
-->
<?php
//require_once 'all_function.php';
//Set the database access information as variables.
$table = 'message';

$result = mysql_query("SELECT * FROM etablissements") or die(mysql_error()); 
	$row = mysql_fetch_array( $result );
 $etablissement=$row['libelle'];
 
// Sets the variables coming from FrontlineSMS
@$sender_number = $_REQUEST['sender_number'];
echo $sender_number;
@$keyword = $_REQUEST['keyword'];
echo $keyword;
@$message_content= $_GET['message_content'];
echo $message_content;
$date = date("YYYY-mm-dd");

if (isset($_REQUEST['sender_number' ]))
{
$valeur = explode(" ",$message_content);
$matricule=$valeur[0];
$profile=$valeur[1];
$resulta = mysql_query("SELECT prenom,nom FROM personnels where matricule='$matricule'") or die(mysql_error()); 
	$rowa = mysql_fetch_array( $resulta );
 $prenom=$rowa['prenom'];
  $nom=$rowa['nom'];
  $perso=$prenom.' '.$nom;

// This variable connects to your database
/*$connect = mysql_connect("$db_host", "$db_user","$db_pwd") or die('Cannot connect to the database because: ' . mysql_error());
mysql_select_db("$database");*/

// This variable sets up the information to send to your database
$send = "INSERT INTO $table(id,name,number,keyword,content,date) VALUES('','$perso','$sender_number','$keyword','$message_content','$date')";
$ft=mysql_query($send);

if($ft)
{
$CONFIG_KANNEL_HOST="localhost";
$CONFIG_KANNEL_PORT="8011";
$in_phoneNumber=$sender_number; 

echo "message=".$matricule;
//$req ="";
switch ($keyword)
{
	case 'PERSONNEL':
		$req = "select login1,motdepasse7 FROM user WHERE cdeetud ='$matricule' and profile5='$profile' ";
		break;
	case 'FACT':
		$req = "select facteurs FROM classes WHERE libelle_classes = '".$classes."'";
		break;
	case 'PREV':
		$req = "select preventions FROM classes WHERE libelle_classes = '".$classes."'";
		break;
	case 'SIGNE':
		$req = "select consequences FROM classes WHERE libelle_classes = '".$classes."'";
		break;
	case 'SOIN':
		$req = "select soins FROM classes WHERE libelle_classes = '".$classes."'";
		break;
}
$result = mysql_query($req);

//$in_msg = "";
$row=mysql_fetch_row($result);
$login=$row[0]; $passe=$row[1];
$in_msg = "Bienvenue à l'application Elimu de l'établissement ".$etablissement." voici vos infos Login:".$login." Motpasse:".$passe." Profil:".$profile." Veuiller ne pas repondre à ce message";	

echo "in message=".$in_msg;	
	function sendSmsMessage($in_phoneNumber, $in_msg)
 {
   $url = '/send/sms/'.$in_phoneNumber.'/'.urlencode(utf8_encode($in_msg));

   $results = file('http://localhost:8011'.$url);
 }
 sendSmsMessage($in_phoneNumber, $in_msg);
echo  'ok';
}
//call the connect and send variables, and then close the connection
}
//mysql_close($connect);
?>