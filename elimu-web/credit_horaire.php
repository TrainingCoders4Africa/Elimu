<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
		$profile=$_SESSION["profil"];
				
if (isset($_GET["sup"])) {
  $titre="  Credit_Horaire >> Suppression" ;
  $pageint="forms/delete/credit_horaire.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="Credit_Horaire >> Modification" ;
   $pageint="forms/update/credit_horaire.php";
}
elseif(isset($_GET["vis"])) {
$titre=" Credit_Horaire   >> Consultation" ;
      $pageint="forms/consulter/credit_horaire.php";
}
else {
      $titre="Credit_Horaire >> Ajout" ;
	 
         $pageint="forms/save/credit_horaire.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter crédit horaire";$titrevis="Visualiser les disciplines et les crédits horaires";$titrerech="";$titresup="";$titremod="Modifier les crédit horaires";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 

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
