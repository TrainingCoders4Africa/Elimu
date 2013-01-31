<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="250"> Disciplines</th>
  				 	<th width="150">Niveau Etude</th>
  				 	<th width="150">Crédit Horaire</th>
  				 	<th width="100">Nbre Leçon</th>
                </tr>
				<tbody><tr>
				<?php
								$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('credit_horaire');
}
else{
	$selection = findByNValue('credit_horaire',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
            
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$iddis=$row1[1];
						//libelle discipline
						$t_discipline = findByValue('disciplines','iddis',$iddis);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
						$idnature=$row1[5];
						// libelle type
						$idetude=$row1[4];
						$t_nature = findByValue('nature','idnature',$idnature);
						$val_nature = mysql_fetch_row($t_nature);
						$nature=$val_nature[1];
						if($nature<>'Autres')
						$affi=$nature.' : '.$discipline;
						else
						$affi=$discipline;
						//libelle etudes
						$t_etude = findByValue('etudes','idetude',$idetude);
						$champ_etud = mysql_fetch_row($t_etude);
						$libelle_etude=$champ_etud[1];
						$p3=$row1[2];
						
						$t_etude = findByValue('etudes','idetude',$idetude);
						$champ_etud = mysql_fetch_row($t_etude);
						$libelle_etude=$champ_etud[1];
						$p3=$row1[2];
						$lesson=$row1[3];
						echo"<tr>
							<td  align=left>$affi</td>
							<td  align=left>$libelle_etude</td>							
							<td  align=center>$p3". 'H'."</td>
							<td  align=center>$lesson</td>";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
