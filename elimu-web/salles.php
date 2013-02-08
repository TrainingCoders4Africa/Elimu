<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
$profile=$_SESSION["profil"];
if(isset($_GET["mod"])) {
   $titre=" salles de Cours >> Modification" ;
   $pageint="forms/update/salles.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" salles de Cours >> Consultation" ;
         $pageint="forms/consulter/salles.php";
}

else {$titre=" salles de Cours >> Ajout" ;
	 $pageint="forms/save/salles.php";
      
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter de salles de cours";$titrevis=" visualiser l liste des salles de cours";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
//$bmod=0;


if($profile=="Administrateur")
$bmod=1;// bouton update données
else
$bmod=0;
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
