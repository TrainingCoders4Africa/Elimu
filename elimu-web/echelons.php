<?php
session_start();
@$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" Série >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Gestion des Echelons >> Modification" ;
   $pageint="forms/update/echelons.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Echelons >> Consultation" ;
         $pageint="forms/consulter/echelons.php";
}

else {$titre="Gestion des Echelons >> Ajout" ;
	 $pageint="forms/save/echelons.php";
      
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
