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
$titreaj="Ajouter grille appr�ciation";$titrevis="Consulter la grille des appr�ciations";$titrerech="";$titresup="Supprimer une appr�ciations";
$titremod="modifier les bornes de la grille appr�ciation";
$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update donn�es
$bsup=1;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
else
header("location: index.php");
?>
