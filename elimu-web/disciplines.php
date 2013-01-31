<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
		$titre="  Disciplines >> Suppression" ;
		$pageint="forms/delete/disciplines.php";
}/**/
elseif(isset($_GET["mod"])) {
		$titre="Disciplines >> Modification" ;
		$pageint="forms/update/disciplines.php";
}
elseif(isset($_GET["ajout"])) {
		$titre="Disciplines >> Ajout" ;
		$pageint="forms/save/disciplines.php";
}
else {
    
	   $titre=" Disciplines   >> Consultation" ;
       $pageint="forms/consulter/disciplines.php";
		}

$p="";
$uno=1;
$dos=1;
$trois=1;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
