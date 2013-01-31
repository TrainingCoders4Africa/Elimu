<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Honneurs >> Suppression" ;
  $pageint="forms/delete/honneurs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Honneurs >> Modification" ;
   $pageint="forms/update/honneurs.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Honneurs >> Ajout" ;
         $pageint="forms/save/honneurs.php";
}

else {$titre=" Grille des Honneurs >> Consultation" ;
	 
      $pageint="forms/consulter/honneurs.php";
}
$p="";
$uno=1;
$dos=1;
$trois=1;
$quatre=1;
$cinq=0;
$six=0;
require_once 'include.php';
?>
