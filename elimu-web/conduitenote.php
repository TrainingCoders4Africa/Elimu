<?php
//include 'all_function.php';
include '/dao/connection.php';
include '/dao/select.php';
//include "metier/stats.php";
if(isset($_POST['CLASSE_ID']) and isset($_POST['SEM_ID'])and isset($_POST['PERSO_ID']) )
{

$classe=securite_bdd($_POST['CLASSE_ID']);
$semestre=securite_bdd($_POST['SEM_ID']);
$personnel=securite_bdd($_POST['PERSO_ID']);
$annee=annee_academique();
$nb=0;

echo' 
	   	    <tr bgcolor=#033155 align=center >
            <th width=100><b><font color="white">Matricule</th>
            <th width=300><b><font color="white">Eleve</th>
            <th width=300><b><font color="white">Date et lieu de Naissance</th>
            <th width=100><b><font color="white">Conduite</th>
                     </tr>';
                
                  //selection des éléves qui n'ont pas encore de notes de conduite
                  $sql="select * from eleves where matricule in(  select eleve from inscription where classe='$classe' and annee='$annee') and matricule not in
				  (select eleve from note_conduite where semestre='$semestre' and annee='$annee' and personnel='$personnel')";
                  $exec=mysql_query($sql) or die(mysql_error());
                  $nb=mysql_num_rows($exec);
				  
                  $i=1;
                 echo" <input name=nbart type=hidden value=$nb>";
                  while($ligne=mysql_fetch_row($exec)){
                               $code=$ligne['0'];
							      $prenom=$ligne['1'];
                               $nom=$ligne['2'];
                               $mode=$ligne['3'];
							   $date_n=$ligne['4'];
                               $lieu=$ligne['5'];
		              echo"<tr >
			            <td align=center><b>$code</td>
			            <td align=center><b>".utf8_encode($prenom)." ". utf8_encode($nom)."</td>
							<td align=center><b>$date_n ".utf8_encode('à ').utf8_encode($lieu)."</td>
							<td  align=center>
			            		  <input size=9 name=note$i  type=text id='Note Eléve'   onkeyup='verif_nombre(this);' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;type:obligatoire2;erreur: CV obligatoire'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		</td>
							";
						
			                       echo" <input name=code$i type=hidden value='$code'>
			        
			          ";
                     $i++;
                  }
				   			  
				  echo" <input name=an type=hidden value='$annee'>";
				  if($nb<> 0)
echo'<div><input class=kc1 type="submit" name="enregistrer" value='.utf8_encode("Sanctionner").' />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" /></div>
		';
}

?>