<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Disciplines >> Suppression" ;
  $pageint="forms/delete/sousmatiere.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Disciplines - Sous Discipline >> Modification" ;
   $pageint="forms/update/sousmatiere.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Disciplines - Sous Discipline  >> Consultation" ;
      $pageint="forms/consulter/sousmatiere.php";
}
else {
      $titre="Disciplines - Sous Discipline>> Ajout" ;
	 
         $pageint="forms/save/sousmatiere.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=0;//bouton visualiser les donn�es
$bajout=0;//bunton insert into database 
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
