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
  $titre="  Liste des El�ves de la ".$classe." >> Suppression" ;
  $pageint="forms/delete/eleves.php";
  
}/**/
elseif(isset($_GET["mod"])) {
   $titre="  Liste des El�ves de la ".$classe." >> Modification" ;
   $pageint="forms/update/eleves.php";
   
}
elseif(isset($_GET["rech"])) {
   $titre="  Recherche des El�ves de la ".$classe." >> Recherche" ;
    $pageint="metier/recherche.php";
		  
}
elseif(isset($_GET["ajout"])) {
  $titre="  Inscription des El�ves de la ".$classe." >> Ajout" ;	 
         $pageint="forms/save/eleves.php";

			 
}
else {
    $titre="  Liste des El�ves de la ".$classe." >> Consultation" ;
      $pageint="forms/consulter/eleves.php";
	
		}
		 	  $titreaj="Ajouter des �l�ves ";
			    $titrevis="la liste des �leves de la classe";
				$titrerech="Recherche un El�ve suivant Matricule";$titresup="";$titremod="";$titreimp="";
	//les infos bulle des boutons du formulaire
$titreaj="Ajouter Eleves";$titrevis="Lister les Eleves de la classe";$titrerech="REchercher Eleve suivant le matricule";$titresup="";$titremod="";$titreimp="";
//les boutons visibles sont a 1 et ceux de 0 sont masqu�s
$bvis=1;//bouton visualiser les donn�es
$bajout=1;//bunton insert into database 
$bmod=0;// bouton update donn�es
$bsup=0;//bouton delete donn�es
$brech=1;//bouton recherhe donn�es
$bimp=0;// bouton imprimer des donn�es			

require_once 'include.php';
}
//redirection en cas de fraude
else{
header("location: index.php");
}
?>
