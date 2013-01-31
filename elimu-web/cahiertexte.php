<?php
session_start();
$rechtab="cahiertexte";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
if (isset($_GET["sup"])) {
  $titre="  Le cahier de Texte de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/cahiertexte.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le cahier de Texte de la  ".$classe." >> Modification" ;
   $pageint="forms/update/cahiertexte.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le cahier de Texte de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Le cahier de texte de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/cahiertexte.php";
}
else {
      $titre=" Le cahier de Texte de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/cahiertexte.php";
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
