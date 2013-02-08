<?php
//include 'all_function.php';
include '/dao/connection.php';
include '/dao/select.php';
//include "metier/stats.php";
if(isset($_POST['CLASSE_ID']) and isset($_POST['SEM_ID']) )
{

$classe=securite_bdd($_POST['CLASSE_ID']);
$semestre=securite_bdd($_POST['SEM_ID']);
$annee=annee_academique();
$nb=0;
if($semestre<>''){
$table="eleves";
 $selection =mysql_query("select * from eleves where matricule in( select eleve from inscription where  classe='$classe' and annee='$annee')
and matricule not in (select eleve from moyennes where semestre='$semestre' and annee='$annee') order by nom8");
 echo'<tr><td align="left">
 <B>&nbsp;Liste des '.utf8_encode("Eléves").' *</B><select name="eleve" id="eleve"  required onchange="go1()">
<OPTION value=""></OPTION>';    
					
				 while($ro=mysql_fetch_array($selection)){
				
                       $eleve=$ro['matricule'];
                        $prenom=utf8_encode($ro['prenom8']);
					    $nom=utf8_encode($ro['nom8']);
                            echo"<option value='".$eleve."'>".$prenom." ".$nom."</option>";
    			}
				
ECHO'</SELECT ></td>
<td><input type="hidden" name="annee" value="'.$annee.'"></td>
</td></TR>
<tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></tr>';
}
}

?>