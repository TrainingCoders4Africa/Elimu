<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
//$_SESSION["classe"]=$_GET['num'];
$titre=" Empoi du temp Professeur  >> Semestre en Cours" ;
$pageint="forms/emploisprof.php";
//les infos bulle des boutons du formulaire
$titreaj="";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=0;//bouton visualiser les données
$bajout=0;//bunton insert into database 
$bmod=0;// bouton update données
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
