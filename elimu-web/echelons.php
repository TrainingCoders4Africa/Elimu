<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" S�rie >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Gestion des Echelons >> Modification" ;
   $pageint="forms/update/echelons.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Echelons >> Consultation" ;
         $pageint="forms/consulter/echelons.php";
}

else {$titre="Gestion des Echelons >> Ajout" ;
	 $pageint="forms/save/echelons.php";
      
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Echelon Personnel";$titrevis="Lister les Echelons du personnel";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
