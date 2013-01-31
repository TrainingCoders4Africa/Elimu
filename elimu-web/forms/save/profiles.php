<?php
$profile=$_SESSION["profil"];
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];

 ?>
<script>
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9\.]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
if(champ.value.charAt(x) == "."){points++;} /* Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody><tr>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200">&nbsp;Liste Des Cycles <SELECT NAME="libelle1" id="libelle1" required
placeholder="Selectionner" autofocus/  onchange="submit();" >
<OPTION >Selectionner</OPTION>
 <?php
$req2d=findBylib("categories","cycle");

while($ligne2d=mysql_fetch_array($req2d))
{
$slib2d=$ligne2d['cycle'];
 echo' <OPTION value="'.$slib2d.'">'.$slib2d;
 }
 echo'</OPTION>';
  if(@$_POST["libelle1"]<>"") {
 $discipline=$_POST["libelle1"];
 
  echo'
  <TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR>
  <tr>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP>&nbsp;Cycle&nbsp;<INPUT id="Le Stock de Départ" name="stock"   value="'.$discipline.' " SIZE="50" MAXLENGTH="100" disabled="disabled" ></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
';

if($ns<>0){

echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="COMPTABLE" checked> COMPTABLE
</td></TR>';
}
if($discipline=='PRESCOLAIRE' or $discipline=='ELEMENTAIRE'){
echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="DIRECTEUR" checked> DIRECTEUR
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="ENSEIGNANT" checked> ENSEIGNANT
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="AUTRES" checked> AUTRES
</td></TR>';
}
elseif($discipline=='SECONDAIRE'){

echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="CENSEUR" checked> CENSEUR
</td></TR>
<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="SURVEILLANT" checked> SURVEILLANT
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="PROFESSEUR" checked> PROFESSEUR
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="AUTRES" checked> AUTRES
</td></TR>';
}
elseif($discipline=='MOYEN'){
echo'<TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="PRINCIPAL" checked> PRINCIPAL
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="SURVEILLANT" checked> SURVEILLANT
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="PROFESSEUR" checked> PROFESSEUR
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="AUTRES" checked> AUTRES
</td></TR>';
}
elseif($discipline=='PROFESSIONNEL'){
echo'</TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="DIRECTEUR DES ETUDES" checked> DIRECTEUR DES ETUDES
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="SURVEILLANT" checked> SURVEILLANT
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="PROFESSEUR" checked> PROFESSEUR
</td></TR><TR><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<INPUT type="checkbox" name="choix[]" value="AUTRES" checked> AUTRES
</td></TR>';

}
echo'</TR>
<TD class=petit>&nbsp;<input type=hidden name="cycle" value="'. $discipline.'"></TD>
 <TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />';
}
?>


</SELECT></TD>
</TR>

<TR><TD class=petit>&nbsp;</TD></TR>

	</tbody>
	</table>
</div>

</form>

<?php
if (isset($_POST["enregistrer"]) and isset($_POST["cycle"]) ) {
save_profile();
}
?>