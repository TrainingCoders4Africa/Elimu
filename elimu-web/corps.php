<?php
session_start();
@$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" Série >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Gestion des Corps >> Modification" ;
   $pageint="forms/update/corps.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Corps >> Consultation" ;
         $pageint="forms/consulter/corps.php";
}

else {$titre="Gestion des Corps >> Ajout" ;
	 $pageint="forms/save/corps.php";
      
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
