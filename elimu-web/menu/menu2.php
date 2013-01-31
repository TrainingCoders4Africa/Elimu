<?php
//require("all_function.php");
$matricule=$_SESSION["matricule"];
$profile=$_SESSION["profil"];

$requete=("select status from etablissements ");
$resultat=mysql_query($requete);
$lignes=mysql_fetch_array($resultat);
$status=$lignes['status'];
$datejour=date("Y")."-".date("m")."-".date("d");
$mois=date("m");
$annee=date("Y");
$aca=annee_academique();
//vérifier sil ya une note de conduite
$conduite=("select count(*) nb from conduite ");
$resultatc=mysql_query($conduite);
$lignec=mysql_fetch_array($resultatc);
$nd=$lignec['nb'];
//vérifier sil ya une classe dans le menu de ce professeur

//liste des classes si profile=surveillant
//if($profile=="SURVEILLANT"){
//délibération second semestre
$sqlstmd="select count(*) nb from moyennes where annee='$aca' and semestre='S2' and moyennes.eleve in(select eleve from inscription where classe in(select classe  from surveiller where personnel='$matricule' and annee='$aca') and annee='$aca')";
$reqd=mysql_query($sqlstmd);
$ligned=mysql_fetch_array($reqd);
$nb=$ligned['nb'];
$sqlstmcl="select distinct classe  from enseigner where personnel='$matricule' and annee='$aca' order by classe";
$reqcl=mysql_query($sqlstmcl);

?>
<head>
<meta name="author" content="Tom@Lwis (http://www.lwis.net/free-css-drop-down-menu/)" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<!--<link href="css/dropdown/themes/default/helper.css" media="screen" rel="stylesheet" type="text/css" />!-->

<link href="css/dropdown/dropdown.vertical.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/default/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

<SCRIPT language="javascript">
   function ouvre_popup(page) {
       window.open(page,"LECTEUR","menubar=no, status=no, scrollbars=no, menubar=no, width=1300, height=900");
   }
   function ouvre_popupv(page) {
       window.open(page,"LECTEUR","menubar=no, status=no, scrollbars=no, menubar=no, width=400, height=400");
   }
</SCRIPT>
<style type="text/css">
.Style1 {
background-color: white;
}
.element {
background-color: white;
}
.element2 {
background-color: white;
}
.element3 {
background-color: white;
}
.element4 {
	font-family: Century Gothic,Verdana,Arial,Helvetica,sans-serif;
background-color: white;
font-size: 14px;
}
.element5 {
	font-family: Century Gothic,Verdana,Arial,Helvetica,sans-serif;
background-color: white;
font-size: 14px;
}
{
	background-color: white;
	padding: 0px 0px 0px 0px;
	margin:0px;
	border-top: 0px solid #d700a6;
	border-left: px solid #d700a6;
	border-right: px solid #d700a6;
	border-bottom: px solid #d700a6;
	font-size: 13px;
	font-family: Century Gothic,Verdana,Arial,Helvetica,sans-serif;
	font-weight: normal;
	color: white;
}
.smenu{
    padding-left:15px;
	font-family:Century Gothic;font-size:14;color:BLACK;text-decoration: none;font-weight:700;


}
A:hover {color:#F7235A;}
.menu{
    padding-left:20px;
    font-size: 14px;
    font-weight:700;
    color:blue;
}
.menu1{
    padding-left:50px;
    font-size: 13px;
    font-weight:700;
	}
}
</style>

<script TYPE="text/javascript">
var mnhv=1;
var retour='';
function mnh(vl,pb,dg){
	if(controle==1){
	controle=0;
	bl=vl;
	pl=pb;
	gd=dg;
	}
	var Table_haut=document.getElementById(bl);
	var divgener=document.getElementById(gd);
		if(mnhv==0){
			var Table_retour=document.getElementById(retour);
			Table_retour.style.top=Table_retour.offsetTop-15+'px';
			document.getElementById(retour2).style.height=document.getElementById(retour2).offsetHeight-15+'px';
				if(Table_retour.offsetTop<=50){
				mnhv=1;
				if(retour==bl){
				return false;
				}
				}
		}
		if(mnhv==1){

		Table_haut.style.top=Table_haut.offsetTop+15+'px';
		divgener.style.height=divgener.offsetHeight+15+'px';
		if(Table_haut.offsetTop>=pb){
		mnhv=0;
		retour=bl;
		retour2=gd;
		return false;
		}
		}
		setTimeout("mnh(bl,pl,gd)",16);
}
</SCRIPT>

</head>
<body bgcolor='white'>

<div id='m' style='overflow:hidden;position:relative;top:0px; left:0px; width:350px; height:40px; z-Index:0'>

    <img src='menu/images/prof.jpg' ONCLICK='controle=1;mnh("h",800,"m")'>
	<ul id="nav" class="dropdown dropdown-vertical">
	<li>	<a href="emploisprof.php" class="smenu">EMPLOI DU TEMPS</a></li>
	<li>	<a href="evaluationprof.php" class="smenu">CALENDRIER EVALUATION</a></li>
		<?php
			while($lignecl=mysql_fetch_array($reqcl))
{
$code=$lignecl['classe'];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
if($nd<>0){
$conduitecc=("select count(*) nbo from classes where idclasse='".$code."' and etude in(select idetude from etudes where cycle='MOYEN')");
$resultatcc=mysql_query($conduitecc);
$lignecc=mysql_fetch_array($resultatcc);
$nc=$lignecc['nbo'];


echo'
<li><span class="dir">gestion de la '.$classe.' </span>
<ul>';
$_SESSION["classe"]=$code;
echo'
<li><a href="cahiertexte.php?num='.$code.'" class="smenu">CAHIER DE TEXTE</a></li>
<li><a href="cahierabsence.php?num='.$code.'" class="smenu">CAHIER D\'ABSENCE</a></li>
<li><a href="notes_evaluation.php?num='.$code.'" class="smenu">NOTES EVALUATIONS</a></li>
<li><a href="modif_notes.php?num='.$code.'" class="smenu">NOTES ELEVES</a></li>
<li><a href="notes_eleveabsent.php?num='.$code.'" class="smenu">NOTES ABSENCES JUSTIFIEES</a></li>
<li><a href="notes_appeciation.php?num='.$code.'" class="smenu">APPRECIATION PROF</a></li>';
if($nc<>0)
echo'<li><a href="notes_conduite.php?num='.$code.'" class="smenu">NOTES CONDUITE </a></li>';
echo'
</ul>
</li>';
}
	}
?>
</ul>
<div id='h' class="element6" style='position:absolute;top:50px;left:0;width:200px; height:200px;'>


</div>
</div>
 </FIELDSET>
</body>
 