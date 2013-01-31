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
		<tbody>
		<tr>
			<td width="300" align=center ><b>Libellé Salle / lieu du cours*</B></td><td>
				<input name="libelle" id="Nom" value=""size=40 class="inputbig" type="text" autofocus required  ONCHANGE="this.value=this.value.toUpperCase()">
			</td>
			</tr>
<TR><TD class=petit>&nbsp;</TD></TR>
 <tr>
		              <td width="200" align=center><b>Capacité de la salle *</b></td><td>
		              <input name="capacite" type="number" size="10"   min=10 max=10000000 id="Capacité"  onkeyup="verif_nombre(this);" required></td>
		            </tr>



	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_salle();

?>