<?php
session_start();
if(isset($_SESSION['matricule'])){
$menu=$_SESSION["menu"];
if(isset($_GET["mod"])) {
   $titre=" Filiéres >> Modification" ;
   $pageint="forms/update/filieres.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" Filiéres >> Ajout" ;
	/* $table="series";
//$titre="Saisie Agence";
$j="kct";
$sss="ajout";*/
     $pageint="forms/save/filieres.php";
}

else {
       $titre=" Filiéres >> Consultation" ;
         $pageint="forms/consulter/filieres.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter des filiéres";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
include 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
