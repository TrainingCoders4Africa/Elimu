<?php
//affichage des infos de la table credit_horaire
$numero=@securite_bdd($_GET['upd']);
if($numero==""){
affichedos("credit_horaire","","idch ","?mod=1",10,"mod");
}
else{
//formulaire de modification du crédit horaire choisi
$etagiaire = findByValue('credit_horaire','idch',$numero);
						$row = mysql_fetch_row($etagiaire);
                           $libelle=$row[1];
						   $t_discipline = findByValue('disciplines','iddis',$libelle);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
					      $credit=$row[2];
						  $lesson=$row[3];
					      $idetude=$row[4];
						  $idnature=$row[5];
						   $t_etude = findByValue('etudes','idetude',$idetude);
						$val_etude = mysql_fetch_row($t_etude);
						$etude=$val_etude[1];
						
						$t_nature = findByValue('nature','idnature',$idnature);
						$val_nature = mysql_fetch_row($t_nature);
						$nature=$val_nature[1];
					      
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
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Disciplines *</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE="text" SIZE=30 MAXLENGTH="100" NAME="discipline" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $discipline?>" id="libelle" readonly ></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Crédit Horaire *&nbsp;</B>&nbsp;<INPUT type="number" min=1 max=100 NAME="credit" SIZE=5  value="<?php echo $credit?>" required autofocus></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Nbre Leçon *&nbsp;</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT type="number" SIZE=5 min=1 max=100 NAME="lesson"  value="<?php echo $lesson?>" required></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Niveau Etude *&nbsp;</B>&nbsp;&nbsp;&nbsp;<INPUT type="text" SIZE=10 MAXLENGTH="20" NAME="etude_affi"  value="<?php echo $etude?>" required readonly></TD></TR>	
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Type de Discipline *&nbsp;</B><SELECT NAME="type" required autofocus />
<OPTION  value="<?php echo $idnature?>"><?php echo $nature?></OPTION>
<?php
				 $selection = findNByValue('nature','idnature',$idnature);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>
</SELECT ></td></tr>
<TR>		<td><input type="hidden" name="id" value="<?php echo $numero;?>"></td>
			<td><input type="hidden" name="uv" value="<?php echo $libelle;?>"></td>
				<td><input type="hidden" name="etude" value="<?php echo $idetude;?>"></td>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><input class=kc1 type="submit" name="modif" value="Modifer" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--	<input class=kc1 type="submit" name="supprimer" value="Supprimer" /></td></tr>!-->
	
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["id"]) ) {
update_uv();
}
if (isset($_POST["supprimer"]) and isset($_POST["id"]) ) {
delete_uv();
}
?>
<?php
}
?>
