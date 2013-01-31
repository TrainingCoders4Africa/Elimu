<?php
session_start();
$rechtab="notes_appeciation";
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
  $titre="  Appréciation professeur pour les Eléves de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_appeciation.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Appréciation professeur pour les Eléves de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_appeciation.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Appréciation professeur pour les Eléves de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Appréciation professeur pour les Eléves de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_appeciation.php";
}
else {
      $titre=" Appréciation professeur pour les Eléves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/notes_appeciation.php";
		}

$p="";
$uno=0;
$dos=1;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
