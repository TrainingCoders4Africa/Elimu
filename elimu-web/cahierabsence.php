<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="cahierabsence";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
include 'all_function.php';
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Le Cahier d'Absence de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/cahierabsence.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Modification" ;
   $pageint="forms/update/cahierabsence.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Le Cahier d'Absence de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/cahierabsence.php";
}
else {
      $titre=" Le Cahier d'Absence de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/cahierabsence.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter absence élève ";$titrevis="lister les absents";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
else{
header("location: index.php");
}
?>
