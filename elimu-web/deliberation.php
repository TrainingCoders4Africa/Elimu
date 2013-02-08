<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
include 'all_function.php';
$code=$_GET['num'];
$classe=libclasse($code);
if (isset($_GET["sup"])) {
  $titre="  Délibération des Notes de la ".$classe."  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Délibération des Notes de la ".$classe." >> Modification" ;
   $pageint="forms/update/deliberation.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Délibération des Notes de la ".$classe."   >> Consultation" ;
      $pageint="forms/consulter/deliberation.php";
}
else {
      $titre="Délibération des Notes de la ".$classe." >> Ajout" ;
	 
         $pageint="forms/save/deliberation.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter une délibération";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=0;//bouton visualiser les données
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
