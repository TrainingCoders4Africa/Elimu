
<?php
$numero=@securite_bdd($_GET['upd']);
if($numero==""){
affichedos("coefficients","","idcoef ","?mod=1",3,"mod");
}
else{
$etagiaire = findByValue('coefficients','idcoef',$numero);
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $coef=$row[1];
					      $dis=$row[2];
					      $etude=$row[3];
					      $etagiaires = findByValue('disciplines','iddis',$dis);
						$row1 = mysql_fetch_row($etagiaires);
                       $discipline=$row1[1];
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
<form name="inscription_form" action=<?phpecho lien();?> method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" align=center >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<TR>
<TD><B>&nbsp;Disciplines *</B><INPUT TYPE="text" SIZE=50 MAXLENGTH="100" NAME="discipline" ONCHANGE="this.value=this.value.toUpperCase()" value="<?phpphp echo $discipline?>" id="libelle" readonly ></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>
<B>&nbsp;Coefficient *&nbsp;</B><INPUT type="number" min=1 max="10" NAME="coef"  value="<?phpphp echo $coef?>" required autofocus></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<B>&nbsp;Niveau Etude *&nbsp;</B><INPUT type="text" SIZE=10 MAXLENGTH="20" NAME="etude"  value="<?phpphp echo $etude?>" required readonly></TD>
			<td><input type="hidden" name="id" value="<?php echo $numero;?>"></td>
			<td><input type="hidden" name="uv" value="<?php echo $dis;?>"></td>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><input class=kc1 type="submit" name="modif" value="Modifer" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!--<input class=kc1 type="submit" name="supprimer" value="Supprimer" /></td></tr>!-->
	
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["id"]) ) {
update_coef();
}
if (isset($_POST["supprimer"]) and isset($_POST["id"]) ) {
delete_uv();
}
?>
<?php
}
?>
