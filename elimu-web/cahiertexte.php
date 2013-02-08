<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="cahiertexte";
@$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$classe=$_SESSION["classe"];
if (isset($_GET["sup"])) {
  $titre="  Le cahier de Texte de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/cahiertexte.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le cahier de Texte de la  ".$classe." >> Modification" ;
   $pageint="forms/update/cahiertexte.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le cahier de Texte de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Le cahier de texte de la  ".$classe." >> Consultation" ;
      $pageint="forms/consulter/cahiertexte.php";
}
else {
      $titre=" Le cahier de Texte de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/cahiertexte.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter un cours";$titrevis="visualiser les cours deja fait par le prof";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
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
