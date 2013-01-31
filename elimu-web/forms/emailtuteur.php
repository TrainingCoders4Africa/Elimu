<?php
$matricule=$_SESSION['matricule'];
$classe=securite_bdd($_GET['classe']);
$eleve=securite_bdd($_GET['eleve']);
$adresse=securite_bdd($_GET['adresse']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
?>
<form name="inscription_form" action="metier/tuteurmail.php" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data" >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD>
		<TD class=petit>&nbsp;<input type=hidden name="matricule" id="matricule" value="<?php echo $matricule;?>"></TD>
			<TD class=petit>&nbsp;<input type=hidden name="eleve" id="eleve" value="<?php echo $eleve;?>"></TD>
		</TR>
<tr><td><B>Object</B> : </td><td><input type="text" name="objet" size="45" maxlength="100"  required/></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
    <tr><td><B>Message </B>: </td><td><textarea id="textar" name="message" cols="80" rows="10" required ></textarea></td>
	<!--<td><input type="text" name="message" size="45" maxlength="100"  required/></td>!-->
	</tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
	<TR>
<TD ><B>&nbsp;Piéce </B></TD><TD><INPUT TYPE="file" name="photo"></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
</tbody>

<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>
<tr><TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $classe;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="adresse" value="<?php echo $adresse;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="annee" value="<?php echo $annee;?>"></TD></tr>
</table>
<?php
/*if (isset($_POST["enregistrer"]) and isset($_POST["eleve"]) ) {

//}
}*/
?>