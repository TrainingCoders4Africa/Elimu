<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Disciplines >> Suppression" ;
  $pageint="forms/delete/sousmatiere.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Disciplines - Sous Discipline >> Modification" ;
   $pageint="forms/update/sousmatiere.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Disciplines - Sous Discipline  >> Consultation" ;
      $pageint="forms/consulter/sousmatiere.php";
}
else {
      $titre="Disciplines - Sous Discipline>> Ajout" ;
	 
         $pageint="forms/save/sousmatiere.php";
		}

$p="";
$uno=0;
$dos=0;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
