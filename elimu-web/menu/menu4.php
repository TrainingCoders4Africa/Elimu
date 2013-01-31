<head>
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
<?php
require("dao/connection.php");
$login1=$_SESSION["login1"];
$profile=$_SESSION["profil"];

$requete=("select status from etablissements ");
$resultat=mysql_query($requete);
$lignes=mysql_fetch_array($resultat);
$status=$lignes['status'];
$datejour=date("Y")."-".date("m")."-".date("d");
$mois=date("m");
$annee=date("Y");

 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
		//connaitre matricule de la personne connectée
$sqlstm="select cdeetud from user where login1='$login1' and profile5='$profile'";
$req=mysql_query($sqlstm);
$ligne=mysql_fetch_array($req);

$matricule=$ligne['cdeetud'];
//liste des classes si profile=surveillant
if($profile=="COMPTABLE"){


$sqlstmcl="select libelle  from classes  where classes.etude in ( select libelle from etudes where etudes.cycle in ( select cycle from fonction where personnel='$matricule' and profile='$profile'))";
$reqcl=mysql_query($sqlstmcl);
?>

<body bgcolor='white'>
<FIELDSET style="width: 200px;" >
<div id='m'class="element4" style='overflow:hidden;position:relative;top:0px; left:0px; width:200px; height:100px; z-Index:0'>

    <img src='menu/images/classes.jpg' ONCLICK='controle=1;mnh("e",500,"m")'><br/>
	<?php
	while($lignecl=mysql_fetch_array($reqcl))
{
$code=$lignecl['libelle'];
$etag1 = findByValue('classes','idclasse',$code);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
?>
		<a href="seleves.php?num=<?phpecho $code;?>& annee=<?php echo $aca;?>" class="smenu"><?php echo $classe;?></a><BR>
	<?php
}

}
?>
<?php
if($status=='PRIVE')	{
?>
	<div id='e'class="element4" style='position:absolute;top:50px;left:0;width:200px; height:200px;'>
<img src='menu/images/finance.jpg' ONCLICK='controle=1;mnh("f",180,"m")'>

<a href="situation.php" class="smenu">Situations </a><BR>
<a href="bilanj.php" class="smenu">Bilan Paiement Journalier</a><BR>
<a href="resultat.php" class="smenu">Bilan Paiement Mensuel</a><BR>
<a href="lidepenses.php" class="smenu">Dépenses Journaliéres</a><BR>
<?php
}
?>

<div id='f' class="element6" style='position:absolute;top:50px;left:0;width:200px; height:200px;'>
</div>
</div>
</div>
</div>
 </FIELDSET>
</body>
 <?php
 // }
?>