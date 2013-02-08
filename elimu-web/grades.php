<?php
session_start();
if(isset($_SESSION['matricule'])){
$menu=$_SESSION["menu"];
/*if (isset($_GET["vis"])) {
  $titre=" Série >> Consultation" ;
  $pageint="consulter/serie.php";
}*/
if(isset($_GET["mod"])) {
   $titre=" Gestion des Grades >> Modification" ;
   $pageint="forms/update/grades.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Grades >> Consultation" ;
         $pageint="forms/consulter/grades.php";
}

else {$titre="Gestion des Grades >> Ajout" ;
	 $pageint="forms/save/grades.php";
      
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter grade du personnel";$titrevis="consulter la liste des grades du personnel";$titrerech="";$titresup="";$titremod="Modifier le libellé ";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
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
