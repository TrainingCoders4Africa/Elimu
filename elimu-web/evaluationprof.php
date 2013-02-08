<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
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

//les infos bulle des boutons du formulaire
$titreaj="Ajouter un planning Evaluation";$titrevis="consulter le planning  des evaluations du professeur";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
