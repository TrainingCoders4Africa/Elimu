<?php
session_start();
if(isset($_SESSION["login1"])){
$rechtab="Emploi du Temps";

@$menu=$_SESSION["menu"];
include 'all_function.php';
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Emploi du Temps de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/emplois_classes.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Emploi du Temps de la ".$classe." >> Modification" ;
   $pageint="forms/update/emplois_classes.php";
}
elseif(isset($_GET["rech"])) {
   $titre="Emploi du Temps de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
}
elseif(isset($_GET["vis"])) {     

$titre=" Emploi du Temps de la ".$classe."  >> Consultation" ;
      $pageint="forms/consulter/emplois_classes.php";
}
else {
$titre="Emploi du Temps de la ".$classe.">> Ajout" ;	 
         $pageint="forms/save/emplois_classes.php";

		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter un emploi du temps";$titrevis="lister l'emplois du temps de la classe suivant le semestre";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
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
