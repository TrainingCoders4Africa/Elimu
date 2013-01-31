<?php   session_start();
include"all_function.php";
$login=securite_bdd($_POST['Login1']);// récupération du login
$pwd=securite_bdd($_POST['Mot_de_Passe7']);//récupération du mot de passe
$profil=securite_bdd($_POST['Statut5']);// récupération du profil
$pas="";$matricule="";
$aca=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$d=substr($datejour,0,7);
if(@$_POST["Statut5"]=="Administrateur"){
$rsl=verif_connexion("administrateurs","connex_reussie.php");
$etr=explode("/",$rsl);
	if ($etr[0]=="error") {
 header("location: accueil.php?idr=fff");
	}
	else {
	$row=explode(";",$etr[1]);
	$_SESSION["login1"]=$row[1];
	$_SESSION["menu"]="menu.php";
	$_SESSION["profil"]=$profil;
	header("location: connex_reussie.php");
	}
}
elseif(@$_POST["Statut5"]<>"Administrateur"){
//récupération des infos des users autre que l'administrateur
$info_perso=user_connect($_POST['Login1'],$_POST['Statut5']);
$perso= explode("*", $info_perso);
$pas=$perso[0];
$matricule= $perso[1];
if($pas==$pwd){
$use_con=user_miseinfo($matricule,$_POST['Statut5']);
$use= explode("/", $use_con);
$ladate=$use[0];
$nbre=$use[1];
$_SESSION["matricule"]=$matricule;
	$_SESSION["login1"]=$login;
	$_SESSION["profil"]=$profil;
	if($nbre==0 or $datejour >= $ladate) {
header("location: perso.php");
}
else{
header("location: connex_reussie.php");
	}
if (($profil=='CENSEUR') or($profil=='PRINCIPAL'))
{	
	$_SESSION["menu"]="menu0.php";	
}
elseif ($profil=='PROFESSEUR')
	{
		$_SESSION["menu"]="menu2.php";
	}
	elseif ($profil=='SURVEILLANT')
	{
		$_SESSION["menu"]="menu1.php";
	}
	elseif ($profil=='ENSEIGNANT') 
	{
		$_SESSION["menu"]="menu3.php";
	}elseif ($profil=='COMPTABLE')
	{
		$_SESSION["menu"]="menu4.php";
	}
	else
	{
header("location: accueil.php?idr=fff");	
	/*echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';*/
}
}
else
	{
header("location: accueil.php?idr=fff");	
	/*echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php?idr=fff"
</SCRIPT>';*/
}
}
else
	{	
	/*echo'<SCRIPT LANGUAGE="JavaScript">
location.href="index.php"
</SCRIPT>';*/
header("location: index.php");
}
?>
