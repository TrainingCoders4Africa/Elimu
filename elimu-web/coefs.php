<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
$profile=$_SESSION["profil"];
if (isset($_GET["sup"])) {
  $titre="  coéffcients des Disciplines  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="coéffcients des Disciplines  >> Modification" ;
   $pageint="forms/update/coefs.php";
}
elseif(isset($_GET["vis"])) {
$titre=" coéffcients des Disciplines    >> Consultation" ;
      $pageint="forms/consulter/coefs.php";
}
else {
      $titre="coéffcients des Disciplines >> Ajout" ;
	 
         $pageint="forms/save/coefs.php";
		}

		//les infos bulle des boutons du formulaire
$titreaj="Ajouter coéfficients des disciplines";$titrevis="Consulter la liste des coefficients";$titrerech="";$titresup="";$titremod="Modifier les coéfficients";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 


$p="";
$bvis=1;
$bajout=1;
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
