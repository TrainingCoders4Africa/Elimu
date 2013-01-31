<?php
include 'all_function.php';
if(isset($_POST['CLASSE_ID']))
{
$matricule =$_POST['CLASSE_ID'];
$annee=annee_academique();
$table1 = 'enseignant';
$table = 'classes';	
$prof = findByNValue($table1,"annee='$annee' and personnel='$matricule'");
						$pval = mysql_fetch_row($prof);
						$cy=$pval[1];
						$etag = findByValue('classes','idclasse',$cy);
						$cha = mysql_fetch_row($etag);
						$classe=$cha[3];
				
				if($cy==""){
					$selection = findByNValue($table,"etude in(select idetude from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='ENSEIGNANT'))");
						}
						else{
						$selection = findByNValue($table,"etude in(select idetude from etudes where cycle in( select cycle from fonction where personnel='$matricule' and profile='ENSEIGNANT')) and idclasse<>'$cy'");
					
						}
						
						
echo'<tr><td align="left">
<B>&nbsp;Liste des Classes *</B><select name="classes" id="classes"  required>
<OPTION value="'.$cy.'">'.$classe.'</OPTION>';    

				 
				 while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[3]."</option>";
    			}
				
ECHO'</SELECT ></td>


<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</td></TR>';
echo'
 
<table> <TR><TD class=petit>&nbsp;</TD></TR>
<tr><td>&nbsp; </td><td><input class=kc1 type="submit" name="enregistrer" value="Valider" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
</table>';				
}


?>