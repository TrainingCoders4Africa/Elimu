<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if(isset($_GET["mod"])) {
   $titre=" S�rie >> Modification" ;
   $pageint="forms/update/serie.php";
}
elseif(isset($_GET["ajout"])) {
     $titre=" S�rie >> Ajout" ;

     $pageint="forms/save/serie.php";
}

else {
       $titre=" S�rie >> Consultation" ;
         $pageint="forms/consulter/serie.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter S�rie pour le secondaire";$titrevis="Lister les S�ries";$titrerech="";$titresup="";$titremod=" Modifier Libell� S�rie";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
include 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
