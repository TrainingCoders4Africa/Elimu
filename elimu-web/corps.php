<?php
session_start();
if(isset($_SESSION["login1"])){
$menu=$_SESSION["menu"];

if(isset($_GET["mod"])) {
   $titre=" Gestion des Corps >> Modification" ;
   $pageint="forms/update/corps.php";
}
elseif(isset($_GET["vis"])) {
      $titre=" Gestion des Corps >> Consultation" ;
         $pageint="forms/consulter/corps.php";
}

else {$titre="Gestion des Corps >> Ajout" ;
	 $pageint="forms/save/corps.php";
      
}
//les infos bulle des boutons du formulaire
$titreaj="Ajouter Corps Personnel ";$titrevis="la liste des corps du personnel";
				$titrerech="";$titresup="";$titremod="Modifier les corps du personnel";$titreimp="";
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
