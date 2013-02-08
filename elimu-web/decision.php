<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille  Décision Conseil >> Suppression" ;
  $pageint="forms/delete/decision.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille Décision Conseil >> Modification" ;
   $pageint="forms/update/decision.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille Décision Conseil>> Ajout" ;
         $pageint="forms/save/decision.php";
}

else {$titre=" Grille Décision Conseil >> Consultation" ;
	 
      $pageint="forms/consulter/decision.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajout grille Décision Du conseil";$titrevis="consulter la grille des décision du conseil";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
