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
$titre=" Niveau d'Etude   >> Consultation" ;
      $pageint="forms/consulter/etudes.php";
}
else {
      $titre="Niveau d'Etude >> Ajout" ;
	 
         $pageint="forms/save/etudes.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter des niveaux Etude";$titrevis="Lister les niveau Etude ";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
