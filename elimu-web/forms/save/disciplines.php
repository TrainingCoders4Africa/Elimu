<?php
//récupération des cycles suivant le profile

$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
		$profile=$_SESSION["profil"];
			 $table = 'etudes';
				 $lib = 'cycle';
				
				if($profile=="Administrateur"){
 $selection = findBylib($table,$lib);
}
else{
	$selection = findByNValuelib($table,$lib," $table.cycle in(select cycle from fonction where profile='$profile')");
}
 ?>
<center>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">

	<table border="0" cellpadding="3" cellspacing="0" width="600"  align="left">
		<tbody align="center"><tr>
			<td width="200" ><B>Libellé Discipline *
				<input name="libelle" id="Discipline" value=""size=45 class="inputbig" type="text" autofocus required  ONCHANGE="this.value=this.value.toUpperCase()">
			</td>
			</tr>
			<tr>
	 <TD width="150" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Cycles *&nbsp; </B></TD>
	 </tr><table border=0 cellpadding=0 cellspacing=10 >
	 
	    <td>
<?php
	while($ligne2d=mysql_fetch_row($selection))
{
$cycle=$ligne2d['0'];

echo'
<td>
<INPUT type="checkbox" name="choix[]" value="'.$cycle.'" >'.$cycle.'
';
 
}
?>
</td></tr>
<tr><td>&nbsp; </td></tr>


	</tbody>

	<tr><td><input class=kc1 type="submit" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_discipline();
?>
