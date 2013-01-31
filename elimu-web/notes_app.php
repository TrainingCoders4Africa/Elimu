<?php
include 'all_function.php';
if(isset($_POST['CL_ID']) and isset($_POST['PROF_ID'])  and isset($_POST['SEMESTRE_ID']))
{
$semestre =$_POST['SEMESTRE_ID'];
//$classe=$_POST['CL_ID'];
$personnel=$_POST['PROF_ID'];
$sclasse=accents($_POST['CL_ID']);
$annee=annee_academique();
if($semestre<>''){
echo'<TD>
<B>&nbsp;Liste des Disciplines *</B><select name="uv" id="uv" onchange="go1()" required>
<OPTION value=""></OPTION>';
$sqlstm1="SELECT distinct discipline from evaluations WHERE annee ='$annee' and  classe='$sclasse' and semestre='$semestre' and personnel='$personnel'";
$req1=mysql_query($sqlstm1);
while($lignes=mysql_fetch_array($req1))
{
	$codes=$lignes['discipline'];
	$dis = explode("D", $codes);
			$iddis = $dis[0];
			$idsm=$dis[1];
					
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$discipline=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")
						$affi=$discipline.' : '.$sousd;
						else
						$affi=$discipline;
	


				
				//while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$codes."'>".$affi."</option>";
    			}
				echo'
					</select></TD>';
	}			
}
?>