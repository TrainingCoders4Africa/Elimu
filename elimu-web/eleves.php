<?php
session_start();
$rechtab="eleves";
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
if (isset($_GET["sup"])) {
  $titre="  Liste des El�ves de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/eleves.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="  Liste des El�ves de la ".$classe." >> Modification" ;
   $pageint="forms/update/eleves.php";
}
elseif(isset($_GET["rech"])) {
   $titre="  Recherche des El�ves de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Liste des El�ves de la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/eleves.php";
}
else {
      $titre="  Inscription des El�ves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/eleves.php";
		}

$p="";
$uno=1;
$dos=1;
$trois=0;
$quatre=0;
$cinq=1;
$six=0;
require_once 'include.php';
?>
