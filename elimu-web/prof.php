<?php
include 'all_function.php';
if(isset($_POST['CYCLE_ID']))
{
$cycle =securite_bdd($_POST['CYCLE_ID']);

$table='personnels';


$selection =  findByNValue($table,"enable8='1' and matricule in(select personnel from fonction where profile='PROFESSEUR' and cycle='$cycle')");
						
echo'<tr><td align="left">
 <B>&nbsp;Liste des Professeurs *</B><select name="prof" id="prof"  required onchange="go()">
<OPTION value=""></OPTION>';    
					
					while($ro=mysql_fetch_row($selection)){
				$etag = findByValue('titre5','id',$ro[1]);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
                            echo"<option value='".$ro[0]."'>".$titre." ".accents($ro[2])." ".$ro[3]."</option>";
    			}
ECHO'</SELECT ></td></td></TR>';

				
}
?>