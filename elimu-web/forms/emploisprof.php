<?php
$matricule=$_SESSION['matricule'];
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1e="SELECT count(*) ns FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1e=mysql_query($sqlstm1e);
$lignee=mysql_fetch_array($req1e);
$ns=$lignee['ns'];

$sqlstm1="SELECT id,libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
	$code=$ligne['id'];
	$libelle=$ligne['libelle'];
	$debut=$ligne['debut'];
	$fin=$ligne['fin'];
	}
?>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<?php if($ns==0){
echo $datejour .' n\'est dans  aucun semestre donc impossible de faire un traitement  pour cette date';
}
 else{ 

  echo' <tr><td>  <table border="1" cellspacing="0"  cellpadding="2"  width=100% ALIGN=LEFT>
<TR><TD align=center colspan=1 NOWRAP><B>&nbsp;HORAIRE&nbsp;</B></TD>';

$sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

echo'<Td align=center colspan=1 NOWRAP ><FONT color="black" ><B>&nbsp;'. $libellec0.' &nbsp;</B></FONT></Td>';
}
echo'</tr><tr>';
$sqlstm1mel100="select distinct  debut, fin  from emploi_temps where classe in( select classe from enseigner where personnel='$matricule' and annee='$annee')and
 emploi_temps.discipline in( select discipline from enseigner where personnel='$matricule' and annee='$annee') and semestre='$code' and annee='$annee' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$debut=$ligne10u14mel100['debut'];
$fin=$ligne10u14mel100['fin'];

$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];
?>
<td align=center ROWSPAN=1 NOWRAP>&nbsp;<b><?php echo $d.' - '.$fi;?>&nbsp;</B></FONT></TD>
<?php
 $sqlstm1gaz100="select id from jours  order by id";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$jour=$ligne10u14gaz100['id'];

$sqlstm11000="select discipline,salle,classe  from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and classe in( select classe from enseigner where personnel='$matricule' and annee='$annee')and
 emploi_temps.discipline in( select discipline from enseigner where personnel='$matricule' and annee='$annee') and semestre='$code' and annee='$annee'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$dis=$ligne10u141000['discipline'];
$sal=$ligne10u141000['salle'];
$classe=$ligne10u141000['classe'];
 $naturee = findByValue('salles','id',$sal);
						$entitee = mysql_fetch_row($naturee);
						$salle=$entitee[1];
						$t_classe = findByValue('classes','idclasse',$classe);
						$champs_classe = mysql_fetch_row($t_classe);
						$l_classe=$champs_classe[3];
 $nature = findByValue('disciplines','iddis',$dis);
						$entite = mysql_fetch_row($nature);
						$discipline=$entite[1];

if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
}
else{
?>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >&nbsp;<b><?php echo $l_classe.'<br/>'.$discipline.'<br/>'.$salle;?></b>&nbsp;</TD>
<?php
}
}
echo"</tr>";
}
echo'</table>';
//}
?>


 <TR><TD class=petit>&nbsp;</TD></TR>
 	</tbody>

</TR>



<div>          
<a href="forms/imprimer/emprof.php?matricule=<?php echo $matricule;?>" target="_blank" class=imp>Aper&ccedil;u</a>
</div>
	</table>
</div>
<?php
}
?>
</form>
