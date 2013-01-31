<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">
  				 <tr bgcolor="white">
                    <!--th width="120"> Numero Etagiaire</th-->
  				 	<th width="150">Libellé de la Série</th>
  				 	
                </tr>
				<tbody><tr>
				<?php
              		$selection = findByAll('series');
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];
						
						echo"<tr>
							<td  align=center>$p1</td>";
						
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
