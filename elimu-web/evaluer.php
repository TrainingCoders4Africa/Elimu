<script>
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
/*if(champ.value.charAt(x) == "."){points++;}  Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>

<?php
//header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=iso-8859-1');
include 'all_function.php';
if(isset($_POST['EVA_ID'])  )
{
//r�cup�ration code de l'�valuation
$codee =$_POST['EVA_ID'];
//$cycle =$_POST['PROF_ID'];
$annee=annee_academique();
//  echo'discipline '.accents($discipline);
echo'
  <TR><TD class=petit>&nbsp;</TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=#033155 align=center >
            <th width=100><b><font color="white">Matricule</th>
            <th width=300><b><font color="white">Eleve</th>
            <th width=300><b><font color="white">Date et Lieu de Naissance</th>
            <th width=100><b><font color="white">Notes</th>
                     </tr>';
  $sqlstm4="select eleve,note from notes where evaluation='$codee'";
$req4=mysql_query($sqlstm4);
$nb=mysql_num_rows($req4);
                  $i=1;
while($ligne4=mysql_fetch_array($req4))
{
				  $meleve=$ligne4['eleve'];
$note=$ligne4['note'];
				   		
                	 $sql="select * from eleves where matricule='$meleve'";
                  $exec=mysql_query($sql) or die(mysql_error());
                  $ligne=mysql_fetch_row($exec);
                               $code=$ligne['0'];
							      $prenom=$ligne['1'];
                               $nom=$ligne['2'];
                               $mode=$ligne['3'];
							   $date_n=$ligne['4'];
                               $lieu=$ligne['5'];
							   echo" <input name=nbart type=hidden value=$nb>"; 
		              echo"<tr bgcolor=#CCFFFF>
			            <td align=center>$code</td>
			            <td align=center>$prenom $nom</td>
							<td align=center>$date_n &agrave; ".htmlentities($lieu)."</td>
							<td  align=center>
			            		  <input size=9 name=note$i type=text id='Note El�ve' value='$note'  onkeyup='verif_nombre(this);' lang='bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF;type:obligatoire2;erreur: CV obligatoire'>
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
				  echo" <input name=evaluation type=hidden value='$codee'>";
				


}
?>