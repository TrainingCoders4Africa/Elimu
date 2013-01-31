<?php
session_start();
$rechtab="surveiller";
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Surveillants >> Suppression" ;
  $pageint="forms/delete/surveillants.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Surveillants >> Modification" ;
   $pageint="forms/update/surveillants.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Surveillants >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Surveillants   >> Consultation" ;
      $pageint="forms/consulter/surveillants.php";
}
else {
      $titre="Surveillants >> Ajout" ;
	 
         $pageint="forms/save/surveillants.php";
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
