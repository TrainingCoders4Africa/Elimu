<?php
function saisiedate($test){
    echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."?j=sss&' onsubmit='return (conform(this));'  enctype='multipart/form-data'   method='POST'>";
    echo'<center>
          
    <table border=0 cellpadding=2 cellspacing=0 >
            <tr>';
                 if($test!=""){
				 echo'
                 <td width=150 >Choisissez Une période</td><td>
                 <select size="1" name="periode" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: Obligatoire;erreur:Choisissez  une Période">
                 <option value=></option>';
                 $exess1=mysql_query("select distinct mois,annee from versement_banque order by annee desc, datejour desc");
                 while ($roi1=mysql_fetch_array($exess1)) {
                   echo"<option value='".$roi1["mois"]."/".$roi1["annee"]."'>".$roi1["mois"]."/".$roi1["annee"]."</option>";
                 }
                 echo'</select></td>';
				 
                 echo'
                 <td width=150>Choisissez Une Banque</td><td>
                 <select size="1" name="banque" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: obligatoire;erreur:Choisissez une banque">
                 <option value=></option>';
                 $exess=mysql_query("select * from banque_5 where libelle1 in (select distinct banque from versement_banque)");
                 while ($roi=mysql_fetch_array($exess)) {
                   echo"<option value='$roi[1]'>$roi[1]</option>";
                 }
                 echo'</select></td>';
                }
                 echo'<td width=50><input type="submit" value="OK" class=kc1></td>
         </tr>
    </table>
    ';
	if(@$_POST['periode']!=""){
        	$periode=$_POST['periode'];
			$banque=$_POST['banque'];
			$donne=$periode.'-'.$banque;
		return $donne;	 
 }

	
   
  }
 
function reportanouveaubanq($donne){
        $report=0;
       
		$tab1=explode("-",@$donne);
		$periode=@$tab1[0];
		$banque=@$tab1[1];
		 ECHO $periode;
		$tab=explode("/",@$periode);
		$mois=@$tab[0];
		$annee=@$tab[1];

  	   // echo ("select * from versement_banque ".@$where);
		$exesel=mysql_query("select sum(montant) sm from versement_banque where banque='$banque' and mois in (select mois from periodes where numero <(select numero from periodes where mois='$mois'))and annee='$annee' ")or die(mysql_error());
  	     while($rt=mysql_fetch_array($exesel)){
  
             $report=$rt["sm"];
            // echo "<br>Numéro Facture ". $rt[0]." date  $datelect < $dateref /". $rt[2];
  	     

         }

		 $dep=0;
        // echo "select sum(montant) from retrait  where banque='$banque' and mois in (select mois from periodes where numero <(select numero from periodes where mois='$mois'))and annee='$annee'";
		 $exedep=mysql_query("select sum(montant) from retrait  where banque='$banque' and mois in (select mois from periodes where numero <(select numero from periodes where mois='$mois'))and annee='$annee' ");
         while($rt=mysql_fetch_array($exedep)){
          	 /*$tab=explode("/",$rt[4]);
	  	     $tab1=explode("/",$datedebut);
	  	    // $datelect=$tab[2].$tab[1].$tab[0];
			 $datelect=$rt[4];
	  	     $dateref=$tab1[2].$tab1[1].$tab1[0];
	  	     if($datelect<$dateref){*/

	             $dep=$rt["sum(montant)"];
	          //   echo "<br>Nom dépense ". $rt[1]." date  $datelect < $dateref /". $rt[2];
	  	    // }

         }
    // echo"<br> Totale recette : $report <br>
     //          Totale Dépense : $dep";
      return $report-$dep;
}
  function banque($donne,$report){
$tab1=explode("-",@$donne);
		$periode=@$tab1[0];
		$banque=@$tab1[1];
	$tab=explode("/",$periode);
		$mois=@$tab[0];
		$annee=@$tab[1];
  echo"<center>
    <table cellpadding=2 cellspacing=1>

	            <tr bgcolor=#00FFFF align=center >
	            <th width=100>Date </th>
	            <th width=150>Banque</th>
	   	    	 <th width=70>N° Bordereau Vers. </th>
	   	    	<th width=100>Montant </th>


                  <th width=120>Numéro Chèque</th>
                 <th width=150>Destinataire</th>
                 <th width=100>Montant</th>
                 <th width=100>Solde</th>
            </tr>

  ";
   $prixtotalperi=0;
   $montdep=0;
   $solde=0;
   $dipsocaisse=0;
 /* if( $tab1[1]> $tab[1] )
    $nbkc=$tab1[1]- $tab[1];
  else
    $nbkc=12+$tab1[1]- $tab[1];*/
  $j=0;
  $ii=0;
            /*      $nomfichier="impression/impression.txt";
                  touch($nomfichier);
                  $fichier = fopen($nomfichier, 'wb+');*/
  $retr="";
  $bretr="";

  	$sql53=" select  distinct datejour from versement_banque where mois='$mois'  and annee='$annee'
	
	union
	
	select  distinct datejour from retrait where mois='$mois'  and annee='$annee'
	order by datejour desc";
$req53=mysql_query($sql53);

while($ligne53=mysql_fetch_array($req53))
{
	$jour=$ligne53['datejour'];

	                 //$jour=$i."/$mois/".$a;
	                 //echo "<br>".$jour;
	                 //echo "<br>select * from versement where date_versement2='".$jour."'". @$where1;
	                 $mexe=mysql_query("select * from versement_banque where datejour='$jour' and banque='$banque'");
	                 $mex=mysql_query("select * from retrait where  datejour='$jour' and banque='$banque'");
	                 if(mysql_num_rows($mexe)+mysql_num_rows($mex)<>0){
	                  //   $exsel=mysql_query("select * from retrait where  datejour='$jour' and banque='$banque'") or die(mysql_error());


	                 	while($Lig=mysql_fetch_row($mexe)){
                         $prixtotalperi+=$Lig[1];
                        // $numfact=$Lig[0];
                        // $ex=mysql_query("select * from ventes where numfact='".$numfact."'")or die(mysql_error());
                        // while($rw=mysql_fetch_row($ex)){
                         ECHO "<tr align=center bgcolor=#CCFFFF>
                         			<td>".$Lig[3]." </td>
                         			<td>".$Lig[2]." </td>
                         			<td>".$Lig[0]." </td>
                         			<td>".$Lig[1]."</td>
                         			<td></td>
                         			<td></td>
                         			<td></td>
                         			<td></td>
                         	   </tr>
                         	  ";
                         	 $b="$Lig[4];$Lig[3];$Lig[1];$Lig[1];;;;\r\n";
                   			// fwrite($fichier,$b);
                   	    // }
                        }

                        while($row=mysql_fetch_row($mex)){
                        	$montdep+=$row[1];
                        	$retr=$retr."<tr align=center bgcolor=#FF9999>
                         			<td>".$row[4]." </td>
                         			<td>".$row[2]." </td>
                         			<td> </td>
                         			<td></td>
                         			<td>".$row[0]."</td>
                         			<td>".$row[3]."</td>
                         			<td>".$row[1]."</td>
                         			<td></td>
                         	   </tr>
                         	  ";
                          $bretr=$bretr."$row[4];$row[3];;;$row[1];$row[4];$row[2];\r\n";

                        }

                           /*  */
	                 }
	                

  }
  echo $retr;
 /* if ($bretr!="") {
   fwrite($fichier,$bretr);
  }*/


  $solde=$prixtotalperi-$montdep;
                        ECHO "<tr align=center bgcolor=#9999FF>
                         			<td> </td>
                         			<td></td>
                         			<td> </td>
                         			<td>$prixtotalperi</td>
                         			<td></td>
                         			<td></td>
                         			<td>$montdep</td>
                         			<td>$solde</td>
                         	   </tr>
                         	  ";
    $b=";;;$prixtotalperi;;;$montdep;$solde\r\n";
                          //fwrite($fichier,$b);
    //fclose($fichier);
    //if($prixtotalperi<>0){
    /* ECHO "<tr align=right>
      <td colspan=8><a href=impression/impression.php?id=4&datedeb=$datedebut&datef=$datefin&pt=$prixtotalperi class=imp target=_blank>Imprimer</a> </td>
      	   </tr>
      	  ";*/
     // }
    echo"</table>";

    if($prixtotalperi<>0){}
    else
    	echo"<big>Aucune Pas de Transastion pour pour le mois ".$periode." Au niveau de la banque ".$banque."</big>";

                 /*$nomfichier="impression/suppl.txt";
                 touch($nomfichier);
                 $fichier = fopen($nomfichier, 'wb+');
                 $b=($prixtotalperi+$report).";".$montdep.";".($solde+$report);
                             // fwrite($fichier,$ptht);
                              //fwrite($fichier,$tva);
                   			  fwrite($fichier,$b);
                   fclose($fichier);*/
      $dipsocaisse=$solde+$report;

        echo "<div align=left class=good>Situation  du mois  $periode  : à la banque $banque <br>
          <table cellpadding=2 cellspacing=1>
       <tr bgcolor=#CCFFFF><td> Report à nouveau du Mois Passé </td><td align=right><big>$report</big></td> </tr>
       <tr bgcolor=blue><td> Versement  du Mois </td><td align=right><big>$prixtotalperi</big></td> </tr>	   
       <tr bgcolor=red><td> Retrait  du Mois </td><td align=right ><big>$montdep</big></td> </tr>
        <tr bgcolor=#9999FF><td>Disponibilité en Banque  :</td><td align=right><big>".$dipsocaisse."</big></td> </tr>
        </table>
        </div>";
                   /* */

    echo"</center>";

  }

?>
