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
  $titre="  Appréciation professeur pour les Eléves de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_appeciation.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Appréciation professeur pour les Eléves de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_appeciation.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Appréciation professeur pour les Eléves de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Appréciation professeur pour les Eléves de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_appeciation.php";
}
else {
      $titre=" Appréciation professeur pour les Eléves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/notes_appeciation.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter Appréciation par le professeur pour les éléves d'une classe";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=0;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
