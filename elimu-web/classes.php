<?php
session_start();
if(isset($_SESSION["login1"])){
@$menu=$_SESSION["menu"];
if (isset($_GET["sup"])) {
  $titre="  Classes >> Suppression" ;
  $pageint="forms/delete/classes.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Classes >> Modification" ;
   $pageint="forms/update/classes.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Classes   >> Consultation" ;
      $pageint="forms/consulter/classes.php";
}
else {
      $titre="Classes >> Ajout" ;
	 
         $pageint="forms/save/classes.php";
		}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Classe";$titrevis="Lister les classes";$titrerech="";$titresup="";$titremod="";$titreimp="";
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
