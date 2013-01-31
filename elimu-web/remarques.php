<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Remarques >> Suppression" ;
  $pageint="forms/delete/remarques.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Remarques >> Modification" ;
   $pageint="forms/update/remarques.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Remarques >> Ajout" ;
         $pageint="forms/save/remarques.php";
}

else {$titre=" Grille des Remarques >> Consultation" ;
	 
      $pageint="forms/consulter/remarques.php";
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
