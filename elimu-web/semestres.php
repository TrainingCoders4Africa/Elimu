<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Semestres >> Suppression" ;
  $pageint="forms/delete/semestres.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="semestres >> Modification" ;
   $pageint="forms/update/semestres.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Semestres   >> Consultation" ;
      $pageint="forms/consulter/semestres.php";
}
else {
      $titre="Semestres >> Ajout" ;
	 
         $pageint="forms/save/semestres.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter semestres";$titrevis="visualier le planning des semestre";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
