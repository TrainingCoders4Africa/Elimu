<?php
session_start();
$rechtab="retards_eleves";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
include 'all_function.php';
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Le Cahier de Retards de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/retards_eleves.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le Cahier de Retards de la  ".$classe." >> Modification" ;
   $pageint="forms/update/retards_eleves.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le Cahier de Retards de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Le Cahier de Retards de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/retards_eleves.php";
}
else {
      $titre=" Le Cahier de Retards de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/retards_eleves.php";
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
