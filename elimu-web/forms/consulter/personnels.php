<?php
function separationord($page,$id,$table,$champord,$long){
	 if(@(securite_bdd($_GET[$id]))=="")
	$compt=0;
	else
	$compt=securite_bdd($_GET[$id]) ;
	
	if($compt==0)
	 $sql="select * from $table  where enable8='1' order by $champord  limit $compt,".($long);
	else
	 $sql="select * from $table where enable8='1' order by $champord  limit ".($long+$long*($compt-1)).",".($long);
	    return $sql;

}
function afficheseparationord($page,$id,$table,$champord,$compt,$cols,$long){
    $sql1="select * from $table where enable8='1' order by $champord ";
	$exe1=mysql_query($sql1) or die(mysql_error());
	$nb=mysql_num_rows($exe1);
	$nbpage=$nb/$long;
	    echo'<tr bgcolore=blue><td colspan='.$cols.' align=center>';
                   if($compt<>0)
                   echo'<a href="'.$page.''.$id.'='.($compt-1).'"> << Précédent</a>';
                   echo'&nbsp; &nbsp;';
                   if(($compt+1)<$nbpage AND $nbpage<>1)
                   echo'<a href="'.$page.''.$id.'='.($compt+1).'">Suivant >> </a></td>';

                   echo'</tr>';
}
function affiche_personnel(){
$datejour=date("Y")."-".date("m")."-".date("d");
  $j=1;
   $exe=mysql_query(separationord("personnels.php?vis=1&","compt","personnels","nom",2));
  echo'<br><table border="0" cellpadding="0" cellspacing="5" width="800" BGcolore=yellow align=center>
       						';

					    while($row1=mysql_fetch_row($exe)) { 
                          	$matricule=$row1[0];
						$p2=$row1[1];
						$etag = findByValue('titre5','id',$p2);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
						$prenom=htmlentities($row1[2]);
						$nom=htmlentities($row1[3]);
						$tel=$row1[8];
						$adresse=htmlentities($row1[9]);
						$email=$row1[10];
						$matricule6=$row1[16];
						$ans=$datejour-$matricule6;						
						$etagiaire = findByValue('fonction','personnel',$matricule);
						$champ = mysql_fetch_row($etagiaire);
						$fonction=$champ[1];

                              if($j==1)
							   echo"<tr>";
                             
						                                 $bgcolor="#00FF00";
							    echo'<td width="280" valign="top" HEIGHT=100%>
							    <table border="1" cellpadding="2" cellspacing="0"  bordercolor=white width="280" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolor="#CCFFFF">
							                      <div align="center" class="titre">Matricule '.
							                           $matricule.'
							                      </div>
							            </td>

							       </tr>
							       <tr>
							            <td  align="left" valign=top class=kc2 Bgcolor='.$bgcolor.'>
                                             <b><i><u>Personnel : </u></i></b>'.$titre.' '.$prenom.' ' .$nom.'
                                             <br><b><i><u>Téléphone : </u></i></b>'.$tel.'
                                             <br><b><i><u>E-mail  : </u></i></b>'.$email.'
                                             <br><b><i><u>Adresse : </u></i></b>'.$adresse.'
                                             <br><b><i><u>Fonction  : </u></i></b>'.$fonction.'
                                             <br><b><i><u>Anciéneté : </u></i></b>'.$ans.' ans';
                                                                      echo'
							            </td>

							       </tr>
								</table>
								</td>';
							      if($j==3){
							   		echo"</tr>";
							        $j=0;
							     }
							     $j++;


					    }
					    echo"</tr>";
		afficheseparationord("personnels.php?vis=1&","compt","personnels","nom",@$_GET["compt"],1,2);
					    echo"
						</table>";

}
@affiche_personnel(0,2);
?>

