<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
$profile=$_SESSION["profil"];
if (isset($_GET["sup"])) {
  $titre="  co�ffcients des Disciplines  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="co�ffcients des Disciplines  >> Modification" ;
   $pageint="forms/update/coefs.php";
}
elseif(isset($_GET["vis"])) {
$titre=" co�ffcients des Disciplines    >> Consultation" ;
      $pageint="forms/consulter/coefs.php";
}
else {
      $titre="co�ffcients des Disciplines >> Ajout" ;
	 
         $pageint="forms/save/coefs.php";
		}

		//les infos bulle des boutons du formulaire
$titreaj="Ajouter co�fficients des disciplines";$titrevis="Consulter la liste des coefficients";$titrerech="";$titresup="";$titremod="Modifier les co�fficients";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 


$p="";
$bvis=1;
$bajout=1;
if($profile=="Administrateur")
$bmod=1;// bouton update donn�es

else
$bmod=0;
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
