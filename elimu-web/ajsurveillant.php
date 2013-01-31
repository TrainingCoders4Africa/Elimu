<?php
header('Content-Type: text/html; charset=UTF-8');
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$matricule =securite_bdd($_POST['CLASSE_ID']);
$annee=annee_academique();
echo'	<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Classes *&nbsp; </B></TD>
	 <table border=0 cellpadding=0 cellspacing=10 >
	   <tr> ';      
 $table = 'classes';
				 
				 $selection = findByNValue($table,"etude in(select idetude from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='SURVEILLANT')) and
				 idclasse not in(select classe from surveiller where personnel<>'$matricule'and annee='$annee')");
				while($ligne2d=mysql_fetch_row($selection))
{
$slib2d=$ligne2d['3'];
$cl=$ligne2d['0'];
$table1 = 'surveiller';
$prof = findByNValue($table1,"annee='$annee' and personnel='$matricule' and classe='$cl'");
						$pval = mysql_fetch_row($prof);
						$cy=$pval[1];
						if($cy=="")
						$valu='';
						else
						$valu='checked';

echo'
<td>
<INPUT type="checkbox" name="choix[]" value="'.$cl.'" '.$valu.'>'.$slib2d.'
</td>';
 
}

ECHO'
<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</tr></TR>';
echo' 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';
				
}


?>