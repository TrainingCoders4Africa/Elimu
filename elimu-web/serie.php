<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if(isset($_GET["mod"])) {
   $titre=" Série >> Modification" ;
   $pageint="forms/update/serie.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" Série >> Ajout" ;

     $pageint="forms/save/serie.php";
}

else {
       $titre=" Série >> Consultation" ;
         $pageint="forms/consulter/serie.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Série pour le secondaire";$titrevis="Lister les Séries";$titrerech="";$titresup="";$titremod=" Modifier Libellé Série";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=0;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
include 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
