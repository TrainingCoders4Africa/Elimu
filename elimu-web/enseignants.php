<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="enseignant";
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Enseignants >> Suppression" ;
  $pageint="forms/delete/enseignants.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Enseignants >> Modification" ;
   $pageint="forms/update/enseignants.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Enseignants >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Enseignants   >> Consultation" ;
      $pageint="forms/consulter/enseignants.php";
}
else {
      $titre="Enseignants >> Ajout" ;
	 
         $pageint="forms/save/enseignants.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter Enseignants";$titrevis="Consulter la liste des Enseignants";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
