<?php
session_start();
if(isset($_SESSION['matricule'])){
$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Grille des Honneurs >> Suppression" ;
  $pageint="forms/delete/honneurs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Grille des Honneurs >> Modification" ;
   $pageint="forms/update/honneurs.php";
}
elseif(isset($_GET["ajout"])) {
      $titre=" Grille des Honneurs >> Ajout" ;
         $pageint="forms/save/honneurs.php";
}

else {$titre=" Grille des Honneurs >> Consultation" ;
	 
      $pageint="forms/consulter/honneurs.php";
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter grille des honneurs";$titrevis="lister la grille des honneurs";$titrerech="";$titresup="Supprimer Grille Honneur";$titremod="Modifier grille Honneur";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=1;// bouton update donn�es
$bsup=1;//bouton delete donn�es
$brech=0;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es
require_once 'include.php';
}
//redirection en cas de vol
else{
header("location: index.php");
}
?>
