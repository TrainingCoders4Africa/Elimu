<head>
<script language=JavaScript>
function ChangeTitle(title, step){
	if(step==undefined || step > title.length)step=0;
	document.title=title.substr(step) + title.substr(0, step);
	step++;
	setTimeout('ChangeTitle("' + title + '", ' + step + ');', 100);
}

// C'est ici que ça se passe. Ecrivez le titre que vous voulez
ChangeTitle("ELIMU: GESTION SCOLAIRE & COLLABOTION PARENTS ET ADMINISTRATION VIA SYSTEME SMS ");
</script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<?php
@$menu="";
include"dao/connection.php";

$req="select * from etablissements";
$exe=mysql_query($req)or die(mysql_error());

$reqc="select * from categories";
$exec=mysql_query($reqc)or die(mysql_error());

$req4="select * from administrateurs";
$exe4=mysql_query($req4)or die(mysql_error());
if(mysql_num_rows($exe)+mysql_num_rows($exec)+mysql_num_rows($exe4)<3){
	if (mysql_num_rows($exe)==0) {
	  echo'<SCRIPT LANGUAGE="JavaScript">
location.href="parametrage/config.php"
</SCRIPT>';
//header("Location:parametrage/config.php");
	}
elseif (mysql_num_rows($exec)==0) {
					      // header("Location:parametrage/design.php");
						    echo'<SCRIPT LANGUAGE="JavaScript">
location.href="parametrage/design.php"
</SCRIPT>';
						}						
					elseif (mysql_num_rows($exe4)==0) {
					 echo'<SCRIPT LANGUAGE="JavaScript">
location.href="parametrage/users.php"
</SCRIPT>';
					      // header("Location:parametrage/users.php");
						}					

									

	}

else {
 echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php"
</SCRIPT>';
   //header("Location:accueil.php");
}
?>