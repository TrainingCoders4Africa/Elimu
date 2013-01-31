<?php
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$jour=securite_bdd($_GET['j']);
$debut=securite_bdd($_GET['hd']);
$fin=securite_bdd($_GET['hf']);
$semestre=securite_bdd($_GET['se']);
$sqlstm20="select  libelle from jours where id='$jour'";
$req20=mysql_query($sqlstm20);

while($ligne20=mysql_fetch_array($req20))
{
$sjour=$ligne20['libelle'];
}
$sqlstm11000="select discipline,salle  from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and classe='$sclasse' and semestre='$semestre' and annee='$annee'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$discipline=$ligne10u141000['discipline'];
$salle=$ligne10u141000['salle'];

 $naturee = findByValue('salles','id',$salle);
						$entitee = mysql_fetch_row($naturee);
						$sal=$entitee[1];
 $nature = findByValue('disciplines','iddis',$discipline);
						$entite = mysql_fetch_row($nature);
						$dis=$entite[1];
?>
<script language="Javascript">
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
/*if(champ.value.charAt(x) == "."){points++;}  Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>
<form name="inscription_form"  method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=left >
		<tbody>

		<TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Code Semestre&nbsp;</B><INPUT TYPE="text" SIZE=20 MAXLENGTH="50" NAME="jr"   value="<?php echo $semestre;?>" disabled></TD>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Jour&nbsp;</B><INPUT TYPE="text" SIZE=20 MAXLENGTH="50" NAME="jr"   value="<?php echo $sjour;?>" disabled></TD>

</TR>

<TR><TD class=petit>&nbsp;</TD></TR>

<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Début Cours&nbsp;</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="50" NAME="debut"   value="<?php echo $debut;?>" disabled></TD>
 
 <TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Fin Cours&nbsp;</FONT></B><INPUT TYPE="text" SIZE=12 MAXLENGTH="50" NAME="fin"   value="<?php echo $fin;?>" disabled></TD>
 <TD class=petit>&nbsp;</TD><TD class=petit>&nbsp;</TD><TD class=petit>&nbsp;</TD>
</TR>

<TR><TD class=petit>&nbsp;</TD></TR>

<TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Discipline&nbsp;</FONT></B><INPUT TYPE="text" SIZE=30 MAXLENGTH="50" NAME="discipline"  value="<?php echo $dis;?>" disabled ></TD>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Salle&nbsp;</FONT></B><INPUT TYPE="text" SIZE=20 MAXLENGTH="50" NAME="salle"   value="<?php echo $sal;?>" disabled></TD>

</TR>
		<TR><TD class=petit>&nbsp;</TD></TR>
 	</tbody>
<td><input type="hidden" name="classe" value="<?php echo $classe;?>" id="classe"></td>
</TR>

<TR><td><BUTTON TITLE="Confirmer l'ajout de cet Distributeur" TYPE="submit" id="flashit" name="supprimer">Supprimer</BUTTON></TD></TR>
	</table><TR><TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $sclasse;?>"></TD></TR>
	<TR><TD class=petit>&nbsp;<input type=hidden name="sem" value="<?php echo $semestre;?>"></TD></TR>
<TR><TD class=petit>&nbsp;<input type=hidden name="annee" value="<?php echo $annee;?>"></TD></TR>
<TR><TD class=petit>&nbsp;<input type=hidden name="jour" value="<?php echo $jour;?>"></TD></TR>
<TR><TD class=petit>&nbsp;<input type=hidden name="debut" value="<?php echo $debut;?>"></TD></TR>
<TR><TD class=petit>&nbsp;<input type=hidden name="fin" value="<?php echo $fin;?>"></TD></TR>
</div>

</form>
<?php
if (isset($_POST["supprimer"]) and isset($_POST["classe"]) ) {
delete_emploi();
}
?>