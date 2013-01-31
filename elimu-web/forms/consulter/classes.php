<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Etudes</th>
  				 	<th width="250">Classes</th>
                </tr>
				<tbody><tr>
				<?php
								$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('classes');
}
else{
	$selection = findByNValue('classes',"etude in(select idetude from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$idetude=$row1[1];
						$t_etude = findByValue('etudes','idetude',$idetude);
						$champ_etud = mysql_fetch_row($t_etude);
						$libelle_etude=$champ_etud[1];
						$p2=$row1[3];
						echo"<tr>
							<td  align=center>$libelle_etude</td>
							<td  align=center>$p2</td>";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
