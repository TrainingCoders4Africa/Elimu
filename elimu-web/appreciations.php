<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Appreciations >> Suppression" ;
  $pageint="forms/delete/appreciations.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Appreciations >> Modification" ;
   $pageint="forms/update/appreciations.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Appreciations >> Ajout" ;
         $pageint="forms/save/appreciations.php";
}

else {$titre=" Grille des Appreciations >> Consultation" ;
	 
      $pageint="forms/consulter/appreciations.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter grille appréciation";$titrevis="Consulter la grille des appréciations";$titrerech="";$titresup="Supprimer une appréciations";
$titremod="modifier les bornes de la grille appréciation";
$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=1;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
else
header("location: index.php");
?>
