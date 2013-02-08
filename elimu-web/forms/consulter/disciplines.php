<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
					   <th width="150"> Cycle</th>
					   <th width="450"> Sous Disicpline</th>
					   
                </tr>
				<tbody><tr>
				<?php
								$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('disciplines');
}
else{
	$selection = findByNValue('disciplines',"disciplines.cycle in(select cycle from fonction where profile='$profile')");
}
				
              		//$selection = findByAll('disciplines');
              		while($row1 = mysql_fetch_row($selection))
				 	{
					$b=''; //liste des sous disciplines
												$iddis=$row1[0];
				 		                    	$libelle=$row1[1];
												$cycle=$row1[2];
												// les sous disciplines
						$dis = findByValue('sous_matiere','discipline',$iddis);
						while($Champdis = mysql_fetch_row($dis)){
						$libdis=$Champdis[1];
						$b=$b.', '.$libdis;
						}
						echo'<tr>
							<td  align=left><a href="sousmatiere.php?discipline='. $iddis.'title="Ajouter des sous disciplines">'.$libelle.'</td>
							<td  align=left>'.$cycle.'</td>
							<td  align=left>'.$b.'</td>
							';
					
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
