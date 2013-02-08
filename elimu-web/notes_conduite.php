<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="notes_conduite";
$menu=$_SESSION["menu"];

include 'all_function.php';
$code=$_GET['num'];
$classe=libclasse($code);
if (isset($_GET["sup"])) {
  $titre="  Le Cahier d'Absence de la  ".$classe." >> Suppression" ;
  $pageint="forms/delete/notes_conduite.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Modification" ;
   $pageint="forms/update/notes_conduite.php";
}
elseif(isset($_GET["rech"])) {
   $titre=" Le Cahier d'Absence de la  ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {
$titre="  Notes de Conduite pour le Semestre en cours pour la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/notes_conduite.php";
}
else {
      $titre="Notes de Conduite  pour la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/notes_conduite.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter Notes conduite pour les Eleves de la classe";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
