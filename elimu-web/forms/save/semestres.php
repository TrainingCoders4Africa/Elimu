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
<tr>
		       <TD><b>&nbsp;Code Semestre *</b> </td><td>
&nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="code" id="code" required   autofocus>
<OPTION  ></OPTION>
<OPTION  value="S1">S1</OPTION>
<OPTION  value="S2">S2</OPTION>
      
</SELECT ></TD> </tr>
<TR><TD class=petit>&nbsp;</TD></TR>
		            <tr>
		              <td ><b>Libelle Semestre *</b></td>
		              <td><input name="libelle" size="50" type="text"  id="Le Libellé du Semestre"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' ONCHANGE="this.value=this.value.toUpperCase()" required ></td>
		            </tr>
					<TR><TD class=petit>&nbsp;</TD></TR>
		            <tr>
		              <td><b>Date Début Semestre *</b></td>
		              <td><input name="date_d" type="date" id="date" required>//(<?php echo date("Y-m-d");?>)</td>
		            </tr>
					<TR><TD class=petit>&nbsp;</TD></TR>
      <tr>
		              <td ><b>Date Fin Semestre *</b></td>
		              <td><input name="date_f" type="date"  id="Date fin Semestre" required>//(<?php echo date("Y-m-d");?>)</td>
		            </tr>
					<TR><TD class=petit>&nbsp;</TD></TR>
		            <tr>
		              <td><b>Année Académique *</b></td>
					 			  <TD ><input type="text" name="annee"  value="<?php echo annee_academique()?>" readonly required></TD>
		             		            </tr>

	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["annee"]) )
save_semestre();

?>