<?php
session_start();
@$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" Série >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Gestion des Grades >> Modification" ;
   $pageint="forms/update/grades.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Grades >> Consultation" ;
         $pageint="forms/consulter/grades.php";
}

else {$titre="Gestion des Grades >> Ajout" ;
	 $pageint="forms/save/grades.php";
      
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
