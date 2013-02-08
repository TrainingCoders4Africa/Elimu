<?php
session_start();
if(isset($_SESSION["login1"])){
include 'all_function.php';
$rechtab="eleves";
$menu=$_SESSION["menu"];
$_SESSION["classe"]=$_GET['num'];
$code=$_SESSION["classe"];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if (isset($_GET["sup"])) {
  $titre="  Liste des Eléves de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/eleves.php";
  
}/**/
elseif(isset($_GET["mod"])) {
   $titre="  Liste des Eléves de la ".$classe." >> Modification" ;
   $pageint="forms/update/eleves.php";
   
}
elseif(isset($_GET["rech"])) {
   $titre="  Recherche des Eléves de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
		  
}
elseif(isset($_GET["ajout"])) {
  $titre="  Inscription des Eléves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/eleves.php";

			 
}
else {
    $titre="  Liste des Eléves de la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/eleves.php";
	
		}
		 	  $titreaj="Ajouter des éléves ";
			    $titrevis="la liste des éleves de la classe";
				$titrerech="Recherche un Eléve suivant Matricule";$titresup="";$titremod="";$titreimp="";
	//les infos bulle des boutons du formulaire
$titreaj="Ajouter Eleves";$titrevis="Lister les Eleves de la classe";$titrerech="REchercher Eleve suivant le matricule";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqués
$bvis=1;//bouton visualiser les données
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update données
$bsup=0;//bouton delete données
$brech=1;//bouton recherhe données
$bimp=0;// bouton imprimer des données			

require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
