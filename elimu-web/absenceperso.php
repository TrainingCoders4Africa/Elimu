<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Absence Personnel >> Suppression" ;
  $pageint="forms/delete/absenceperso.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Absence Personnel >> Modification" ;
   $pageint="forms/update/absenceperso.php";
}
elseif(isset($_GET["ajout"])) {
      $titre="  Absence Personnel >> Ajout" ;
         $pageint="forms/save/absenceperso.php";
}

else {$titre="  Absence Personnel >> Consultation" ;
	 
      $pageint="forms/consulter/absenceperso.php";
}
$p="";
$uno=1;
$dos=1;
$trois=1;
$quatre=1;
$cinq=0;
$six=0;
require_once 'include.php';
?>
