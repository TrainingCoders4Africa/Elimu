<?php
session_start();
@$menu=$_SESSION["menu"];
		$profile=$_SESSION["profil"];
				
if (isset($_GET["sup"])) {
  $titre="  Credit_Horaire >> Suppression" ;
  $pageint="forms/delete/credit_horaire.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Credit_Horaire >> Modification" ;
   $pageint="forms/update/credit_horaire.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Credit_Horaire   >> Consultation" ;
      $pageint="forms/consulter/credit_horaire.php";
}
else {
      $titre="Credit_Horaire >> Ajout" ;
	 
         $pageint="forms/save/credit_horaire.php";
		}

$p="";
$uno=1;
$dos=1;
if($profile=="Administrateur")
$trois=1;
else
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
