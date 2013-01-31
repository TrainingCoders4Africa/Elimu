<?php
session_start();
@$menu=$_SESSION["menu"];
$profile=$_SESSION["profil"];
/*if (isset($_GET["vis"])) {
  $titre=" Série >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" salles de Cours >> Modification" ;
   $pageint="forms/update/salles.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" salles de Cours >> Consultation" ;
         $pageint="forms/consulter/salles.php";
}

else {$titre=" salles de Cours >> Ajout" ;
	 $pageint="forms/save/salles.php";
      
}
$p="";
$uno=1;
$dos=1;
if($profile=="Administrateur")
$trois=1;
else
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
