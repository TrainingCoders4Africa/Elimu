<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];
include 'all_function.php';
$code=$_GET['num'];
$classe=libclasse($code);
if (isset($_GET["sup"])) {
  $titre="  D�lib�ration des Notes de la ".$classe."  >> Suppression" ;
  $pageint="forms/delete/coefs.php";
}/**/
elseif(isset($_GET["mod"])) {
   $titre="D�lib�ration des Notes de la ".$classe." >> Modification" ;
   $pageint="forms/update/deliberation.php";
}
elseif(isset($_GET["vis"])) {
$titre=" D�lib�ration des Notes de la ".$classe."   >> Consultation" ;
      $pageint="forms/consulter/deliberation.php";
}
else {
      $titre="D�lib�ration des Notes de la ".$classe." >> Ajout" ;
	 
         $pageint="forms/save/deliberation.php";
		}

//les infos bulle des boutons du formulaire
$titreaj="Ajouter une d�lib�ration";$titrevis="";$titrerech="";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=0;//bouton visualiser les donn�es
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
