<?php
session_start();
$rechtab="personnels";
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Personnels >> Suppression" ;
  $pageint="forms/delete/personnels.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Personnels >> Modification" ;
   $pageint="forms/update/personnels.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Personnels >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Personnels   >> Consultation" ;
      $pageint="forms/consulter/personnels.php";
}
else {
      $titre="Personnels >> Ajout" ;
	 
         $pageint="forms/save/personnels.php";
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
