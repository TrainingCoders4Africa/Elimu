<?php
session_start();
if(isset($_SESSION['matricule'])){
$rechtab="notes_appeciation";
include 'all_function.php';
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Appr�ciation professeur pour les El�ves de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_appeciation.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Appr�ciation professeur pour les El�ves de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_appeciation.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Appr�ciation professeur pour les El�ves de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Appr�ciation professeur pour les El�ves de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_appeciation.php";
}
else {
      $titre=" Appr�ciation professeur pour les El�ves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/notes_appeciation.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter Appr�ciation par le professeur pour les �l�ves d'une classe";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=0;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
