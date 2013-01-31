<?php
function separation_tab($page,$id,$table,$champord,$long){
	 if(@($_GET[$id])=="")
	$compt=0;
	else
	$compt=$_GET[$id] ;
	/*if($compt==0)
	 $sql="select * from $table order by $champord DESC limit $compt,".($long);
	else
	 $sql="select * from $table order by $champord DESC limit ".($long+$long*($compt-1)).",".($long);
	 //echo"<br>".$sql;
	 */

	if(isset($_SESSION["zone"])){
      if($compt==0)
	 $sql="select * from $table where departement5=".$_SESSION["zone"]." order by $champord DESC limit $compt,".($long);
	else
	 $sql="select * from $table where departement5=".$_SESSION["zone"]." order by $champord DESC limit ".($long+$long*($compt-1)).",".($long);
	}
	else{
	if($compt==0)
	 $sql="select * from $table order by $champord DESC limit $compt,".($long);
	else
	 $sql="select * from $table order by $champord DESC limit ".($long+$long*($compt-1)).",".($long);
	}
   // echo $sql;
    return $sql;

	}
function afficheseparation_tab($page,$id,$table,$champord,$compt,$cols,$long){
	    $sql1="select * from $table order by $champord DESC ";
		$exe1=mysql_query($sql1) or die(mysql_error());
		$nb=mysql_num_rows($exe1);
		$nbpage=$nb/$long;
		    echo'<tr bgcolore=blue><td colspan='.$cols.' align=center>';
	                   if($compt<>0)
	                   echo'<a href="'.$page.'&'.$id.'='.($compt-1).'"> <img src="parametrage/images/prec.jpg" alt="" border="0"></a>';
	                   echo'&nbsp; &nbsp;';
	                   if(($compt+1)<$nbpage AND $nbpage<>1)
	                   echo'<a href="'.$page.'&'.$id.'='.($compt+1).'"><img src="parametrage/images/suiv.jpg"  alt="" border="0"> </a></td>';

	                   echo'</tr>';
	}
function affiche($table,$titre,$champ,$page,$long,$lien){

    if(@($_GET["compt"])=="")
	$compt=0;
	else
	$compt=$_GET["compt"] ;
  	$req_champs=separation_tab($page,"compt",$table,$champ,$long);
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
  	echo '
  	<div class="titre" bgcolor=green width=200 style="padding-left:50px;">'.$titre.'</div>';
  	echo"<table border=1 bordercolor='lightsteelblue' width='90%' cellpadding=5 cellspacing=0 align=center>
  	<tr bgcolor='blue'>";
  	if(@$_GET["idsuivi"]==""){
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


            		//ECHO"deiee";
            		if($a!=5){
	           		echo "<th>"
	           		   .str_replace("_"," ",$name).
	           		   "</th>";
	           	     }
	           	    else
	           	    $mz=$z;



           }
           elseif($row->type=='blob'){
               echo "<th width=300>".str_replace("_"," ",$name)."</th>";
           }

    }
       IF($lien<>"")
    	echo"<th align=center>Action</th>";
    while($ligne=mysql_fetch_array($exe_req_champs)){

    	echo"</tr><tr bgcolor='#F2FFFF'>";
    	   if($rw==""){
    	   	 for($i=0;$i<mysql_num_fields($exe_req_champs);$i++){
    	   	    if($i!=($mz-1))
    	   	 	echo"<td>$ligne[$i]</td>";
    	   	 }

    	   }
    	   else{
    	   	 for($i=1;$i<mysql_num_fields($exe_req_champs);$i++){    	   	 	if($i!=($mz-1))
    	   	 	echo"<td >$ligne[$i]</td>";
    	   	 }
    	   	 IF($lien=="mod")
    	   	 echo"<td><a href='?mod=1&upd=$ligne[0]' class=bg>Modifier</a></td>";
    	   	 elseIF($lien=="sup")
    	   	 echo"<td><a href='?sup=1&del=$ligne[0]' class=bg>Modifier</a></td>";
    	   }
    	   echo"</tr>";

    }

     afficheseparation_tab($page,"compt",$table,$champ,@$_GET["compt"],$nblig,$long);
     }
    else{

    }
    echo"</table>";
}
 function affiche_tb($table,$champ,$code,$mod){
    if($mod!="")
    echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."?id=0' onsubmit='return (conform(this));'   enctype='multipart/form-data'  method='POST'>";

    //echo"<br />select * from $table where $champ=".$code."";
    $f=0;
    $recupchp=array();
    $exe=mysql_query("select * from $table where $champ='".$code."'");
    $exe1 =mysql_query("select * from $table where $champ='".$code."'");
//    echo mysql_num_rows($exe);
    $ligne=mysql_fetch_array($exe1);
     echo'<table border="0" cellpadding="5" cellspacing="0" width="450" BGcolor=White>';    while($row = mysql_fetch_field($exe)){
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


           echo"<tr>";
           if($row->type=='int'){
           $rw=1;
           }
           elseif($row->type=='string'){

                      if(isset($_SESSION["zone"]) AND $a!=5){
            		//ECHO"deiee";
	           		echo "<td>"
	           		   .str_replace("_"," ",$name).
	           		   "</td>";


	           		   if ($mod=="") {
		                 echo "<td>"
			           		   .$ligne[$f].
			           		   "</td>";
		               }
		               else {
		                    echo "<td><input class='kc1' type=text name='".$row->name."' size='".$length."' value='".$ligne[$f]."'/></td>";
		               }
                      }


           }
           elseif($row->type=='blob'){
               echo "<td>".str_replace("_"," ",$name)."</td>";
               if ($mod=="") {
                 echo "<td>"
	           		   .$ligne[$f].
	           		   "</td>";
               }
               else {
                echo "<td><input class='kc1' type=text name='".$row->name."' size='".$length."' value='".$ligne[$f]."'/></td>";
               }

           }
           $recupchp[$f]=$row->name;
          echo"</tr>";
           $f++;
    }

       if($mod!="")
       echo"<tr><td colspan=2 align=center> <input type='submit' name='valider' value='Modifier'></td></tr>";
     echo"</table>";
     if(isset($_POST["valider"])){
     $kn=$f-1;
     $rslt="";
      for ($i=0; $i<$f; $i++) {
        if(@$_POST[$recupchp[$i]]<>"" AND $kn!=$i)
          $rslt.="$recupchp[$i] = '".$_POST[$recupchp[$i]]."',";
        elseif($kn==$i)
          $rslt.="$recupchp[$i] = '".$_POST[$recupchp[$i]]."'";
      }     //echo $rslt;
     //echo "<br>".
     $req="update $table set ".$rslt." where $champ=".$code;
     $exe=mysql_query($req) or die(mysql_error());
     if($exe){
     echo"<table><tr><td bgcolor='red'>Modification Réussie</td></tr></table>";
     echo "<meta http-equiv=\"refresh\" content=\"0;url=?&vis=1\">";
     }     }    }

?>