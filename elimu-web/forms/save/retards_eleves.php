<?php
//$_SESSION['classe']=;
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$type='';
$hd='';
$hf='';
$datejour=date("Y")."-".date("m")."-".date("d");
$heure=date("H:i:s");
$sqlstm1e="SELECT count(*) ns FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1e=mysql_query($sqlstm1e);
while($lignee=mysql_fetch_array($req1e))
{
	$ns=$lignee['ns'];
	}
	//connaitre le semestre en cours
$sqlstm1="SELECT id,libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($lignes=mysql_fetch_array($req1))
{
	$codes=$lignes['id'];
	$libelle=$lignes['libelle'];
	$debut=$lignes['debut'];
	$fin=$lignes['fin'];
	}
		$sqlstm1pa = "select type,horaire_debut hd,horaire_fin hf from absence_personnel where annee='$annee' and personnel='$personnel' and date_debut<='$datejour' and date_fin>='$datejour'";
$RSU1=mysql_query($sqlstm1pa);
while($ligne=mysql_fetch_array($RSU1))
{
$type=$ligne['type'];
$hd=$ligne['hd'];
$hf=$ligne['hf'];
}
$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				 $datefr = $jour[date("w")];
 $sqlst="select id,debut,fin,discipline from emploi_temps where annee='$annee' and semestre='$codes'and classe='$sclasse' and debut<='$heure' and fin>='$heure'
 and jour=(select id from jours where libelle='$datefr') and id not in
 (select emploi from cahier_retard where annee='$annee' and datejour='$datejour' and cahier_retard.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee'))";
	
?>
<form name="inscription_form" action="<?php echo lien()?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" align=left >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<?php
		if($ns==0){
echo $datejour .' n\'est dans  aucun semestre donc impossible de remplir le cahier de retard  pour cette date';
}
else{		 
	
				 	


 if($type=='JOURNEE'){
ECHO'Impossible de remplir le cahier de texte car vous être absent aujourdhui';
}
else{
?>
		<TR>
<B>&nbsp;Cours &nbsp;*&nbsp;</B><SELECT NAME="cours" id="cours" required>
<OPTION value=""></OPTION>
 <?php
$req=mysql_query($sqlst);
while($lig=mysql_fetch_array($req))
{
$id=$lig['id'];
$datep=$lig['debut'];
$discipline=$lig['fin'];
$typep=$lig['discipline'];
$table = 'disciplines';
				 $selection = findByValue($table,'iddis',$typep);
				$ro=mysql_fetch_row($selection);
    			
?>
  <OPTION value="<?php echo $id;?>"><?php echo $ro[1].' de '.$datep.' à '.$discipline;?>
  <?php
}
?>
 </OPTION></SELECT></TD></TR>
<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2>
	   	    <tr bgcolor=#033155 align=center >
            <th width=100><b><font color="white">Matricule</th>
            <th width=300><b><font color="white">Eleve</th>
            <th width=300><b><font color="white">Date et lieu de Naissance</th>
            <th width=100><b><font color="white">Retard</th>
			<th width=100><b><font color="white">Heure Arrivée</th>
                     </tr>
                <?php
                  //include"connect.php";
                  $sql="select * from eleves where matricule in(  select eleve from inscription where classe='$sclasse' and annee='$annee')";
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
			            <td align=center><b>$prenom $nom</td>
							<td align=center><b>$date_n à $lieu</td>
							<td  align=center>
			            		  <input size=9 name=choix$i  type=checkbox value='OUI'  id='Note Eléve'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
			            		<td  align=center>
			            		  <input size=9 name=arrive$i  type=text value='$heure'  id='Note Eléve'>
			            	 <script type=text/javascript>      //
				                 			new SUC( document.frm.nbptotal$i );       //
				             	      </script>
			            		</td>
							";
						
			                       echo" <input name=code$i type=hidden value='$code'>
			        
			          ";
                     $i++;
                  }
				   echo" <input name=semestre type=hidden value='$codes'>";
				  echo" <input name=cl type=hidden value='$sclasse'>";
				  echo" <input name=an type=hidden value='$annee'>";
				  echo" <input name=matricule type=hidden value='$personnel'>";

				?>
		</table>
	</td>
  </tr>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=95%></TD></TR>


	</tbody>
<TR><TD class=petit>&nbsp;</TD>

</TR>
	<TR><TD><BUTTON TITLE="Confirmer l'Emargement"name="enregistrer" TYPE="submit" id="flashit"><b>Enregistrer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["cl"]) ) {
	if(isset($_POST["cours"])){
		$emploi=addslashes($_POST['cours']);
$classe=addslashes($_POST['cl']);
$semestre=addslashes($_POST['semestre']);
$annee=addslashes($_POST['an']);
$matricule=addslashes($_POST['matricule']);
$datejour=date("Y")."-".date("m")."-".date("d");
// $choix=@$_POST["choix"];

$nbart=addslashes($_POST['nbart']);


		for ($i=1; $i<=$nbart; $i++) {
	   $code= addslashes($_POST['code'.$i.'']);
	   $choix= addslashes(@$_POST['choix'.$i.'']);
	   $arrive= addslashes(@$_POST['arrive'.$i.'']);
	if(!empty($choix)) {
	//$monchoix = array_shift($choix);
	
	$exereq=mysql_query("select * from cahier_retard where eleve= '$code' and annee='$annee' and emploi='$emploi' and datejour='$datejour'");
		if(mysql_num_rows($exereq)==0){
		   $sql="insert into cahier_retard values('$code','$datejour','$arrive','$emploi','$annee','$semestre','$matricule')";
		           
		            $exe=mysql_query($sql) or die(mysql_error());
		            if (@$exe) {
		             	echo'<script Language="JavaScript">
 {alert ("Retard Ajouté");
 }</SCRIPT>';
	echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="retards_eleves.php?ajout=1&num='.$classe.'"
</SCRIPT>';
}
	else	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }
 </script>';
		echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="retards_eleves.php?ajout=1&num='.$classe.'"
</SCRIPT>';
	}
	}
		  		 }
				 else{
			echo'<script Language="JavaScript">
 {alert ("Enregistrement Impossible car pas de retard coqué");
 }
 </script>';
		echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="retards_eleves.php?ajout=1&num='.$classe.'"
</SCRIPT>';	
} 
	     }
 
	}
}
}
}
?>