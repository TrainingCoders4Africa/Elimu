<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
  				 <tr bgcolor="white">
                    <th width="250"> Profiles</th>
  				 	<th width="150">Cycle</th>
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('profiles');
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[0];
						$p2=$row1[1];
						echo"<tr>
							<td  align=center>$p1</td>
							<td  align=center>$p2</td>
							</tr>";
						
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
