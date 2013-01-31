<?php

      /* $date = $values['Datedebut'];
                    $date=implode('-',array_reverse (explode('/',$date)));
                    $values['Datedebut'] = $date." 0000:00:00";

<script>
    $(function() {
        $( "#birthdate_farmer" ).datepicker();
    });
</script>*/
//require("all_function.php");

$sqlstmcl="select distinct cycle  from categories";
$reqcl=mysql_query($sqlstmcl);
$sqlstm="select count(*)nb from categories where cycle ='SECONDAIRE'";
$req=mysql_query($sqlstm);
$ligne=mysql_fetch_array($req);
$n=$ligne['nb'];

$sqlstmp="select count(*)nb from categories where cycle ='PROFESSIONNEL'";
$reqp=mysql_query($sqlstmp);
$lignep=mysql_fetch_array($reqp);
$np=$lignep['nb'];

$sqlstm4clc0="select count(*) de from categories where cycle !='PRESCOLAIRE' and  cycle !='ELEMENTAIRE'";
$req4clc0=mysql_query($sqlstm4clc0);
$ligne4clc0=mysql_fetch_array($req4clc0);
$li=$ligne4clc0['de'];

$sqlstm4="select count(*) de from categories where cycle !='PRESCOLAIRE'";
$req4=mysql_query($sqlstm4);
$ligne4=mysql_fetch_array($req4);
$ma=$ligne4['de'];
$sqlstm4e="select count(*) de from categories where cycle ='ELEMENTAIRE'";
$req4e=mysql_query($sqlstm4e);
$ligne4e=mysql_fetch_array($req4e);
$ele=$ligne4e['de'];

$requete=("select status from etablissements ");
$resultat=mysql_query($requete);
$lignes=mysql_fetch_array($resultat);
$status=$lignes['status'];
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

    <img src='menu/images/configgen.jpg' ONCLICK='controle=1;mnh("h",450,"m")'>
	<ul id="nav" class="dropdown dropdown-vertical">
	<li>	<a href="parametrage/config.php" class="smenu">Paramétrages</a></li>
		<li>	<a href="sauver.php" class="smenu">Sauvegarde BD</a></li>
		<?php
echo'
<li><span class="dir">gestion des Cycles </span>
<ul>';
echo'
<li><a href="profiles.php" class="smenu">Ges Profiles</a></li>';
if($n<> 0)	{
echo'<li><a href="serie.php" class="smenu">Ges Série</a></li>';
}
if($np<> 0)	{
echo'<li><a href="filieres.php" class="smenu">Ges Des Filiéres</a></li>';
}
echo'
<li><a href="etudes.php" class="smenu">Ges Niveau Etude</a></li>
<li><a href="classes.php" class="smenu">Ges Classes</a></li>
';
	
if($ma<> 0)	{
echo'
<li><a href="disciplines.php" class="smenu">Ges Disciplines</a></li>
<li><a href="credit_horaire.php" class="smenu">Ges Crédit Horaire</a></li>
<li><a href="coefs.php" class="smenu">Ges Coéficients</a></li>
<li><a href="programmesd.php" class="smenu">Ges Programmes</a></li>

';}

?>
</ul>
</li>
				
<li><a href="salles.php" class="smenu">Ges Salle de Cours</a></li>	
<li><span class="dir">Le Personnel</span>
<ul>
<li><a href="corps.php" class="smenu">Ges des Corps</a></li>
<li><a href="echelons.php" class="smenu">Ges des Echelons</a></li>
<li><a href="grades.php" class="smenu">Ges des Grades</a></li>
<li><a href="personnels.php" class="smenu">Ges Personnel</a></li>
</ul></li>
<?php
//}
if($li<> 0)	{
?>
<li><span class="dir">Ges Bulletin Notes</span>
<ul>
<li><a href="appreciations.php" class="smenu">Ges des Appréciations</a></li>
<li><a href="honneurs.php" class="smenu">Ges des Honneurs</a></li>
<li><a href="remarques.php" class="smenu">Ges Remarques</a></li>
<li><a href="decision.php" class="smenu">Décision Conseil</a></li>
</ul></li>
<?php
}
?>
<li><span class="dir">Configuration Annuélle</span>
<ul>

<?php
if($li<> 0)	{
?>
<li><a href="semestres.php" class="smenu">Ges Semestres</a></li>
<li><a href="surveillants.php" class="smenu">Ges Surveillants</a></li>
<li><a href="professeurs.php" class="smenu">Ges Professeurs</a></li>
<?php
}

if($ele<> 0)	{
?>
<!--<li><a href="semestres.php" class="smenu">Ges Trimestres</a></li>!-->
<li><a href="enseignants.php" class="smenu">Ges Enseignants</a></li>

<?php
}
?>
</li>
</ul>

</ul>
<div id='h' class="element6" style='position:absolute;top:50px;left:0;width:200px; height:200px;'>


</div>
</div>
 </FIELDSET>
</body>
 