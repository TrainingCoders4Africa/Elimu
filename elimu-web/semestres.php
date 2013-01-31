<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Semestres >> Suppression" ;
  $pageint="forms/delete/semestres.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="semestres >> Modification" ;
   $pageint="forms/update/semestres.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Semestres   >> Consultation" ;
      $pageint="forms/consulter/semestres.php";
}
else {
      $titre="Semestres >> Ajout" ;
	 
         $pageint="forms/save/semestres.php";
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
