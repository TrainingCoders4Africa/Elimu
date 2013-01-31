<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350">Semestre</th>
  				 	<th width="150">Début Semestre</th>
  				 	<th width="100">Fin Semestre</th>
  				 	<!--<th width="150">Niveau Etude</th>!-->
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('semestres');
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						$p2=$row1[2];
						$p3=$row1[3];
						echo"<tr>
							<td  align=center>$p1</td>
							<td  align=center>$p2</td>
							<td  align=center>$p3</td>";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
