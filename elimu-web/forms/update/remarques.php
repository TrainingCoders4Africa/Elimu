<?php
$numero=@securite_bdd($_GET['upd']);
if($numero==""){
affichedos("remarques","","id ","?mod=1",10,"mod");
}
else{
$etagiaire = findByValue('remarques','id',$numero);
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $libelle=$row[1];						  
					      $min=$row[2];
						  $max=$row[3];
					      //$etude=$row[4];
					      
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
<form name="inscription_form" action=<?php echo lien();?> method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" align=center >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Libelle Remarque *</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" SIZE=30 MAXLENGTH="100" NAME="discipline" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $libelle?>" id="libelle" readonly ></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B >&nbsp;Note Minimale *</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="number" min=1 max=21 NAME="mini"  value="<?php echo $min?>" required autofocus></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Note Maximale *</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="number" min=1 max=21 NAME="maxi"  value="<?php echo $max?>" required></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
			<td><input type="hidden" name="id" value="<?php echo $numero;?>"></td>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td><input class=kc1 type="submit" name="modif" value="Modifer" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><tr>
</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	
<!--	<input class=kc1 type="submit" name="supprimer" value="Supprimer" /></td></tr>!-->
	
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["id"]) ) {
update_remarque();
}
if (isset($_POST["supprimer"]) and isset($_POST["id"]) ) {
delete_uv();
}
?>
<?php
}
?>
