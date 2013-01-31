<?php
$matricule=$_SESSION['matricule'];
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1e="SELECT count(*) ns FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1e=mysql_query($sqlstm1e);
$lignee=mysql_fetch_array($req1e);
$ns=$lignee['ns'];

$sqlstm1="SELECT id,libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
	$code=$ligne['id'];
	$libelle=$ligne['libelle'];
	$debut=$ligne['debut'];
	$fin=$ligne['fin'];
	}
		if($ns==0){
echo $datejour .' n\'est dans  aucun semestre donc impossible de faire un traitement  pour cette date';
}
 else{ 
	?>
<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  				 <tr bgcolor="white">
                    <th width="300"> Date Prévue</th>
  				 	<th width="150">Horaire</th>
  				 	<th width="150">Disciplines</th>				
  				 	<th width="150">Classe</th>
  				 	<th width="150">Nature</th>					
  				 	<th width="150">Lieu</th>
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByNValue('evaluations',"personnel='$matricule' and annee='$annee' and semestre='$code'");
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$date_p=$row1[1];
						$hd=$row1[2];
						$hf=$row1[3];
						
$array_heure=explode(":",$hd);
	$debut=$array_heure[0]."H".$array_heure[1];

	$array_heuref=explode(":",$hf);
	$fin=$array_heuref[0]."H".$array_heuref[1];
	$horaire=$debut.'-'.$fin;
						$dis=$row1[4];
						$disc = explode("D", $dis);
			$iddis = $disc[0];
			$idsm=$disc[1];
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
						$idclasse=$row1[5];
						$t_classe = findByValue('classes','idclasse',$idclasse);
						$ch_classe = mysql_fetch_row($t_classe);
						$classe=$ch_classe[3];
						$type=$row1[6];
						$sal=$row1[9];
						$titr = findByValue('salles','id',$sal);
						$ti = mysql_fetch_row($titr);
						$salle=$ti[1];
						echo"<tr>
							<td  align=center>$date_p</td>
							<td  align=center>$horaire</td>							
							<td  align=center>$affi</td>					
							<td  align=center>$classe</td>					
							<td  align=center>$type</td>					
							<td  align=center>$salle</td>
							";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
<?php
}?>