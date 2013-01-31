<script>
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

<?php
include 'all_function.php';
if(isset($_POST['CYCLE_ID']) and isset($_POST['MAT']) )
{
$discipline =securite_bdd($_POST['MAT']);
$cycle =securite_bdd($_POST['CYCLE_ID']);
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=white align=center >
			<th width=200>Niveau Etude</th>
            <th width=200>Cr&eacute;dit Horaire</th>
            <th width=100>Nbre le&ccedil;on</th>
            <th width=100>Type de Discipline</th>
            
                     </tr>';
$req4=mysql_query(" select idetude,libelle from etudes where cycle='$cycle' and idetude not in(select etude from credit_horaire where discipline='$discipline')");

$nb=mysql_num_rows($req4);
                  $i=1;
if($nb==0){
echo'insertion impossible';
}
else{				  
while($ligne4=mysql_fetch_array($req4))
{
$niveau=$ligne4['libelle'];
$idetude=$ligne4['idetude'];
//$niv=htmlentities($niveau);
  echo" <input name=nbart type=hidden value=$nb>";

      echo"<tr>
			            <td align=center><b>$niveau</b></td>
							<td  align=center>
			            		  <input size=9 name=nbre_classe$i type=number min=0 max=500 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
								<td  align=center>
			            		  <input size=9 name=nbre_lesson$i type=number min=0 max=500 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbre_lesson$i );       //
				             	      </script>
			            		</td>
								<td  align=center>
			            		  <select name=typeuv$i id='Type'  required>
								  <OPTION  value=''></OPTION>  ";
			
								 $table = 'nature';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}

					echo"</select>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</tr>
							"; 
 echo" <input name=niveau$i type=hidden value='$idetude'>";
$i++;
}
echo"
<input type=hidden name=cycle value='$cycle'>";

echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';

}
}
?>