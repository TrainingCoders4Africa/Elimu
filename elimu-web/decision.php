<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille  Décision Conseil >> Suppression" ;
  $pageint="forms/delete/decision.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille Décision Conseil >> Modification" ;
   $pageint="forms/update/decision.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille Décision Conseil>> Ajout" ;
         $pageint="forms/save/decision.php";
}

else {$titre=" Grille Décision Conseil >> Consultation" ;
	 
      $pageint="forms/consulter/decision.php";
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
