 
<form name="inscription_form" action=<?php echo lien();?> method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody>


			<?php
                /*
				 $table = 'sigle';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}*/
    			 if(@$_POST['sigle']<>""){
                 	echo'<input name="sigle" type="hidden" value="'.$_POST['sigle'].'">';
                 }
                 else{
					echo'<tr>
			<td width="234" > Filiére</td><td>
					<select name="sigle" id="sigle" onchange ="submit();">
					<option value=""></option>';


					 $table = 'filieres';
					 $selection = findByAll($table);
					while($ro=mysql_fetch_row($selection)){
	                            echo"<option value='".$ro[0]."'>".$ro[0]."</option>";
	    			}
	    		echo'</td>
		</tr>';
    			 }
    			 $champ = 'sigle1';
    				$condition = addslashes(@$_POST['sigle']);
    				$valeur = findByValue("filieres",$champ,$condition);
    				$info = mysql_fetch_row($valeur);



    			?>




		<tr>
			<td width="200" ><B>Sigle Filiére</B></td><td>
				<input name="sigle1" id="Nom" value="<?phpecho $info[0];?>"size=10 class="inputbig" type="text" readonly>
			</td>
			</tr>


<tr><td>&nbsp; </td></tr>
			<tr>
			<td  width="200" ><B>Libellé Filiére</B></td><td>
				<input name="libelle" id="Specification" value="<?phpecho $info[1];?>" realname="Prénom"size=70 class="inputbig" type="text" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire">
			</td>
		</tr>

			


	</tbody>
<tr><td>&nbsp; </td></tr>
	<tr><td>&nbsp; </td><td><input class=kc1 name="valider" type="submit" value="Modifier" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>

<?php
if (isset($_POST["valider"]) and isset($_POST["sigle1"]) ) {
update_filiere();}
?>