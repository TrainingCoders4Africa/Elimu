
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
  				 <tr bgcolor="white">
  				 	<th width="250">Libell� du Corps</th>
  				 
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('corps5');
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						echo"<tr>
							<td  align=center>$p1</td>
						
							";
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
