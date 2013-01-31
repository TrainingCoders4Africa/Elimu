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
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody><tr>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200"><B>&nbsp;Honneurs</B></TD>
<TD width="30" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="1"><SELECT NAME="libelle" id="libelle1" required
placeholder="Selectionner" autofocus/ >
<OPTION value=>Selectionner</OPTION>
<OPTION  value="FELICITATIONS">FELICITATIONS</OPTION>
<OPTION value="ENCOURAGEMENTS">ENCOURAGEMENTS</OPTION>
<OPTION value="TABLEAU D'HONNEUR">TABLEAU D'HONNEUR</OPTION>
<OPTION value="AVERTISSEMENT">AVERTISSEMENT</OPTION>
<OPTION value="BLAME">BLAME</OPTION>
</OPTION>

</SELECT></TD>
</TR>
			</tr>
<TR><TD class=petit>&nbsp;</TD></TR>
 <tr>
		              <td  ALIGN=LEFT width="200"><b>Note Minimale *</b></td><td  ALIGN=LEFT>
		              <input name="mini" type="number" size="10"  min=1 max=21  onkeyup="verif_nombre(this);" required></td>
		            </tr>

<TR><TD class=petit>&nbsp;</TD></TR>
 <tr>
		              <td  ALIGN=LEFT width="200"><b>Note Maximale *</b></td><td  ALIGN=LEFT>
		              <input name="maxi" type="number" size="10"  min=1 max=21  onkeyup="verif_nombre(this);" required></td>
		            </tr>


	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_honneur();

?>