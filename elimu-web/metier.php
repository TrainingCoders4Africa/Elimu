<?php
function smenu1($page,$vis,$ajout,$mod,$sup,$rech,$imp){
 if($vis==1)
   $vis="<a href='?vis=1'><img src='menu/imgsmenu/vis1.jpg' border='0' alt=''/></a> ";
 else
  $vis="<img src='menu/imgsmenu/vis0.jpg' border='0' alt=''/> ";

  if($ajout==1)
   $ajout="<a href='?ajout=1&num=".@$classe."'><img src='menu/imgsmenu/ajout1.jpg' border='0' alt=''/></a> ";
 else
  $ajout="<img src='menu/imgsmenu/ajout0.jpg' border='0' alt=''/> ";

   if($mod==1)
   $mod="<a href='?mod=1&num=".@$classe."'><img src='menu/imgsmenu/mod1.jpg' border='0' alt=''/> </a>";
 else
  $mod="<img src='menu/imgsmenu/mod0.jpg' border='0' alt=''/> ";

  if($sup==1)
   $sup="<a href='?sup=1&num=".@$classe."'><img src='menu/imgsmenu/sup1.jpg' border='0' alt=''/> </a>";
 else
  $sup="<img src='menu/imgsmenu/sup0.jpg' border='0' alt=''/> ";

   if($rech==1)
   $rech="<a href='?rech=1'><img src='menu/imgsmenu/rech1.jpg' border='0' alt=''/> </a>";
 else
  $rech="<img src='menu/imgsmenu/rech0.jpg' border='0' alt=''/> ";

  if($imp==1)
   $imp="<a href='?imp=1'><img src='menu/imgsmenu/imp1.jpg' border='0' alt=''/> </a>";
 else
  $imp="<img src='menu/imgsmenu/imp0.jpg' border='0' alt=''/> ";
   //$_SESSION["annee"]=2009;
  //echo "sss".$_SESSION["annee"];
RETURN '<table border="0" cellpadding="0" cellspacing="0" height=24>
  <tr>
   <td height=24>'.$ajout.''.$vis.''.$mod.''.$sup.''.$rech.''.$imp.'</td>
   <!--td><select size="1" name="Name">
  <option value="">2009</option-->
</select></td>
  </tr>
  </table>';

}


function smenu($page,$vis,$ajout,$mod,$sup,$rech,$imp){
$_SESSION['classe']=@$_GET['num'];
$classe=$_SESSION['classe'];
 if($vis==1)
   $vis="<a href='?vis=1&num=".@$classe."'><img src='menu/imgsmenu/vis1.jpg' border='0' alt=''/></a> ";
 else
  $vis="<img src='menu/imgsmenu/vis0.jpg' border='0' alt=''/> ";

  if($ajout==1)
   $ajout="<a href='?ajout=1 &num=".@$classe."'><img src='menu/imgsmenu/ajout1.jpg' border='0' alt=''/></a> ";
 else
  $ajout="<img src='menu/imgsmenu/ajout0.jpg' border='0' alt=''/> ";

   if($mod==1)
   $mod="<a href='?mod=1 &num=".@$classe."'><img src='menu/imgsmenu/mod1.jpg' border='0' alt=''/> </a>";
 else
  $mod="<img src='menu/imgsmenu/mod0.jpg' border='0' alt=''/> ";

  if($sup==1)
   $sup="<a href='?sup=1 &num=".@$classe."'><img src='menu/imgsmenu/sup1.jpg' border='0' alt=''/> </a>";
 else
  $sup="<img src='menu/imgsmenu/sup0.jpg' border='0' alt=''/> ";

   if($rech==1)
   $rech="<a href='?rech=1 &num=".@$classe."'><img src='menu/imgsmenu/rech1.jpg' border='0' alt=''/> </a>";
 else
  $rech="<img src='menu/imgsmenu/rech0.jpg' border='0' alt=''/> ";

  if($imp==1)
   $imp="<a href='?imp=1' &num=".@$classe."><img src='menu/imgsmenu/imp1.jpg' border='0' alt=''/> </a>";
 else
  $imp="<img src='menu/imgsmenu/imp0.jpg' border='0' alt=''/> ";
   //$_SESSION["annee"]=2009;
  //echo "sss".$_SESSION["annee"];
RETURN '<table border="0" cellpadding="0" cellspacing="0" height=24>
  <tr>
   <td height=24>'.$ajout.'</td><td>'.$vis.'</td><td>'.$mod.'</td><td>'.$sup.'</td><td>'.$rech.'</td><td>'.$imp.'</td>
   
  </tr>
  </table>';

}

 function verifdate($taballs){
  $alltab="";
   for ($f=0; $f<count($taballs); $f++) {

      $alltab=$alltab.$taballs[$f];
   }
   //echo"<br>les".$alltab;
   $tb=explode("&",$alltab);
	$taball=array();
    for ($g=0; $g<count($tb)-1; $g++) {

    $df=explode(";",$tb[$g]);
   $tab=explode("/",$df[0]);
   $tab1=explode("/",$df[1]);
   //echo"<br>g =$g dd $df[0] df $df[1]<br>";
    if($tab[2]==$tab1[2]){
  	 $nban=0;
  		$nbmonth=$tab1[1]-$tab[1];
  		$nbjour=31*$nbmonth +$tab1[0]-$tab[0];
  	}
  	{
  	 $nban=$tab1[2]-$tab[2];
           $nbmonth=$nban*12-$tab[1]+$tab1[1];
           $nbjour=31*$nbmonth+$tab1[0]-$tab[0];
  	}
   //$nbperiode=str_word_count(" ",$periode);

   //for ($i=0; $i<$nbperiode; $i++) {
     // $period=$tab[$i];
     // $tdt=explode(";",$period);
     if( $tab1[1]> $tab[1] )
    $nbkc=$tab1[1]- $tab[1];
  else
    $nbkc=12+$tab1[1]- $tab[1];
  $j=0;
  $ii=0;
       for ($a=$tab[2]; $j<=($tab1[2]- $tab[2]); $a++) {
              for ($m=$tab[1];$m<=$tab[1]+$nbkc; $m++) {
	               for ($i=$tab[0]; $i<=31; $i++) {
	                if($ii<=$nbjour){
	                 if($m>12){
                      $m=$m - 12;
                      $a=$a+1;
	                 }
	                 if(strlen($m<2))
	                  $mois="0$m";
	                  else
	                  $mois=$m;

	                  if(strlen($i)==2){
	                 	   if (strlen($m)==2) {
                             $jour="$i/$m/$a";
		                   }
		                   else {
                              $jour="$i/0$m/$a";
		                   }
	                 }
	                 else{
	                       if (strlen($m)==2) {
                             $jour="0$i/$m/$a";
		                   }
		                   else {
                              $jour="0$i/0$m/$a";
		                   }

	                 }

	               //  $jour="$i/$mois/".$a;
	                 //
	                  //echo "<br>".$jour;
	                 array_push($taball,$jour);
	                 //echo "<br>";
	                 }
                    $ii++;

	               }
	              $tab[0]=1;
	              //echo "<br>".$ii;
        	  }

        	  $j++;

  }

    $j=0;
  $ii=0;
  $nbkc="";
   }
    //echo"nbelement". count($taball);
   return $taball;
   //}
 }
 function verifdatemax($dateinf,$datesup) {
 	if($dateinf<>"" and $datesup<>""){
 	             $erfin=1;
                 $td=explode("/",$dateinf);
                 $tf=explode("/",$datesup);
                 if(@$td[2]<>"" and @$tf[2]<>""){
				 if($td[2].$td[1].$td[0]<=$tf[2].$tf[1].$tf[0]){
                  // echo  "Date correcte";
                   $erfin=0;
				 }
				 else{
				 echo "<i class=error>Date de fin incorrecte par rapport a la date de debut</i>";
				   $erfin=1;
				 }
				return $erfin;
				}
				//else
				//return $erfin;
	}
 }
 function verifdatemaxi($dateinf,$datesup,$inf,$sup) {
 	if($dateinf<>"" and $datesup<>""){
 	             $erfin=1;
                 $td=explode("/",$dateinf);
                 $tf=explode("/",$datesup);
                 if(@$td[2]<>"" and @$tf[2]<>""){
				 if($td[2].$td[1].$td[0]<=$tf[2].$tf[1].$tf[0]){
                  // echo  "Date correcte";
                   $erfin=0;
				 }
				 else{
				 if($inf<>"" AND $sup<>"")
				 echo "<i class=error>$sup incorrecte par rapport à la $inf</i>";
				 else
				 	echo "<i class=error>Date de fin  par rapport à la Date de début</i>";

				   $erfin=1;
				 }
				return $erfin;
				}
				//else
				//return $erfin;
	}
 }
 function movefichier($pj,$id){
   $sal="";
 	if ((@$_FILES["$pj"]['name']<>"")) {
 	$stock=getcwd();
    $dir=$stock."/documents/$id/";
    $paths=pathinfo($_FILES["$pj"]['name']);
    $ext=$paths["extension"];
    $tab=explode(".$ext",$_FILES["$pj"]['name']);
    if(existefichier($id,"documents/$id","dd")<>""){
     echo"".$saliou=(existefichier($id,"documents/$id","dd"));
     $path_part = pathinfo($saliou);
	// Affiche Array ( [dirname] => /forum [basename] => index.php [extension] => php )
	 $aa=$path_part;
       $tb=explode(".".$aa["extension"],$aa["basename"])  ;
       echo "<br>touba".$aa["dirname"].$tb[0];
       rename($saliou,$aa["dirname"]."/".$tb[0].date(" dmY H_i").".".$aa["extension"]);
    }
    $nomfichconca=$id.".$ext";

    echo "nom complet du fichier : ".$_FILES["$pj"]['name']."<br> extension : ".$ext."<br> nom sans extension :".$tab[0]."<br>
     fichier renommé : ".$nomfichconca;
	move_uploaded_file($_FILES["$pj"]['tmp_name'], $dir.$_FILES["$pj"]['name']);


	rename($dir.$_FILES["$pj"]['name'],$dir.$nomfichconca);
    $sal="det";
   }
   return  $sal;

 }
function existefichier($val,$chemin,$href){
         // $chemin=$chemin."/".$nom_dossier;
          if($val<>""){
                   $PATH = '.';// Listage d'un répertoire $PATH
					$direct="$chemin/";
					$rapport="";
					//echo "<br>".$val;
					$nb=str_replace("-","",$val);
					//echo $direct;
					//$i=0 ;
					if ($dir = @opendir($direct)) {// ouverture du dossier
					//echo "<td>";

					    while($file = readdir($dir)) { // lecture d'une entrée

					        //création d'un tableau à 2 colonnes : nom + date fichiers
                                $path_parts = pathinfo($file);
							 // Affiche Array ( [dirname] => /forum [basename] => index.php [extension] => php )
							    $aa=$path_parts;
                           ///  echo"<br>sss valeur test $val fichier lu ".str_replace(".".$aa["extension"],"",$aa["basename"]);
							//echo @$aa["extension"];
							if($val == str_replace(".".@$aa["extension"],"",@$aa["basename"])){
							//echo "<br>sss ".str_replace(".".@$aa["extension"],"",@$aa["basename"]);
							if($href=="")
                            $rapport="<a href=$chemin/$val.".@$aa["extension"]." target=_black>Visualiser</a>";
                            else
                            echo $rapport="$chemin/$val.".@$aa["extension"]."";
					      }
					    }
					    closedir($dir); // fermeture du dossier

					}

    return $rapport;
 }
}
function listerfichier($chemin,$idaf){
         // $chemin=$chemin."/".$nom_dossier;
                   $PATH = '.';// Listage d'un répertoire $PATH
					//echo
					 $direct="$chemin";
					$rapport="";
					//echo "<br>".$val;
					//$nb=str_replace("-","",$val);
					//echo $direct;
                   if($_SESSION["menu"]=="menuadmin.php"){
					echo"
					  <div align=left class=titr1>Historique Login des Gestionnaires</div>
					<table BORDER=1 bordercolor='lightsteelblue' width='90%' cellpadding=3 cellspacing=0>
							<tr bgcolor=blue>
							     <td Width=7%>Nom </td>
							     <td Width=20%>Prénom</td>
							     <td Width=25%>Zone</td>
							     <td  Width=28%>Poste</td>
							     <td  Width=15%>Historique Log</td>
							</tr> ";
       						$req=mysql_query("select * from gestionnaire order by departement5 ASC") or die(mysql_error());
	       						while ($rw=mysql_fetch_array($req)) {
	       						$req1=mysql_query("select * from departement5 where idDep='".$rw[5]."'") or die(mysql_error());
	       						$rw1=mysql_fetch_array($req1);
                                  echo"<tr bgcolor=white>
							     <td>$rw[1] </td>
							     <td>$rw[2]</td>
							     <td>$rw1[1]</td>
							     <td>$rw[6]</td>
							     <td><a href='log.php?code=$rw[0]&zone=$rw[5]&id=gest'>visualiser</a></td>
							     </tr> ";
	             				}

					echo"
					</table>";
					echo"
					  <div align=left class=titr1>Historique Login des Assistants(es)</div>
					<table BORDER=1 bordercolor='lightsteelblue' width='90%' cellpadding=3 cellspacing=0>
							<tr bgcolor=blue>
							     <td Width=7%>Nom </td>
							     <td Width=20%>Prénom</td>
							     <td Width=25%>Zone</td>
							     <td  Width=28%>Poste</td>
							     <td  Width=15%>Historique Log</td>
							</tr> ";
       						$req=mysql_query("select * from assistant order by Service1 ASC") or die(mysql_error());
	       						while ($rw=mysql_fetch_array($req)) {
	       						//$req1=mysql_query("select * from departement5 where idDep='".$rw[5]."'") or die(mysql_error());
	       						//$rw1=mysql_fetch_array($req1);
                                  echo"<tr bgcolor=white>
							     <td>$rw[1] </td>
							     <td>$rw[2]</td>
							     <td>$rw[5]</td>
							     <td>$rw[6]</td>
							     <td><a href='log.php?code=$rw[0]&zone=$rw[5]&id=assist'>visualiser</a></td>
							     </tr> ";
	             				}

					echo"
					</table>";

					}
					if(($_SESSION["menu"]=="menuadmin.php") or ($_SESSION["menu"]=="menugestionnaire.php")){
					echo"
					  <div align=left  class=titr1>Historique Login des Utilisateurs</div>
					<table BORDER=1 bordercolor='lightsteelblue' width='90%' cellpadding=3 cellspacing=0>
							<tr bgcolor=blue>
							     <td Width=7%>Nom </td>
							     <td Width=20%>Prénom</td>
							     <td Width=25%>Zone</td>
							     <td  Width=28%>Poste</td>
							     <td  Width=15%>Historique Log</td>
							</tr> ";
							if($_SESSION["menu"]=="menuadmin.php")
       						$req=mysql_query("select * from user order by departement5 ASC") or die(mysql_error());
       						elseif($_SESSION["menu"]=="menugestionnaire.php")
       						$req=mysql_query("select * from user where departement5='".$_SESSION["zone"]."' order by departement5 ASC") or die(mysql_error());
	       						while ($rw=mysql_fetch_array($req)) {
	       						$req1=mysql_query("select * from departement5 where idDep='".$rw[5]."'") or die(mysql_error());
	       						$rw1=mysql_fetch_array($req1);
                                  echo"<tr  bgcolor=white>
							     <td>$rw[1] </td>
							     <td>$rw[2]</td>
							     <td>$rw1[1]</td>
							     <td>$rw[6]</td>
							     <td><a href='log.php?code=$rw[0]&zone=$rw[5]&id=user'>visualiser</a></td>
							     </tr> ";
	             				}

					echo"
					</table>";
					}
					//$i=0 ;
					if ($dir = @opendir($direct)) {// ouverture du dossier
					//echo "<td>";
                         $j=0;
					    while($file = readdir($dir)) { // lecture d'une entrée

					        //création d'un tableau à 2 colonnes : nom + date fichiers
                                $path_parts = pathinfo($file);
							 // Affiche Array ( [dirname] => /forum [basename] => index.php [extension] => php )
							    $aa=$path_parts;
                           ///  echo"<br>sss valeur test $val fichier lu ".str_replace(".".$aa["extension"],"",$aa["basename"]);
							//echo @$aa["extension"];
							//$val =str_replace("!".@$_SESSION["code"],"",str_replace($_SESSION["login1"],"",str_replace(".".@$aa["extension"],"",@$aa["basename"])));
							$val =str_replace("!".@$_SESSION["code"],"",@$aa["basename"]);
							$tab=explode("sss",@$aa["basename"]);
							$tab1=explode("-",$val);

							//echo $_SESSION["login1"];
							if($aa["extension"]=="txt" AND !isset($tab[1])){
							  //ECHO "<BR>$val  $idaf qqq ".@$tab1[0]."ddd ". @$tab[1];
							    if($idaf<>"" and $idaf==$tab1[0]){
								    if($j==0){
								    	echo"
									  <div align=left class=titr1>Mon Historique Login </div>
										<table BORDER=1 bordercolor='lightsteelblue' cellpadding=3 cellspacing=0>
											<tr bgcolor=blue> ";
											echo"
								     <td>Periode </td>
								     <td>Historique Log</td></tr>";
				                   }								 echo $rapport="<tr bgcolor='white'><td>".str_replace(@$_SESSION["code"],"",$tab1[0]).$tab1[1].str_replace(".txt","",$tab1[2])."</td><td><a href=$chemin".@$aa["basename"]." target=_black>Visualiser</a></td></tr>";
								 if($j==0){

				                 }
				                 $j++;
							    }
							}


					      }
					      echo"</table>";
					 closedir($dir); // fermeture du dossier
					}

  // return $rapport;
}
//somme de deux heures
 function add_heures($heure1,$heure2){	
$secondes1=heure_to_secondes($heure1);
	$secondes2=heure_to_secondes($heure2);
	$somme=$secondes1+$secondes2;
	//transfo en h:i:s
	$s=$somme % 60; //reste de la division en minutes => secondes
	$m1=($somme-$s) / 60; //minutes totales
	$m=$m1 % 60;//reste de la division en heures => minutes
	$h=($m1-$m) / 60; //heures
	//$resultat=$h."H ".$m."mn ".$s."s";
	$resultat=$h.":".$m;
	return $resultat;
}
//cinversion heure to seconde
function heure_to_secondes($heure){
	$array_heure=explode(":",$heure);
	$secondes=3600*$array_heure[0]+60*$array_heure[1];
	return $secondes;
}
?>