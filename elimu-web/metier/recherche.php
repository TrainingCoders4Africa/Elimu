<?php
//$datejour=date("Y")."-".date("m")."-".date("d");
 function separation_rech($id,$table,$where,$champord,$long){
	 if(@($_GET[$id])==""){
	$compt=0;
	}
	else{
	$compt=$_GET[$id] ;
	}
	if($compt==0){
	 $sql="select * from $table where $champord ='".$where."' order by $champord DESC limit $compt,".($long);
	 }
	else{
	 $sql="select * from $table where $champord ='".$where."' order by $champord DESC limit ".($long+$long*($compt-1)).",".($long);
	 }
	 //echo"<br>".$sql;
    return $sql;

}
function afficheseparation_rech($page,$id,$table,$where,$champord,$compt,$cols,$long){
    $sql1="select * from $table where $champord ='".$where."' order by $champord DESC ";
	$exe1=mysql_query($sql1) or die(mysql_error());
	$nb=mysql_num_rows($exe1);
	$nbpage=$nb/$long;
	    echo'<tr bgcolore=blue><td colspan='.$cols.' align=center>';
                   if($compt<>0){
                   echo'<a href="'.$page.''.$id.'='.($compt-1).'"> << Précédent</a>';
                   }
                   echo'&nbsp; &nbsp;';
                   if(($compt+1)<$nbpage AND $nbpage<>1){
                   echo'<a href="'.$page.''.$id.'='.($compt+1).'">Suivant >> </a></td>';
                   }

                   echo'</tr>';
}
function affiche_dossier($idrech){
$datejour=date("Y")."-".date("m")."-".date("d");
  $j=1;
   $exe=mysql_query(separation_rech("compt","personnels",$idrech,"matricule",6));
  echo'<table border="0" cellpadding="0" cellspacing="5" width="200" BGcolore=yellow>
       						';

					    while($row=mysql_fetch_row($exe)) { // lecture d'une entrée
					    //idDos  idPro theme reference idNat idCl idGest dateEnr

                           $matricule=$row[0];
                           $titre=$row[1];
					      $prenom=$row[2];

					      $nom=$row[3];
					      $matrimonial=$row[4];
					      $sexe=$row[5];
					      $date_nais=$row[6];
					      $lieu_nais=$row[7];
					      $tel=$row[8];
					      $adresse=$row[9];
					      $email=$row[10];
					      $photo=$row[11];
						  $enable=$row[12];	
						  $corps=$row[13];	
						  $grade=$row[14];	
						  $echelon=$row[15];	
						  $date_c=$row[16];
						  $anc=$datejour-$date_c;
						  $titres = findByValue('titre5','id',$titre);
						$tit = mysql_fetch_row($titres);
						$tre=$tit[1];
						//connaitre le corps
						  $cor = findByValue('corps5','id',$corps);
						$cr = mysql_fetch_row($cor);
						$crs=$cr[1];
						
						$nature = findByValue('fonction','personnel',$matricule);
						$entite = mysql_fetch_row($nature);
						$profile=$entite[1];
						

                              if($j==1){
							   echo"<tr>";
							   }
                               $bgcolor="#00FF00";
                                  //}
							    echo'<td width="220" valign="top" HEIGHT=100%>
							    <table border="1" cellpadding="2" cellspacing="0"  bordercolor=white width="220" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolor="#CCFFFF">
							                      <div align="center" class="titre">Matricule : '.
							                           $matricule.'
							                      </div>
							            </td>

							       </tr>
							       <tr>
							            <td  align="left" valign=top class=kc2 Bgcolor='.$bgcolor.'>
                                          <b><i><u>Personnel : </u></i></b>'.$tre.' '.$prenom.' '.$nom.'
                                             <br><b><i><u>Téléphone  : </u></i></b><a>'.$tel.'</a>'.'
                                             <br><b><i><u>E-mail : </u></i></b>'.$email.'
                                             <br><b><i><u>Adresse  : </u></i></b>'.$adresse.'
                                             <br><b><i><u>Corps : </u></i></b>'.$crs.'
                                             <br> <b><i><u>Anciénneté :</u></i></b> '.$anc.' ans
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
					   // closedir($dir); // fermeture du dossier
					    echo"</tr>";
						 //afficheseparation_rech($page,$id,$table,$where,$champord,$compt,$cols,$long)
		 afficheseparation_rech("personnels.php?vis=1&","compt","personnels",$idrech,"matricule",@$_GET["compt"],2,4);
					    echo"
						</table>";

}
function affiche_eleve(){
 $classe=$_GET["num"];
$mois=date("m");
$annee=date("Y");

 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
	//	echo "select * from eleves where matricule in(select eleve from inscription where annee='$aca' and classe='".htmlentities($idrech)."')";
$datejour=date("Y")."-".date("m")."-".date("d");
  $j=1;
   $exe=mysql_query("select * from eleves where matricule in(select eleve from inscription where annee='$aca' and classe='".htmlentities($classe)."')");
   //$exe=mysql_query("select * from eleves where matricule in(select eleve from inscription where annee='$annee' and classe='$idrech')");
  echo'<table border="0" cellpadding="0" cellspacing="5" width="300" BGcolore=yellow>
       						';

					    while($row=mysql_fetch_row($exe)) { // lecture d'une entrée
					    //idDos  idPro theme reference idNat idCl idGest dateEnr

                           $matricule=$row[0];
                           $prenom=$row[1];
					      $nom=$row[2];

					      $sex=$row[3];
					      $date_nais=$row[4];
					      $lieu_nais=$row[5];
					      $tuteur=$row[6];
					      $email_tuteur=$row[7];
					      $tel_tuteur=$row[8];
					      $tel_eleve=$row[9];
					      $email_eleve=$row[10];
					      $adresse=$row[11];
						  $photo=$row[12];	
						  $titres = findByValue('sexe5','id',$sex);
						$tit = mysql_fetch_row($titres);
						$sexe=$tit[1];	

                              if($j==1){
							   echo"<tr>";
							   }
                               $bgcolor="#00FF00";
                                  //}
							    echo'<td width="280" valign="top" HEIGHT=100%>
							    <table border="1" cellpadding="2" cellspacing="0"  bordercolor=white width="280" bgcolorE="red" HEIGHT=100%>
							       <tr>

							            <td  height="25" align="center" bgcolor="#CCFFFF">
							                      <div align="center" class="titre">Matricule : '.
							                           $matricule.'
							                      </div>
							            </td>

							       </tr>
							       <tr>
							            <td  align="left" valign=top class=kc2 Bgcolor='.$bgcolor.'>
                                          <b><i><u>Eléve : </u></i></b>'.$prenom.' '.$nom.'
                                             <br><b><i><u>Date & Lieu de Naissance   : </u></i></b>'.$date_nais.' à '.$lieu_nais.'</a>'.'
                                             <br><b><i><u>Tuteur : </u></i></b>'.$tuteur.'
                                             <br><b><i><u>Téléphone Tuteur  : </u></i></b>'.$tel_tuteur.'
                                             <br><b><i><u>Email_Tuteur : </u></i></b>'.$email_tuteur.'
                                             <br> <b><i><u>Adresse :</u></i></b> '.$adresse.'</td>';
											 
							    echo'   </tr>
								</table>
								</td>';
							      if($j==3){
							   		echo"</tr>";
							        $j=0;
							     }
							     $j++;

					    }
					   // closedir($dir); // fermeture du dossier
					    echo"</tr>";
						 //afficheseparation_rech($page,$id,$table,$where,$champord,$compt,$cols,$long)
		 //afficheseparation_rech("eleves.php?rech=1&","compt","eleves",$classe,"classe",@$_GET["compt"],3,6);
					    echo"
						</table>";
						}
  function recherche($table,$titre,$j,$sal){
    $req_champs="select* from ".$table;
  	$exe_req_champs=mysql_query($req_champs) or die("erreur selection");
    //echo $req_champs;
    if ($j=="ide") {
      echo"<form name='frm' action='verifuser.php?$j=sss&' onsubmit='return (conform(this));'   method='POST'>";
    }
    else {
     echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."&$j=sss' onsubmit='return (conform(this));'  enctype='multipart/form-data'   method='POST'>";
    }



  	$all_values="";
  	$i=0;
  	$mysss="";
  	$mynbt="";
  	echo"<table border=0 cellpadding=0 cellspacing=5>";
     while($row = mysql_fetch_field($exe_req_champs)){
     $result = mysql_query("SELECT $row->name FROM $table");
	 $length = mysql_field_len($result, 0) or die();
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
             echo"<input type='hidden' name='".$row->name."'";
                  }
           elseif($row->type=='string'){

            	if ($type=="numeric") {
            		//ECHO"deiee";
	           		echo "<tr>
	           		   <td>"
	           		   .str_replace("_"," ",$name).
	           		   "</td><td><input class='kc1' type=text name='".$row->name."' size='".$length."' value=''/></td></tr>";
	                  echo"
						 <script type=text/javascript>      //
		            			new SUC( document.frm.".$row->name.");       //
	    				</script>
						";
                }
	            elseif($type=="date") {
		            //echo "<tr><td>".str_replace("_"," ",$name)." </td><td> <input class=kc1 type=text name='".$row->name."' size='".$length."'  lange='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme' /></td></tr>";

                   	 echo "<tr><td align=right>".str_replace("_"," ",$name).' </td><td> ';
                   	 echo ' <input type="date" id="'.str_replace("_"," ",$name).'" name="'.$row->name.'" class="kc1" value=""  onfocus=view_microcal(true,"'.$row->name.'","microcal",-1,0); onblur=view_microcal(false,"'.$row->name.'","microcal",-1,0); onkeyup=this.style.color=testTypeDate(this.value)?"black":"red" size="15"
	                lange="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /> //'.date("Y-m-d").'
			        </td></tr> ';
	            }

	            elseif($type=="obligatoire") {


		             	 echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type=text name=".$row->name." size='".$length."'  lange='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire' /></td></tr>";


	            }
	            elseif($type=="file"){

							echo "<tr><td>".str_replace("_"," ",$name)."</td><td>


							<input class=kc1  id='".str_replace("_"," ",$name)."' type=file name='".$row->name."' size='".$length."' /></td></tr>";

	            }
	            elseif($type=="mail") {

                      echo "<tr><td>".str_replace("_"," ",$name).' </td><td> ';

	                echo ' <input value="" type="mail" id="'.str_replace("_"," ",$name).'" size="'.$length.'" name="'.$row->name.'" class="kc1"
	                lange="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: mail;erreur:Email non conforme" />
			   </td></tr> ';



	             //echo'<input class=kc1 type="text" name="'.$row->name.'"  size="'.$length.'" lange="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: date;erreur:Date non conforme" /></td></tr>';
	             $date_ref=$row->name;
	            }
	            elseif($type=="select"){
	            				if($row->name=="type_courrier5"){
								$tabsel="nature";	            				}

	                          else{	                          	 $tabsel=$name."5";	                          }
	                          $req_sel="select * from $tabsel" ;
	                          //echo "cc ".$tabsel;
	                          $eex=mysql_query($req_sel) or die(mysql_error());


	                         //ajouter par Wa_Darou


	                     echo "<tr><td> ".str_replace("_"," ",$name).'</td><td>
	                     <select class=mylistkc  id="'.str_replace("_"," ",$name).'" type="text" name="'.$row->name.'" size="1" langE="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire" />

	                     <option value=></option>
	                     ';
	                        while($ro=mysql_fetch_row($eex)){
	                            echo"<option value='".$ro[0]."' >".$ro[1]."</option>";
	                          }

	                     echo'
	                     </select>
	                     </td></tr>';

	               }
	            elseif($type=="password"){
     	          echo "<tr><td>".str_replace("_"," ",$name)."</td><td>  <input class='kc1' id='".str_replace("_"," ",$name)."' type='password' name=".$row->name." size='".$length."'  lange='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:Mot de Passe Obligatoire' /></td></tr>";

	            }
	            elseif ($type=="mask"){
	              echo"<input type=hidden name='".$row->name."'";
	            }
	            else{
		           	            	$na="$name";		          

		         
                    echo "<tr><td align=right>".str_replace("_"," ",$na).'</td><td>   ';
	           			echo'<input class=kc1 type=text name="'.$row->name.'" value="" size="'.$length.'" />';
	           		//}
	           		echo'</td></tr>';
	            }




           }
           elseif($row->type=='blob'){
             if($type=="obligatoire"){
               echo "<tr><td VALIGN='top'  align=right>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."'  id='".str_replace("_"," ",$name)."' langE='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;'  class=kc1 cols='70' rows='3'></textarea></td></tr>";
               }
             else{
               echo"<tr><td VALIGN='top' align=right>".str_replace("_"," ",$name)."</td><td>  <textarea name='".$row->name."'  class=kc1 cols='70' rows='3'></textarea></td></tr>";
               }
           }


            			if ($i==0) {
                              $all_values = $row->name;
		               }
		               else {
                         $all_values = $all_values.",".$row->name;
		               }
		               $i++;
    }

    echo'<tr><td>&nbsp; </td><td><input class=kc1 type="submit" value="Rechercher" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" /></table>
    ';
    //  </fieldset>
    echo'
  </form> ';
  if(@$_GET["rech"]!=""){

     //echo "sssm".$_GET["kct"];
        $ajout_uniq=0;
     $req_champs="select * from ".$table;
         $exe_req_champs=mysql_query($req_champs) or die(mysql_error());
         $ligchamps=mysql_fetch_row($exe_req_champs);
         $recup_champs="";
  		 $i=0;
         $recup_champspolice="";
                 $all_champs="";
                 $pos="";
                 $recupchp="";
         for($i=0;$i<mysql_num_fields($exe_req_champs);$i++)  {
          	       $pos=$pos;
          			  //echo "<br>".
          			  $colchamps  = mysql_field_name($exe_req_champs, $i);          		

                             if (@($_POST["".$colchamps.""])<>"" and $all_champs=="") {
		                              if (@($_POST["".$colchamps.""])<>"" and $colchamps<>'idDos') {
		                              $all_champs = $colchamps;
		                              $a=$colchamps{strlen($colchamps)-1};
		                             if($a==4) {
                                       $stock = getcwd();
                                       $dir=$stock."/allfichiers/";
                                       move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
                                         $recup_champs ="".addslashes($_FILES["$colchamps"]['name']);
                                       }
                                       else {
                                         $recup_champs = "".($_POST["$colchamps"]);
                                       }

		                              }
		                              elseif($colchamps=='idDos'){
		                              //	echo"touba";
		                              $all_champs="saliou";
		                              $recup_champs="";
		                              }

                             }
                             else {
                              if (@$_POST["".$colchamps.""]<>"" and $colchamps<>'idDos'){
                               $all_champs = $all_champs.",".$colchamps;
                               $a=$colchamps{strlen($colchamps)-1};
                                       /*if ($a==2 or $a==6) {
                                        $re=str_replace(".","/",$_POST["$colchamps"]);
                                        $recup_champs1 = str_replace("-","/",$re);
                                         $recup_champs = $recup_champs.",".$recup_champs1;
                                       }*/
                                       if ( $a==7){
                                        $recup_champs = $recup_champs."','".($_POST["$colchamps"]);
                                       }
                                       elseif($a==4) {
                                          $stock = getcwd();
                                          $dir=$stock."/allfichiers/";
                                          move_uploaded_file($_FILES["$colchamps"]['tmp_name'], $dir.$_FILES["$colchamps"]['name']);
                                          $recup_champs = $recup_champs."','".($_FILES["$colchamps"]['name']);

                                       }
                                       else {
                                          $recup_champs = $recup_champs.",".addslashes($_POST["$colchamps"]);

                                       }
                              }
                             }

  			}




$recup_champs="".$recup_champs."";

            $j=0;
            for ($i=0; $i<strlen($all_champs); $i++) {
                 $tab1=explode(",",$all_champs);
                 if(isset($tab1[$i])){
                     $j++;
                  }
            }
           // echo  "j : ".$j;
            $tab2=explode(",",$recup_champs);
            $where="";
            $chp="";
            for ($d=0; $d<$j - 1; $d++) {
                if($tab1[$d]<>"saliou" AND $tab2[$d]<>""){
              //echo"<br>$tab1[$d] JJJ $tab2[$d] ".
              $where=$where." ".$tab1[$d]." like '%".$tab2[$d]."%' AND ";
               }
            }

           // echo $d." :d<br>";
   if(isset($tab1[$d])){
	            if($tab1[$d]<>"saliou"){
	            $where=$where." ".$tab1[$d]." like '%".$tab2[$d];
	            }
        //  echo"<br>$tab1[$d] JJJ $tab2[$d] sal=$sal". $where;
		            if($sal==""){
		            $req_sel="select * from $table where ". $where."%' ";
			            if ($recupchp<>"") {
	                     $req_sel=$req_sel."  ".$recupchp;
		           		}
		            }
		            else{
		            $req_sel="select * from $table where ". $where."%' ";
		             if ($recupchp<>"") {
	                     $req_sel=$req_sel." and ".$recupchp." group by $sal";
		           	 }
		            }
	            if($tab1[$d]=="saliou" and $d==0){
	            	$req_sel="select * from suivi where ".$recupchp." group by $sal";
	            }



  			//echo "<br>".$req_sel;
  			echo '<div align="left" class="titr">Résutat(s) de la Recherche  pour  : '.$recup_champs.'</div>';
            //  echo"<br>$d sele $req_sel <br> ";
  			 $ex=mysql_query($req_sel) or die(mysql_error());

            if(mysql_num_rows($ex)!=0){
			     echo "<br>Nombre d'occurences trouvées : ".mysql_num_rows($ex);
			     echo"<table width=200 bordercolor=black border=2 cellspacing=5 cellpadding=3 HEIGHT=100%>";
			     $doc=0;
			         while($row=mysql_fetch_row($ex)){
			          if($doc==0){
			          echo "<tr>";
			          }
			          echo"<td bgcolore=white WIDTH=280 HEIGHT=100% valign=top>";
			         	 if($table=="personnels"){
				         	//echo "<br>idDos". $row[0];
//echo separation_rech("personnels.php?vis=1&","compt","personnels",$row[0],"matricule",6);
	                        affiche_dossier($row[0]);

	                        echo'
                             <div align="center"><a href="?mod=1&upd='.$row[0].'" class=imp>Modifier</a> &nbsp;&nbsp;';
							 if(@$_GET["sup"]<>""){
							 echo'
                             <a href="?sup=1&del='.$row[0].'" class=imp>Supprimer</a></div>
	                        </td>';
							}
			         	}
			         	elseif($table=="suivi"){
				         	//echo "<br>idsuivi". $row[0];
                             // rappel_suivi("suivi","rech",$row[0]);
	                        //affiche_dossier($row[0]);

	                      /*  echo'
                             <div align="center"><a href="?mod=1&idsuivi='.$row[0].'" class=imp>Modifier</a> &nbsp;&nbsp;
                             <a href="?sup=1&idsuivi='.$row[0].'" class=imp>Supprimer</a></div>
	                        </td>';*/
			         	}
			         	elseif($table=="user"){
                            echo'<SPAN style="border:solid 1px black; background:white;padding-left:10px; width:200; display:block;">
                            <table>
                             <tr><td><b><i>Nom :</i></b> </td><td>'.$row[1].'</td></tr>
                             <tr><td><b><i>Prénom :</i></b> </td><td>'.$row[2].'</td></tr>
                             <tr><td><b><i>Fonction :</i></b> </td><td>'.$row[3].'</td></tr> ';
                             echo'</table>

                            <div align="center"><a href="?mod=1&iduser='.$row[0].'" class=imp>Modifier</a> &nbsp;&nbsp;
                             <a href="?sup=1&iduser='.$row[0].'" class=imp>Supprimer</a></div>
                             </span>
	                        </td>';
			         	}
			         	elseif($table=="eleves"){
						 $classe=$_GET["num"];
						//'".htmlentities($sclasse)."'
			         		echo'<SPAN style="border:solid 1px black; background:white;padding-left:10px; width:400; display:block;">
                            <table width=600>
                             <tr><td><b><i>Eléve :</i></b> '.$row[1].' '.$row[2].'</td></tr>
                             <tr><td><b><i>Date & Lieu de Naissance :</i></b> '.$row[4].' à '.$row[5].'</td></tr>
                             <tr><td><b><i>Tuteur :</i></b>'.$row[6].'</td></tr>
                             <tr><td><b><i>Téléphone Tuteur :</i></b> '.$row[8].'</td></tr>
                             <tr><td><b><i>E-mail Tuteur : </i></b>'.$row[7].'</td></tr>
                             <tr><td><b><i>Adresse :</i></b> '.$row[11].'</td></tr> ';
                             echo'</table>

                            <div align="center"><a href="?mod=1&eleve='.$row[0].'&num='.$classe.'" class=imp>Modifier</a> &nbsp;&nbsp';
							 if(@$_GET["sup"]<>""){
							 echo'
                             <a href="?sup=1&del='.$row[0].'" class=imp>Supprimer</a></div>
	                        ';
							}
                             echo'
                             </span>
	                        </td>';
							
		 afficheseparation_rech("eleves.php?vis=1&","compt","eleves","","matricule",@$_GET["compt"],0,2);
			         	}
 elseif($table=="eleves1"){
 $classe=$_GET["num"];
				         	//echo "<br>idDos". $row[0];
//echo separation_rech("personnels.php?vis=1&","compt","personnels",$row[0],"matricule",6);
	                        affiche_eleve();

	                        echo'
                          <div align="center"><a href="?mod=1&eleve='.$row[0].'&num='.$classe.'" class=imp>Modifier</a> &nbsp;&nbsp';
							 if(@$_GET["sup"]<>""){
							 echo'
                             <a href="?sup=1&del='.$row[0].'" class=imp>Supprimer</a></div>
	                        </td>';
							}
			         	}
			         	if($doc==2){
	                        	echo"</tr>";
	                        	$doc=-1;
                        }
                        $doc++;

			         }

			     echo" </tr></table>";

				}
				else{
				echo"Aucun Résultat";

				}

     }





				// return  $ajout_uniq;
   }
  }
  if($rechtab=="personnels"){
 recherche("personnels","Recherche Personnel","rech","");
 }
 elseif($rechtab=="eleves"){
 recherche("eleves","Recherche eleves","rech","");
 }
 elseif($rechtab=="user"){
 recherche("user","Recherche Utilisateur","rech","");
 }
 elseif($rechtab=="disciplines"){
 recherche("gestionnaire","Recherche Gestionnaire","rech","");
 }


?>
