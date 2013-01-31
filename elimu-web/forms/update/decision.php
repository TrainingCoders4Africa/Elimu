<form name="inscription_form" action="<?php echo lien() ;?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody>
			<?php

				 if(@$_POST['classeur']<>""){
                 	echo'<input name="classeur" type="hidden" value="'.$_POST['classeur'].'">';
                 }
                 else{
					echo'<tr><td width="234">Nom du Classeur</td><td><select name="classeur" id="Classeur" onchange ="submit()">
					<option value=""></option>';


					 $table = 'decisions';
					 $selection = findByAll($table);
					while($ro=mysql_fetch_row($selection)){
	                            echo"<option value='".$ro[0]."'>".$ro[2]."</option>";
	    			}
	    			echo"</td>
				</tr>" ;
    			 }
    			 $champ = 'etude';
    				$condition = addslashes(@$_POST['classeur']);
    				$valeur = findByValue("decisions",$champ,$condition);
    				$info = mysql_fetch_row($valeur);


    			?>






		<tr>
			<td width="234" >Nom du Classeur</td><td>
				<input name="Nom" id="Nom" value="<?phpecho $info[2];?>"size=40 class="inputbig" type="text" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire">
			</td>
			</tr>



			<tr>
			<td width="234" >Specification</td><td>
				<input name="Specification" id="Spécification" value="<?phpecho $info[4];?>" size=40 class="inputbig" type="text" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire">
			</td>
		</tr>

			<tr>
			<td width="234" >Nombre de dossiers</td><td>
				<input name="nbre_dos" id="nbre de dossiers" value="<?phpecho $info[3];?>" size="5" class="inputbig" type="text" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:nombre;erreur:champs Obligatoire">
			</td>
		</tr>


			<tr>
			<td width="234" >Etagère</td><td>
				<select name="Etagiaire" id="Etagère">

			<?php
			  $selection = findByValue("etagiare","idEt",$info[1]);
				$ro=mysql_fetch_row($selection);
                echo"<option value='".$ro[0]."'>".$ro[2]."</option>";
                if($info[1]=="")
                echo"<option ></option>";
                // $etagi = findByValue("etagiaire",$champ,$condition);
    				//$info = mysql_fetch_row($etagi);
				 $table = 'etagiare';
				 $select = findByAll("etagiare");
				while($ro=mysql_fetch_row($select)){
				      if($info[1]!=$ro[0])
                            echo"<option value='".$ro[0]."'>".$ro[2]."</option>";
    			}

    			?>

			</td>
		</tr>



	</tbody>

	<tr><td>&nbsp; </td><td><input class=kc1 name="valider" type="submit" value="Modifier" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
//include"../../dao/save.php";

update_classeur();

?>