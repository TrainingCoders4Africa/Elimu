<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="personnels";
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Personnels >> Suppression" ;
  $pageint="forms/delete/personnels.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Personnels >> Modification" ;
   $pageint="forms/update/personnels.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Personnels >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Personnels   >> Consultation" ;
      $pageint="forms/consulter/personnels.php";
}
else {
      $titre="Personnels >> Ajout" ;
	 
         $pageint="forms/save/personnels.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter personnel";$titrevis="lister le personnel";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=1;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
