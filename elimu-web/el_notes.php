<?php
session_start();
$rechtab="eleves";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
$eleve=$_GET['matricule'];
      $titre=" Elève ".$eleve." >> Liste des Notes" ;	 
         $pageint="forms/el_notes.php";
	

$p="";
$uno=0;
$dos=0;
$trois=0;
$quatre=0;
$cinq=0;
$six=0;
require_once 'include.php';
?>
