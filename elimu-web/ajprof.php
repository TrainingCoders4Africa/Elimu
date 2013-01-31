<?php
include 'all_function.php';
if(isset($_POST['PROF_ID']) and isset($_POST['CYCLE_ID']))
{
$matricule =securite_bdd($_POST['PROF_ID']);
$cycle =securite_bdd($_POST['CYCLE_ID']);
$annee=annee_academique();	
$table='credit_horaire';
$libelle='discipline';
$table1 = 'specialites';
if($cycle=='MOYEN'){
$limite=2;
}
else{
$limite=1;
}
$prof = findByNbreValue($table1,"professeur='$matricule'");
						$pval = mysql_fetch_row($prof);
						$n=$pval[0];
						if($n<$limite)
$selection =findByNValuelib($table,$libelle,"etude in( select idetude from etudes where  cycle='$cycle')");
						else 
$selection =findByNValuelib($table1,$libelle,"professeur='$matricule'");

						
echo'<tr><td align="left">
 <B>&nbsp;Liste des Disciplines *</B><select name="discipline" id="discipline"  required onchange="go1()">
<OPTION value=""></OPTION>';    
					
				 while($ro=mysql_fetch_row($selection)){
				 $etagiaire = findByValue('disciplines','iddis',$ro[0]);
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $disci=$row[1];
						   
                            echo"<option value='".$ro[0]."'>".utf8_encode($disci)."</option>";
    			}
				
ECHO'</SELECT ></td>
<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</td></TR>';

				
}
?>