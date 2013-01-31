<?php
session_start();
$rechtab="Emploi du Temps";

@$menu=$_SESSION["menu"];
include 'all_function.php';
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Emploi du Temps de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/emplois_classes.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Emploi du Temps de la ".$classe." >> Modification" ;
   $pageint="forms/update/emplois_classes.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Emploi du Temps de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {     

$titre=" Emploi du Temps de la ".$classe."  >> Consultation" ;
      $pageint="forms/consulter/emplois_classes.php";
}
else {
$titre="Emploi du Temps de la ".$classe.">> Ajout" ;	 
         $pageint="forms/save/emplois_classes.php";

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
