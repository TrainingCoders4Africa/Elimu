<?php
session_start();
if(isset($_SESSION['matricule'])){
$menu=$_SESSION["menu"];
if(isset($_GET["mod"])) {
   $titre=" Fili�res >> Modification" ;
   $pageint="forms/update/filieres.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" Fili�res >> Ajout" ;
	/* $table="series";
//$titre="Saisie Agence";
$j="kct";
$sss="ajout";*/
     $pageint="forms/save/filieres.php";
}

else {
       $titre=" Fili�res >> Consultation" ;
         $pageint="forms/consulter/filieres.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter des fili�res";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
include 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
