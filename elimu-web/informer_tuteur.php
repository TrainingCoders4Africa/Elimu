<?php
session_start();
if(isset($_SESSION['matricule'])){
$menu=$_SESSION["menu"];
include 'all_function.php';
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
$titre="  Informer les tuteurs de la ".$classe ;
$pageint="forms/informer_tuteur.php";
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
