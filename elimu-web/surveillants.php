<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="surveiller";
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Surveillants >> Suppression" ;
  $pageint="forms/delete/surveillants.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Surveillants >> Modification" ;
   $pageint="forms/update/surveillants.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Surveillants >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Surveillants   >> Consultation" ;
      $pageint="forms/consulter/surveillants.php";
}
else {
      $titre="Surveillants >> Ajout" ;
	 
         $pageint="forms/save/surveillants.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter Surveillants";$titrevis=" Consulter la liste des surveillants";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
