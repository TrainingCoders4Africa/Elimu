<?php
session_start();
$rechtab="eleves";
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
$eleve=$_GET['matricule'];
      $titre=" El�ve ".$eleve." >> Liste des Notes" ;	 
         $pageint="forms/el_notes.php";
	

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
