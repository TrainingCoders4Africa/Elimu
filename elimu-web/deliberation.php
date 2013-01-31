<?php
session_start();
@$menu=$_SESSION["menu"];
include 'all_function.php';
$code=$_GET['num'];
$classe=libclasse($code);
if (isset($_GET["sup"])) {
  $titre="  Délibération des Notes de la ".$classe."  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Délibération des Notes de la ".$classe." >> Modification" ;
   $pageint="forms/update/deliberation.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Délibération des Notes de la ".$classe."   >> Consultation" ;
      $pageint="forms/consulter/deliberation.php";
}
else {
      $titre="Délibération des Notes de la ".$classe." >> Ajout" ;
	 
         $pageint="forms/save/deliberation.php";
		}

$p="";
$uno=0;
$dos=1;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
