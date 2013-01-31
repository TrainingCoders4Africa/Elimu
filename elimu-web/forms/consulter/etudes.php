<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="150"> Niveau Etude</th>
  				 	<th width="150">Libelle Etude</th>
                </tr>
				<tbody><tr>
				<?php
				$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('etudes');
}
else{
	$selection = findByNValue('etudes',"etudes.cycle in(select cycle from fonction where profile='$profile')");
}
              	
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						$p2=$row1[3];
						echo"<tr>
							<td  align=center>$p1</td>
							<td  align=center>$p2</td>";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
