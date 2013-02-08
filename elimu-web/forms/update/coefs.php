
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
					      $p2=$row[2];
						  $dis = explode("D", $p2);
			$iddis = $dis[0];
			$idsm=$dis[1];
					      $idetude=$row[3];
					      $etagiaires = findByValue('disciplines','iddis',$iddis);
						$row1 = mysql_fetch_row($etagiaires);
                       $discipline=$row1[1];
					   $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$discipline.' : '.$sousd;
						else
						$affi=$discipline;
						
					    $t_etude = findByValue('etudes','idetude',$idetude);
						$val_etude = mysql_fetch_row($t_etude);
						$etude=$val_etude[1];
?>
<script language="Javascript">
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9/.]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
if(champ.value.charAt(x) == "."){points++;}  /*Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>

<form name="inscription_form" action=<?php echo lien();?> method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" align=center >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Disciplines *</B><INPUT TYPE="text" SIZE=50 MAXLENGTH="100" NAME="discipline" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $affi?>" id="libelle" readonly ></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Coefficient *&nbsp;</B><INPUT type="number" min=1 max="10" NAME="coef"  value="<?php echo $coef?>" required autofocus></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Niveau Etude *&nbsp;</B><INPUT type="text" SIZE=10 MAXLENGTH="20" NAME="etude_aff"  value="<?php echo $etude?>" required readonly></TD>
			<td><input type="hidden" name="id" value="<?php echo $numero;?>"></td>
			<td><input type="hidden" name="uv" value="<?php echo $dis;?>"></td>
				<td><input type="hidden" name="etude" value="<?php echo $idetude;?>"></td>
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
