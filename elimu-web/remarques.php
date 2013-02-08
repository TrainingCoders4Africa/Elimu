<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Remarques >> Suppression" ;
  $pageint="forms/delete/remarques.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Remarques >> Modification" ;
   $pageint="forms/update/remarques.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Remarques >> Ajout" ;
         $pageint="forms/save/remarques.php";
}

else {$titre=" Grille des Remarques >> Consultation" ;
	 
      $pageint="forms/consulter/remarques.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Grille des remarques";$titrevis="Consulter la grille des remarques";$titrerech="";
$titresup="supprimer une grille des remarques";$titremod="Modifier les bornes de la grille des remarque";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update données
$bsup=1;//bouton delete données
$brech=0;//bouton recherhe données
$bimp=0;// bouton imprimer des données
require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
