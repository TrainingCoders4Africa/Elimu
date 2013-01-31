<?php
session_start();
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Programme d'Evaluation  >> Suppression" ;
  $pageint="forms/delete/evaluationprof.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Programme d'Evaluation  >> Modification" ;
   $pageint="forms/update/evaluationprof.php";
}
elseif(isset($_GET["ajout"])) {
$titre="Programme d'Evaluation >> Ajout" ;	 
         $pageint="forms/save/evaluationprof.php";
}
else {
      $titre=" Programme d'Evaluation    >> Consultation" ;
      $pageint="forms/consulter/evaluationprof.php";
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
