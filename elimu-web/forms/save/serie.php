<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
		<tbody align="center"><tr>
			<td width="200" ><B>Libellé Série *
				<input name="libelle" id="Nom" value=""size=10 class="inputbig" type="text" autofocus required title="Série pour le second cycle"  ONCHANGE="this.value=this.value.toUpperCase()">
			</td>
			</tr>

<tr><td>&nbsp; </td></tr>

	
	</tbody>
<tr><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />

	</table>
</div>

</form>
<?php
save_serie();
?>