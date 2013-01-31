<?php
function separationord($page,$id,$table,$long){
$annee=annee_academique();
	 if(@($_GET[$id])=="")
	$compt=0;
	else
	$compt=$_GET[$id] ;
	
	if($compt==0)
	 $sql="select * from $table    limit $compt,".($long);
	else
	 $sql="select * from $table   limit ".($long+$long*($compt-1)).",".($long);
	
    return $sql;

}
function afficheseparationord($page,$id,$table,$compt,$cols,$long){
$annee=annee_academique();   
   $sql1="select * from $table ";
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
function affiche_professeur(){
 $annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
  $j=1;
   $exe=mysql_query(separationord("professeurs.php?vis=1&","compt","specialites",2));
  echo'<br><table border="0" cellpadding="0" cellspacing="5" width="800" BGcolore=yellow align=center>
       						';
					    while($row1=mysql_fetch_row($exe)) { 
						$b='';
						$matricule=$row1[1];
                          	$p2=$row1[2];
						$perso = findByValue('personnels','matricule',$matricule);
						$per = mysql_fetch_row($perso);
						$p3=$per[1];
						$prenom=$per[2]; 
						$nom=$per[3];
						$etag = findByValue('titre5','id',$p3);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];				
						$etagiaire = findByValue('fonction','personnel',$matricule);
						$champ = mysql_fetch_row($etagiaire);
						$matricule8=$champ[1];
						//specialité
						$etagiai = findByValue('disciplines','iddis',$p2);
						$cham = mysql_fetch_row($etagiai);
						$uv=$cham[1];

$etage = findByNValuelib('enseigner','classe',"personnel='$matricule' and discipline='$p2'");
						while($chae = mysql_fetch_row($etage)){
						$p=$chae[0];
						//liste des classes
						$t_classe = findByValue('classes','idclasse',$p);
						$chamcl = mysql_fetch_row($t_classe);
						$cl=$chamcl[3];
						
						$b=$b.' '.$cl;
						}
						
                              if($j==1)
							   echo"<tr>";
                             
						                                 $bgcolor="#00FF00";
							    echo'<td width="280" valign="top" HEIGHT=100%>
							    <table border="1" cellpadding="2" cellspacing="0"  bordercolor=white width="280" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolor="#CCFFFF">
							                      <div align="center" class="titre">Professeur '.$titre.' '.$prenom.' '.$nom;
							                  echo'    </div> </td></tr>
							       <tr>
							            <td  align="left" valign=top class=kc2 Bgcolor='.$bgcolor.'>
                                             <b><i><u>Discipline : </u></i></b>'.$uv.'
                                             <br><b><i><u>Classes Enseignées : </u></i></b>'.$b.'
                                             <br><b><i><u>Annee Académique : </u></i></b>'.$annee;
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
		afficheseparationord("professeurs.php?vis=1&","compt","specialites",@$_GET["compt"],1,2);
					    echo"
						</table>";

}
@affiche_professeur(0,2);
?>

