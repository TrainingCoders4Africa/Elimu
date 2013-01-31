<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Appreciations >> Suppression" ;
  $pageint="forms/delete/appreciations.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Appreciations >> Modification" ;
   $pageint="forms/update/appreciations.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Appreciations >> Ajout" ;
         $pageint="forms/save/appreciations.php";
}

else {$titre=" Grille des Appreciations >> Consultation" ;
	 
      $pageint="forms/consulter/appreciations.php";
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
