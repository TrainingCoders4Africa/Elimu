<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
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
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Absence personnel";$titrevis="Consulter la liste des absences  du personnel ";$titrerech="";$titresup="Supprimer absences personnel";$titremod="Update absence personnel";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=1;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
