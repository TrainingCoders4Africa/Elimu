<center>
<table border="1" cellpadding="2" bordercolor="black" cellspacing="0" align="center">

  				 <tr bgcolor="white">
                    <th width="350"> Disciplines</th>
  				 	<th width="150">Niveau Etude</th>
  				 	<th width="100">Coéfficient</th>
                </tr>
				<tbody><tr>
				<?php
				$profile=$_SESSION["profil"];
				if($profile=="Administrateur"){
	$selection = findByAll('coefficients');
}
else{
	$selection = findByNValue('coefficients',"etude in(select libelle from etudes where etudes.cycle in(select cycle from fonction where profile='$profile'))");
}
              		while($row1 = mysql_fetch_row($selection))
				 	{
                       	$p1=$row1[1];//valeur du coefficient
						$p2=$row1[2];//code discipline
							$p3=$row1[3];// niveau etude
			$dis = explode("D", $p2);
			$iddis = $dis[0];
			$idsm=$dis[1];
					
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$discipline=$tit[1];
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$discipline.' : '.$sousd;
						else
						$affi=$discipline;
$t_etude = findByValue('etudes','idetude',$p3);
						$val_etude = mysql_fetch_row($t_etude);
						$niv=$val_etude[1];
						echo"<tr>
							<td  align=left>".($affi)."</td>
							<td  align=left>".$niv."</td>							
							<td  align=center>".$p1."</td>";
						
        			}
  				 ?>
</tr></tbody>
</table>
<BR>
