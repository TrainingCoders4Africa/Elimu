<?php
session_start();
$rechtab="enseignant";
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Enseignants >> Suppression" ;
  $pageint="forms/delete/enseignants.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Enseignants >> Modification" ;
   $pageint="forms/update/enseignants.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Enseignants >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Enseignants   >> Consultation" ;
      $pageint="forms/consulter/enseignants.php";
}
else {
      $titre="Enseignants >> Ajout" ;
	 
         $pageint="forms/save/enseignants.php";
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
