<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
		$titre="  Disciplines >> Suppression" ;
		$pageint="forms/delete/disciplines.php";
}/**/
elseif(isset($_GET["mod"])) {
		$titre="Disciplines >> Modification" ;
		$pageint="forms/update/disciplines.php";
}
elseif(isset($_GET["ajout"])) {
		$titre="Disciplines >> Ajout" ;
		$pageint="forms/save/disciplines.php";
}
else {
    
	   $titre=" Disciplines   >> Consultation" ;
       $pageint="forms/consulter/disciplines.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter les disciplines";$titrevis="Consulter les disciplines ";$titrerech="";$titresup="";$titremod="Modier les disciplines";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
