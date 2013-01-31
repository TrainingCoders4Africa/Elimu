<?php
//include 'all_function.php';
include '/dao/connection.php';
include '/dao/select.php';
//include "metier/stats.php";
if(isset($_POST['PROF_ID']) and isset($_POST['SEMESTRE_ID']) )
{
$code=securite_bdd($_POST['SEMESTRE_ID']);
$sclasse=securite_bdd(accents($_POST['PROF_ID']));
$annee=annee_academique();
$nb=0;

echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><B>&nbsp;HORAIRE&nbsp;</B></TD>
';
 $sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

echo'

<Td align=center colspan=1 NOWRAP ><FONT color="black" ><B>&nbsp;'. $libellec0.' &nbsp;</B></FONT></Td>';
 
}

echo'</tr>';
 $sqlstm1mel100="select distinct debut ,fin  from emploi_temps where classe='$sclasse' and semestre='$code' and annee='$annee' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$debut=$ligne10u14mel100['debut'];
$fin=$ligne10u14mel100['fin'];

$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];




echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$d.' - '.$fi.'&nbsp;</B></FONT></TD>';

$horaire=$d.' - '.$fi;
// $sqlstm1gaz100="select id from jours  order by id";
//choisir les jours
$req10mu14gaz100=findBylib("jours","id");
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$jour=$ligne10u14gaz100['id'];
//selectionner le planning prévu suivant le jour choisi
$req10mu141000=findByNValue("emploi_temps","jour='$jour' and debut='$debut' and fin='$fin' and classe='$sclasse' and semestre='$code' and annee='$annee'");
$ligne10u141000=mysql_fetch_array($req10mu141000);
$dis=$ligne10u141000['discipline'];
$sal=$ligne10u141000['salle'];
 $naturee = findByValue('salles','id',$sal);
						$entitee = mysql_fetch_row($naturee);
						$salle=$entitee[1];
 $nature = findByValue('disciplines','iddis',$dis);
						$entite = mysql_fetch_row($nature);
						$discipline=accents($entite[1]);

if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
$cours="-";
}
else{
$cours= $discipline.'<br/>'.$salle;
echo'
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP ><A HREF="emplois_classes.php?sup=1'.'&j='. $jour.'&hd='. $debut.'&hf='.$fin.'&num='. $sclasse.'&se='. $code.'"><FONT color= "black" >&nbsp;'. utf8_encode($discipline).'<br/>'.$salle.'&nbsp;</TD>';
}
					
}

echo"</tr>";
}

echo'</table>';
?>
<div>          
<a href="forms/imprimer/js1.php?classe=<?php echo $sclasse;?>&semestre=<?php echo $code;?>" target="_blank" class=imp>Aper&ccedil;u</a>
</div>
<?php
}
?>