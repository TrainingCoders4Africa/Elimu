<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Classes >> Suppression" ;
  $pageint="forms/delete/classes.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Classes >> Modification" ;
   $pageint="forms/update/classes.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Classes   >> Consultation" ;
      $pageint="forms/consulter/classes.php";
}
else {
      $titre="Classes >> Ajout" ;
	 
         $pageint="forms/save/classes.php";
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
