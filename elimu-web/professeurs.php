<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="enseignant";
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Professeurs >> Suppression" ;
  $pageint="forms/delete/professeurs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Professeurs >> Modification" ;
   $pageint="forms/update/professeurs.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Professeurs >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Professeurs   >> Consultation" ;
      $pageint="forms/consulter/professeurs.php";
}
else {
      $titre="Professeurs >> Ajout" ;
	 
         $pageint="forms/save/professeurs.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter dispatching des cours";$titrevis="consulter le dispatching des cours";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
