<?php
session_start();
include 'all_function.php';
$rechtab="eleves";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Liste des Eléves de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/eleves.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="  Liste des Eléves de la ".$classe." >> Modification" ;
   $pageint="forms/update/eleves.php";
}
elseif(isset($_GET["rech"])) {
   $titre="  Recherche des Eléves de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["ajout"])) {
  $titre="  Inscription des Eléves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/eleves.php";
}
else {
    $titre="  Liste des Eléves de la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/eleves.php";
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
