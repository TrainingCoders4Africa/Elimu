<?php 
$sclasse=securite_bdd($_GET['num']);
$annee=annee_academique();
$nbre_eleve=effectif_classe($sclasse,$annee);
?>
<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<?php 
if($nbre_eleve==0)
echo'pas d\'inscrit dans cette classe pour l\'ann�e acad�mique '.$annee;
else{
?>

<div align=left><B>&nbsp;Effectif de la classe : <?php echo @$nbre_eleve;?>&nbsp;</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="forms/imprimer/eleves.php?classe=<?php echo $sclasse;?>&annee=<?php echo $annee;?>" target="_blank" > Exporter la liste des El�ves</a>
</div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

  				 <tr bgcolor="white">
                    <th width="60"> Matricule</th>
  				 	<th width="300">El�ve</th>
  				 	<th width="500">Date & Lieu de Naissance</th>
  				 	<th width="600">Tuteur</th>
					<th width="600">Coordonn�es Tuteur</th>					
					<th width="100">Coordonn�es El�ve</th>
                </tr>
				<tbody><tr>
				<?php
			
              		$selection =  findByNValue("eleves","matricule in(select eleve from inscription where classe='$sclasse' and annee='$annee')");
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[0];
						$prenom=$row1[1];
						$nom=$row1[2];
						$date_nais=$row1[4];
						$lieu_nais=$row1[5];
						$tuteur=$row1[6];
						$email_t=$row1[7];
						$tel_t=$row1[8];
						$tel_e=$row1[9];
						$adresse=$row1[11];
						//$eleve=$prenom.' '.$nom;
						$dlnais=$date_nais.' � '.$lieu_nais;
						// v�rifer sil ya connexion internet
						if(($email_t<>"") and $sock = @fsockopen('www.google.fr', 80, $num, $error, 5))
						$ls='<a href="emailtuteur.php?classe='. $sclasse.'&eleve='.$p1.'&adresse='.$email_t.'"  title="Envoyer un Email au tuteur">';
						else
						$ls='';
						
						echo"<tr>
							<td  align=center><a HREF='el_notes.php?matricule=".$p1."&num=".$sclasse."' title='Consulter les notes'>$p1</a></td>
							<td  align=center>".$prenom.' '.$nom."</td>
							<td  align=center>".$date_nais.' � '. $lieu_nais."</td>
							";
										
						echo'
							<td  align=center>'.$tuteur.'</td>
							<td  align=left>Adresse :'.$adresse.'</br> T�l :<a href="smstuteur.php?classe='. $sclasse.'&eleve='.$p1.'&tel='.$tel_t.'" title="Envoyer un SMS">'.$tel_t.'</a></br>E-mail :'.$ls.$email_t.'</td>
							<td  align=center>'.$tel_e.'</td>
							
							</tr>';/**/
        			
}
  }
  				 ?>
</tr></tbody>
</table>
<BR>
