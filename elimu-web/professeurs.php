<?php
session_start();
$rechtab="enseignant";
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Professeurs >> Suppression" ;
  $pageint="forms/delete/professeurs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Professeurs >> Modification" ;
   $pageint="forms/update/professeurs.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Professeurs >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Professeurs   >> Consultation" ;
      $pageint="forms/consulter/professeurs.php";
}
else {
      $titre="Professeurs >> Ajout" ;
	 
         $pageint="forms/save/professeurs.php";
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
