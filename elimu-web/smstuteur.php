<?php
session_start();
@$menu=$_SESSION["menu"];
include 'all_function.php';
$code=$_GET['classe'];
$eleve=$_GET['eleve'];
//libelle de la classe
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
//prenom et mon de l'éléve
$t_eleve = findByValue('eleves','matricule',$eleve);
						$ch_eleve = mysql_fetch_row($t_eleve);
						$prenom=$ch_eleve[1];
						$nom=$ch_eleve[2];
$titre="  Envoyer un Sms au  tuteurs de ".$prenom." ".$nom." de la ".$classe ;
$pageint="forms/smstuteur.php";
$p="";
$uno=0;
$dos=0;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
include 'include.php';
?>
