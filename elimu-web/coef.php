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

<?php
include 'all_function.php';
if(isset($_POST['DISCIPLINE_ID']))
{
//=$_POST['MAT'];
$discipline =securite_bdd($_POST['DISCIPLINE_ID']);
$annee=annee_academique();
// vérifier l'éxistance de sous disciplie
$reqsd=findByNValue("sous_matiere","discipline='$discipline'");
$nbsd=mysql_num_rows($reqsd);

	if($nbsd <>0)	{
	
					while($ligne2d=mysql_fetch_row($reqsd))
{
$slib2d=$ligne2d['1'];
$cl=$ligne2d['0'];
	echo'<td>
<INPUT type="checkbox" name="choix[]" value="'.$cl.'"checked >'.$slib2d.'
</td>';
}
 echo" <input name=nbsd type=hidden value=$nbsd>";
	}	
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=LEFT>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=white align=center >
			<th width=200>Niveau Etude</th>
            <th width=200>Co&eacute;fficients</th>            
                     </tr>';

$req4=findByNValuelib("credit_horaire","etude","discipline='$discipline' and credit_horaire >0 and credit_horaire.etude not in
(select etude from coefficients where discipline='$discipline' )");
$nb=mysql_num_rows($req4);
                  $i=1;
if(($nb==0) and ($nbsd==0)) {
echo'insertion impossible car donn&eacute;es d&eacute;ja enregistr&eacute;es ou Cr&eacute;dits horaires non encore enregistr&eacute;es ';
}
elseif($nb <> 0){
	  
while($ligne4=mysql_fetch_array($req4))
{
$niveau=$ligne4['etude'];
$t_etude = findByValue('etudes','idetude',$niveau);
						$val_etude = mysql_fetch_row($t_etude);
						$niv=$val_etude[1];
//$niv=htmlentities($niveau);
  echo" <input name=nbart type=hidden value=$nb>";

      echo"<tr>
			            <td align=center><b>$niv</b></td>
							<td  align=center>
			            		  <input size=9 name=nbre_classe$i type=number min=0 max=20 required  onkeyup='verif_nombre(this);'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</td>
							"; 
 echo" <input name=niveau$i type=hidden value='$niveau'>";



			       
                     $i++;
}
//echo"<input type=hidden name=discipline value='$discipline'>";

echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';

}
}
?>