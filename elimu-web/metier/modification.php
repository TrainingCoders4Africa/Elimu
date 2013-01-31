<?php

function separation_dos($page,$id,$table,$champord,$long){
	 if(@($_GET[$id])==""){
	$compt=0;
	}
	else {
	$compt=$_GET[$id] ;
	}
	if($compt==0){
	 $sql="select * from $table order by $champord DESC limit $compt,".($long);
	 }
	else{
	 $sql="select * from $table order by $champord DESC limit ".($long+$long*($compt-1)).",".($long);
	 }
	//}
   // echo $sql;
    return $sql;

	}
function afficheseparation_dos($page,$id,$table,$champord,$compt,$cols,$long){
	    $sql1="select * from $table order by $champord DESC ";
		$exe1=mysql_query($sql1) or die(mysql_error());
		$nb=mysql_num_rows($exe1);
		$nbpage=$nb/$long;
		    echo'<tr bgcolore=blue><td colspan='.$cols.' align=center>';
	                   if($compt<>0){
	                   echo'<a href="'.$page.'&'.$id.'='.($compt-1).'"> <<<<</a>';
	                   }
	                   echo'&nbsp; &nbsp;';
	                   if(($compt+1)<$nbpage AND $nbpage<>1){
	                   echo'<a href="'.$page.'&'.$id.'='.($compt+1).'">>>>>> </a></td>';
	                   }

	                   echo'</tr>';
	}
function affichedos($table,$titre,$champ,$page,$long,$lien){

    if(@($_GET["compt"])==""){
	$compt=0;
	}
	else {
	$compt=$_GET["compt"] ;
	}
  	$req_champs=separation_dos($page,"compt",$table,$champ,$long);
  	//echo $req_champs;
  	$exe_req_champs=mysql_query($req_champs) or die(mysql_error());
    //echo $req_champs;
     $nblig=mysql_num_fields($exe_req_champs);
  	$all_values="";
  	$i=0;
  	$mysss="";
  	$rw="";
  	$mz="";
     //ECHO @$_POST["sss"];
  	echo '<div class="titre" bgcolor=green width=200 style="padding-left:50px;">'.$titre.'</div>';
  	echo"<table border=1 bordercolor='white' bgcolor=white width='100%' cellpadding=2 cellspacing=0 align=center>
  	<tr bgcolor='blue'>";
  	if(@$_GET["upd"]=="" AND @$_GET["del"]=="" ){
  	 $z=0;

     while($row = mysql_fetch_field($exe_req_champs)){
     $z++;
     $result = mysql_query("SELECT $row->name FROM $table");
	 $length = mysql_field_len($result, 0);
	 //echo $length;
       $len=strlen($row->name);
       $en=$row->name;

       $n1=substr($row->name,0,1);
        $a=$en{$len-1};
        //echo"a = $a <br>";
        $type="";

        			//  if(is_numeric($a)) {
          $name=substr($row->name,0,$len);
                            if($a==1) {
                                 $type="obligatoire";
                                 $name=substr($row->name,0,$len-1);
                      		}
                      		elseif($a==2) 	{
								$type="date";
								$name=substr($row->name,0,$len-1);

                            }
                            elseif($a==3) 	{
								$type="numeric";
								$name=substr($row->name,0,$len-1);
                            }
                            elseif($a==4) 	{
								$type="file";
								$name=substr($row->name,0,$len-1);
                            }
                            elseif($a==5) 	{
									$type="select";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==6) 	{
									$type="mail";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==7) 	{
									$type="password";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==8) 	{
									$type="mask";
									$name=substr($row->name,0,$len-1);

	        				}



           if($row->type=='int'){
           $rw=1;
           }
           elseif($row->type=='string'){
                        if ($row->name=='type_courrier5') {
                         $name='Type Courrier';
                        }
                        elseif($row->name=='idCl') {
                         $name='Classeur';
                        }
                        elseif($row->name=='idGest') {
                         $name='Gestionnaire';
                        }


                    	echo "<th class='kc1'>"
	           		   .str_replace("_"," ",$name).
	           		   "</th>";
            		//ECHO"deiee";
            		if($a!=5){

	           	     }
	           	    else{
	           	    $mz=$z;
	           	    }



           }
           elseif($row->type=='blob'){
               echo "<th class='kc1'>".str_replace("_"," ",$name)."</th>";
           }

    }
       IF($lien<>"")  {
    	echo"<th align=center  class='kc1'>Action</th>";
    	}
    while($ligne=mysql_fetch_array($exe_req_champs)){

    	echo"</tr><tr bgcolor='#F2FFFF'>";
    	   if($rw==""){
    	   	 for($i=0;$i<mysql_num_fields($exe_req_champs);$i++){
    	   	   // if($i!=($mz-1))
    	   	 	echo"<td  class='kc1'>s $ligne[$i]</td>";
    	   	 }

    	   }
    	   else{
    	   	 for($i=1;$i<mysql_num_fields($exe_req_champs);$i++){
    	   	 	//if($i!=($mz-1))
				 if (($i==1) and ($table=='credit_horaire')) {
                   $rws=mysql_fetch_array(mysql_query("select * from disciplines where iddis='".$ligne[$i]."'"));
                   $ligne[$i]=$rws[1];
		           }
				   if (($i==4) and ($table=='credit_horaire')) {
                   $rwse=mysql_fetch_array(mysql_query("select * from etudes where idetude='".$ligne[$i]."'"));
                   $ligne[$i]=$rwse[1];
		           }
				   if (($i==5) and ($table=='credit_horaire')) {
                   $rwse=mysql_fetch_array(mysql_query("select * from nature where idnature='".$ligne[$i]."'"));
                   $ligne[$i]=$rwse[1];
		           }
				 if (($i==2) and ($table=='coefficients')) {
                 $dis = explode("D", $ligne[$i]);
			$iddis = $dis[0];
			$idsm=$dis[1];
				$titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$discipline=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")
						$affi=$discipline.' : '.$sousd;
						else
						$affi=$discipline;
						
                   $ligne[$i]=$affi;
		           }
    	   	 	   if (($i==3) and ($table=='coefficients')) {
                   $rwse=mysql_fetch_array(mysql_query("select * from etudes where idetude='".$ligne[$i]."'"));
                   $ligne[$i]=$rwse[1];
		           }

    	   	 	echo"<td  class='kc2'>  $ligne[$i]</td>";
    	   	 }
    	   	 IF($lien=="mod"){
    	   	 echo"<td  class='kc1'><a href='?mod=1&upd=$ligne[0]' class=bg>Modifier</a></td>";
    	   	 }
    	   	 elseIF($lien=="sup"){
    	   	 echo"<td  class='kc1'><a href='?sup=1&del=$ligne[0]' class=bg>Supprimer</a></td>";
    	   	 }
    	   }
    	   echo"</tr>";

    }

     afficheseparation_dos($page,"compt",$table,$champ,@$_GET["compt"],$nblig,$long);
    }
    elseif(@$_GET["upd"]<>""){
    affiche_doss($table,$champ,$_GET["upd"],"mod");
    }
    elseif(@$_GET["del"]<>""){
    //echo"touba";
	   affiche_doss($table,$champ,$_GET["upd"],"mod");
    //affiche_doss($table,$champ,$_GET["del"],"sup");
    }
    echo"</table>";
}
function affiche_doss($table,$champ,$code,$mod){

    if($mod!="")
    echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."&id=0' onsubmit='return (conform(this));'   enctype='multipart/form-data'  method='POST'>";
    //echo"<br />select * from $table where $champ=".$code."";
     
    $f=0;
    $recupchp=array();

    $exe=mysql_query("select * from $table where $champ='".$code."'");
    $exe1 =mysql_query("select * from $table where $champ='".$code."'");
//    echo mysql_num_rows($exe);
    $ligne=mysql_fetch_array($exe1);
     echo'<table border="0" cellpadding="3" cellspacing="0" width="600" BGcolor=White>';
    while($row = mysql_fetch_field($exe)){
     $result = mysql_query("SELECT $row->name FROM $table");
	 $length = mysql_field_len($result, 0);
	 //echo $length;
       $len=strlen($row->name);
       $en=$row->name;

       $n1=substr($row->name,0,1);
        $a=$en{$len-1};
        //echo"a = $a <br>";
        $type="";

        			//  if(is_numeric($a)) {
          $name=substr($row->name,0,$len);
                            if($a==1) {
                                 $type="obligatoire";
                                 $name=substr($row->name,0,$len-1);
                      		}
                      		elseif($a==2) 	{
								$type="date";
								$name=substr($row->name,0,$len-1);

                            }
                            elseif($a==3) 	{
								$type="numeric";
								$name=substr($row->name,0,$len-1);
                            }
                            elseif($a==4) 	{
								$type="file";
								$name=substr($row->name,0,$len-1);
                            }
                            elseif($a==5) 	{
									$type="select";
									$name=substr($row->name,0,$len-1);


	        				}
	        				elseif($a==6) 	{
									$type="mail";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==7) 	{
									$type="password";
									$name=substr($row->name,0,$len-1);

	        				}
	        				elseif($a==8) 	{
									$type="mask";
									$name=substr($row->name,0,$len-1);

	        				}
             if($mod=="mod"){

          // echo"<tr>";
	           if($row->type=='int'){
	           $rw=1;
	           }
	           elseif($row->type=='string'){

	           			  if ($row->name=="emetteur" or $row->name=="expediteur") {	           			  	if($ligne[$f]<>""){
	                           echo " <tr><td id=zone colspan=2><table width=550><tr><td width=200 align=right>"
		           		   .str_replace("_"," ",$name).
		           		   "</td><td>";
		           		   echo"<input type=text name='$row->name' value='".$ligne[$f]."' size=42></td></tr></table></td></tr>";
		           		   }
			              }
			              else {


	                           echo "<tr><td width=200 align='right'>";
                             if ($name=="idCl") {
                             echo "Classeur";
                             }
                             elseif ($name=="idGest") {
                              echo "Gestionnaire";
                             }
                             else {
                               echo str_replace("_"," ",$name);
                             }


		           		   echo
		           		   "</td>";

			                 echo "<td>";
			                 if(isset($_GET["upd"])) {
			                 	if ($row->name=="type_courrier5") {
			                 	$rs=mysql_fetch_array(mysql_query("select * from nature where idNat='".$ligne[$f]."'"));
	                              echo'<select size="1" name="'.$row->name.'" class=mylistkc> ';
	                                echo '<option value="'.$ligne[$f].'">'.$rs[1].'</option>';
	                                $exreq=mysql_query("select * from nature");
	                               while($rs=mysql_fetch_array($exreq)){
	                                     if($ligne[$f]!=$rs[0]){	                                    echo '<option value="'.$rs[0].'">'.$rs[1].'</option>';
	                                    }	                               }
												echo'</select>';
			                    }
			                    elseif ($row->name=="idCl") {
			                    $rs=mysql_fetch_array(mysql_query("select * from classeur where idCl='".$ligne[$f]."'")) ;
	                              echo'<select size="1" name="'.$row->name.'" class=mylistkc> ';

								  echo '<option value="'.$ligne[$f].'">'.$rs[2].'</option>';
								   $exreq=mysql_query("select * from classeur");
	                               while($rs=mysql_fetch_array($exreq)){
	                                     if($ligne[$f]!=$rs[0]){
	                                    echo '<option value="'.$rs[0].'">'.$rs[2].'</option>';
	                                    }
	                               }

												echo'</select>';
			                    }
			                    elseif ($row->name=="idGest") {
			                    $rs=mysql_fetch_array(mysql_query("select * from gestionnaire where idGest='".$ligne[$f]."'"));
			                    $rs1=mysql_fetch_array(mysql_query("select * from departement5 where idDep='".$rs[5]."'"));
	                              echo'<select size="1" name="'.$row->name.'" class=mylistkc> ';
									  echo '<option value="'.$ligne[$f].'">'.$rs[1].' - '.$rs[2].'['.$rs1[1].']</option>';
									$exreq=mysql_query("select * from gestionnaire");
	                               while($rs=mysql_fetch_array($exreq)){
	                                     if($ligne[$f]!=$rs[0]){
	                                    echo '<option value="'.$rs[0].'">'.$rs[1].' - '.$rs[2].'['.$rs1[1].']</option>';
	                                    }
	                               }

												echo'</select>';
			                    }
			                    elseif ($row->name=="courrie"){	                              echo'<select size="1" name="courrie" class=mylistkc onchange="submitForm()"> ';
									  echo '<option value="'.$ligne[$f].'">'.$ligne[$f].'</option>';
									  if ($ligne[$f]=="depart") {
	                                    echo '<option value="arrivee">Arrivée</option>';
							          }
							          elseif($ligne[$f]=="arrivee") {
	                                     echo '<option value="depart">Départ</option>';
							          }
									  echo'</select>';			                    }
	                            elseif ($row->name=="date_limite"){	                                if ($ligne[$f]<>"") {
	                                  echo'<input name="'.$row->name.'" type="checkbox" value="ON" checked>';
	                                }
	                                else {
	                                  echo'<input name="'.$row->name.'" type="checkbox" value="ON">';
	                                }	                            }
	                      		else{
				           		   echo"<input type=text name='$row->name' value='".$ligne[$f]."' size=42>";
				       			}
				           	 }
				             else{
				             echo "".$ligne[$f];
				             }
	                        echo "</td></tr>";

	                        if($row->name=="idGest"){	                        	//echo"<tr><td>Fichier</td>";
	                        	if(existefichier($ligne[0],"documents/$ligne[0]","")<>""){
									echo'
									   <tr>
									<td  align=right>Fichier </td>
									<td class=kc2>'
						               .existefichier($ligne[0],"documents/$ligne[0]","").
									'</td>
								</tr>';
								}
								echo'
								  <tr>
									<td  align=right>Modifier PJ</td>
									<td class=kc2><input name="mpj'.$ligne[0].'" type="file" >
									</td>
								</tr>
									';	                        }
			              }

	            		//ECHO"deiee";






	           }
	           elseif($row->type=='blob'){
	               echo "<tr><td  align='right'>".str_replace("_"," ",$name)."</td>";

	                 echo "<td><textarea rows=5 name='$row->name' cols=20>"
		           		   .$ligne[$f].
		           		   "</textarea></td></tr>";


	           }

            }
              elseif($mod=='sup'){
               /* echo " <tr><td>"
		           		   .str_replace("_"," ",$name).
		           		   "</td><td>";
		           		   echo $ligne[$f]."</td></tr>"; */
		           if($row->type=='int'){
	           $rw=1;
	           }
		           elseif($row->type=='string'){

		           			  if ($row->name=="emetteur" or $row->name=="expediteur") {
		           			  	if($ligne[$f]<>""){
		                           echo " <tr><td id=zone colspan=2><table BGCOLOR=RED width=550><tr><td width=200 align=right>"
			           		   .str_replace("_"," ",$name).
			           		   "</td><td>";
			           		   echo $ligne[$f]."</td></tr></table></td></tr>";
			           		   }

				              }
				              else {


		                           echo "<tr><td width=200 align='right'>";
	                             if ($name=="idCl") {
	                             echo "Classeur";
	                             }
	                             elseif ($name=="idGest") {
	                              echo "Gestionnaire";
	                             }
	                             else {
	                               echo str_replace("_"," ",$name);
	                             }


			           		   echo
			           		   "</td>";

				                 echo "<td>";
				                 if(isset($_GET["del"])) {
				                 	if ($row->name=="type_courrier5") {
				                 	$rs=mysql_fetch_array(mysql_query("select * from nature where idNat='".$ligne[$f]."'"));
		                                echo ''.$rs[1].'';

				                    }
				                    elseif ($row->name=="idCl") {
				                    $rs=mysql_fetch_array(mysql_query("select * from classeur where idCl='".$ligne[$f]."'")) ;
									  echo $rs[2];
				                    }
				                    elseif ($row->name=="idGest") {
				                    $rs=mysql_fetch_array(mysql_query("select * from gestionnaire where idGest='".$ligne[$f]."'"));
				                    $rs1=mysql_fetch_array(mysql_query("select * from departement5 where idDep='".$rs[5]."'"));
										  echo $rs[1].' - '.$rs[2].'['.$rs1[1].']';
				                    }
				                    elseif ($row->name=="courrie"){
										  echo $ligne[$f];
				                    }
		                            elseif ($row->name=="date_limite"){
		                                if ($ligne[$f]<>"") {
		                                  echo'<input name="'.$row->name.'" type="checkbox" value="ON" checked>';
		                                }
		                                else {
		                                  echo'<input name="'.$row->name.'" type="checkbox" value="ON">';
		                                }
		                            }
		                      		else{
					           		   echo"<input type=text name='$row->name' value='".$ligne[$f]."' size=42>";
					       			}
					           	 }
					             else{
					             echo "".$ligne[$f];
					             }
		                        echo "</td></tr>";

		                        if($row->name=="idGest"){
		                        	//echo"<tr><td>Fichier</td>";
		                        	if(existefichier($ligne[0],"documents/$ligne[0]","")<>""){
										echo'
										   <tr>
										<td  align=right>Fichier </td>
										<td class=kc2>'
							               .existefichier($ligne[0],"documents/$ligne[0]","").
										'</td>
									</tr>';
									}
		                        }
				              }

		            		//ECHO"deiee";






		           }
		           elseif($row->type=='blob'){
		               echo "<tr><td  align='right'>".str_replace("_"," ",$name)."</td>";

		                 echo "<td><textarea rows=5 name='$row->name' cols=20>"
			           		   .$ligne[$f].
			           		   "</textarea></td></tr>";


		           }


              }
               $recupchp[$f]=$row->name;

	           $f++;
    }

       if($mod=="mod"){
       echo"<tr><td colspan=2 align=center> <input type='submit' name='valider' value='Modifier'></td></tr>";
       }
       elseif($mod=="sup"){
       echo"<tr><td colspan=2 align=center> <input type='submit' name='supprimer' value='Supprimer'></td></tr>";
       }
     echo"</table>";
   //  echo ($_POST["valider"]);
     if(isset($_POST["valider"])){
     $kn=$f-1;
     $rslt="";
     //echo $code;
      echo $pj=movefichier("mpj".$code,$code);
      for ($i=0; $i<$f; $i++) {
        if(@$_POST[$recupchp[$i]]<>"" AND $kn!=$i)
          $rslt.="$recupchp[$i] = '".$_POST[$recupchp[$i]]."',";
        elseif($kn==$i)
          $rslt.="$recupchp[$i] = '".$_POST[$recupchp[$i]]."'";
      }
     //echo $rslt;
     //echo "<br>".
     echo $req="update $table set ".$rslt." where $champ='".$code."'";
     $exe=mysql_query($req) or die(mysql_error());
     if($exe){
     echo"<table><tr><td bgcolor='red'>sss Modification Réussie</td></tr></table>";
    // echo "<meta http-equiv=\"refresh\" content=\"0;url=?&vis=1\">";
     } /* */
     }
     elseif(isset($_POST["supprimer"])){      echo $req="delete from $table where $champ='".$code."'";     }
    }
	
	