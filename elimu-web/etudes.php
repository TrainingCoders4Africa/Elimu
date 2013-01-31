<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille  Décision Conseil >> Suppression" ;
  $pageint="forms/delete/decision.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille Décision Conseil >> Modification" ;
   $pageint="forms/update/decision.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Niveau d'Etude   >> Consultation" ;
      $pageint="forms/consulter/etudes.php";
}
else {
      $titre="Niveau d'Etude >> Ajout" ;
	 
         $pageint="forms/save/etudes.php";
		}

$p="";
$uno=1;
$dos=1;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
