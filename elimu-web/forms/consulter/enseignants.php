<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="300"> Enseignants</th>
  				 	<th width="300">classes</th>
  				 	
                </tr>
				<tbody><tr>
				<?php
				$annee=annee_academique();
				 $table = 'enseignant';
				 $lib = 'libelle';
				 $selection = findByValue($table,'annee',$annee);
              		
              		while($row1 = mysql_fetch_row($selection))
				 	{ $b='';
				 		
                       	$p1=$row1[0];
						
						
						$p2=$row1[1];
						$etag1 = findByValue('classes','idclasse',$p2);
						$cha1 = mysql_fetch_row($etag1);
						$classe=$cha1[3];
						$b=$b.' '.$classe;
						$perso = findByValue('personnels','matricule',$p1);
						$per = mysql_fetch_row($perso);
						$p3=$per[1];
						$p4=$per[2];
						$p8=$per[3];
						$etag = findByValue('titre5','id',$p3);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
						echo"<tr>
							<td  align=center>".' '.$titre.' ' .$p4.' '.$p8."</td>
							<td  align=center>$b</td>";
						
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
