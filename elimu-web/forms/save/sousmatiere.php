<?php
$discipline=securite_bdd($_GET['discipline']);
// connaitre le libellé du discipline a traiter
$dis = findByValue('disciplines','iddis',$discipline);
						$Champdis = mysql_fetch_row($dis);
						$libdis=$Champdis[1];
						$cycle=$Champdis[2];
?>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
		<tbody align="center">
		<tr>
		   <td><B>&nbsp;Cycle :&nbsp;&nbsp;&nbsp;</B><?php echo $cycle;?>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Discipline&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?php echo $libdis;?>
</TD>
		</tr>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<tr>
			<td ALIGN=LEFT ROWSPAN=1 NOWRAP><B>Sous Discipline </B>
				<input name="libelle" id="Sous Discipline" value=""size=35 MAXLENGTH="50" class="inputbig" type="text" autofocus required title="Série pour le second cycle"  ONCHANGE="this.value=this.value.toUpperCase()">
			</td>
			</tr>

<tr><td>&nbsp; </td></tr>

	<tr><td><input type="hidden" name="discipline" value="<?php echo $discipline;?>"></td></tr>
	</tbody>
<tr><td><BUTTON TITLE="Confirmer l'ajout de sous discipline" TYPE="submit" id="flashit" name="enregistrer">Valider</BUTTON>
&nbsp;&nbsp;<BUTTON TITLE="Confirmer l'annulation" TYPE="reset" id="flashit" name="modif">Annuler</BUTTON></td></tr>
</table>
</div>

</form>
<?php
save_sousdiscipline();
?>