
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
  				 <tr bgcolor="white">
                    <th width="250"> Remarques</th>
  				 	<th width="150">Note Minimale</th>
  				 	<th width="150">Note Maximale</th>
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('remarques');
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						$p2=$row1[2];
						$p3=$row1[3];
						echo"<tr>
							<td  align=center>$p1</td>
							<td  align=center>$p2</td>
							<td  align=center>$p3</td>
							";
					
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
