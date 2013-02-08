<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille  Décision Conseil >> Suppression" ;
  $pageint="forms/delete/decision.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille Décision Conseil >> Modification" ;
   $pageint="forms/update/decision.php";
}
elseif(isset($_GET["vis"])) {
$titre=' Liste des Profiles  >> Consultation' ;
      $pageint="forms/consulter/profiles.php";
}
else {
      $titre='Liste des Profiles >> Ajout' ;
	 
         $pageint="forms/save/profiles.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter profile du personnel";$titrevis="lister les profiles du personnel";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
