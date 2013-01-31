<?php
include 'all_function.php';
if(isset($_POST['PROF_ID']) and isset($_POST['MAT'])and isset($_POST['CYCLE_ID']) )
{
$discipline =securite_bdd($_POST['MAT']);
$matricule =securite_bdd($_POST['PROF_ID']);
$cycle=securite_bdd($_POST['CYCLE_ID']);
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Classes *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr>       '; 
	   //echo'dis '.utf8_encode('Ç');
$sqlstm2d="select  distinct idclasse,libelle from classes where 
  classes.etude in(select etude from credit_horaire where  discipline='".$discipline."' and credit_horaire.etude in 
  (select idetude from etudes where cycle ='$cycle') and credit_horaire>0) and
  idclasse not in(select classe from enseigner where personnel<>'$matricule'and annee='$annee' and discipline='".$discipline."')  ORDER BY libelle";
$req2d=mysql_query($sqlstm2d);
echo'<tr><td>';
while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['libelle'];
$idclasse=$ligne2d['idclasse'];
$sql_selection =" select count(*) nb from enseigner where annee='$annee' and personnel='$matricule' and classe='".$idclasse."' and discipline ='".$discipline."'";
$executer=mysql_query($sql_selection);
while($ligne0=mysql_fetch_array($executer))
{
	$cy= $ligne0['nb'];//echo'<br/>';
	//$matricule= $ligne['cdeetud'];
}
				//	echo'enseigner'.$cy;
						if($cy==0)
						$valu='';
						else
						$valu='checked';

echo'<INPUT type="checkbox" name="choix[]" value="'.$idclasse.'" '.$valu.'>'.$slib2d.'
';
}
echo'</td></tr>
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';
}
?>