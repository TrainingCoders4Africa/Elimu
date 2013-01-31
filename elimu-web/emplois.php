<?php
include 'all_function.php';
if(isset($_POST['FIN_ID'])and isset($_POST['JOUR_ID']) and isset($_POST['DEBUT_ID']) and isset($_POST['SEMESTRE_ID']) and isset($_POST['CLASSE_ID']))
{
$jour =securite_bdd($_POST['JOUR_ID']);
$debut =securite_bdd($_POST['DEBUT_ID']);
$fin =securite_bdd($_POST['FIN_ID']);
$semestre =securite_bdd($_POST['SEMESTRE_ID']);
$sclasse=securite_bdd($_POST['CLASSE_ID']);
$annee=annee_academique();
$sq45="select * from emploi_temps WHERE ((debut  <='$debut'  and fin >='$fin') or(debut  >='$debut'  and fin <='$fin')  or debut >='$fin' or (debut  <='$debut'  and fin <='$fin' and fin >'$debut'))  and jour='$jour' and annee='$annee' and semestre='$semestre' and classe='$sclasse' ";
$rq45=mysql_query($sq45);
$stk = "select * from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and annee='$annee' and semestre='$semestre' and classe='$sclasse'  ";
$RSU1=mysql_query($stk);
if(mysql_num_rows($RSU1)<>0){
echo'	Planning d&eacute;ja enregistr&eacute;';
}
elseif(mysql_num_rows($rq45)<>0){
echo'Planning Impossible car la classe  n\'est pas disponible a cette heure';
}
elseif($semestre=="" and $jour=="" and $debut==""){
echo" Renseignez les champs semestre,jour, debut et fin de cours";}
elseif($semestre=="" and $jour<>"" and $debut<>""){echo" choisissez le semestre";}
elseif($semestre=="" and $jour=="" and $debut<>""){echo" Renseignez les champs semestre,jour de la semaine";}
elseif($semestre=="" and $jour<>"" and $debut==""){echo"  Renseignez les champs semestre,debut de cours";}

elseif($jour=="" and $semestre<>"" and $debut<>""){echo"Choisissez je jour de la semaine SVP !!!";}
elseif($jour=="" and $semestre<>"" and $debut==""){echo" Renseignez les champs jour de la semaine,heure de debut de cours";}
elseif($debut=="" and $semestre<>"" and $jour<>""){echo"Choisissez l'heure de debut du cours SVP !!!";}
elseif($fin<=$debut){ echo' heure d&eacutebut cours doit etre inf&eacuterieur &agrave; heure  fin de cours';}

else{
//echo $jour.','.$debut.','.$fin.','.$sclasse.','.$semestre;
echo'<B>Salles Disponibles </FONT></B><SELECT NAME="salle" id="Salle Disponible" required  >';
echo'<OPTION ></OPTION>';
$sqlstm10="select id,libelle1 from salles where id not in (select distinct salle from emploi_temps WHERE debut ='$debut'  and jour='$jour' and annee='$annee' and semestre='$semestre' )";
$req10=mysql_query($sqlstm10);
while($ligne0=mysql_fetch_array($req10))
{
$id=$ligne0['id'];
$slib=$ligne0['libelle1'];

echo'
<OPTION value="'.$id.'">'. $slib;
}
echo'
</OPTION></SELECT>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<B>Discipline </B><SELECT NAME="discipline"  id="Discipline" required  onchange="go1()">
<OPTION ></OPTION>';
$sqlstm1="SELECT discipline,personnel FROM enseigner WHERE classe='$sclasse' and annee='$annee' and enseigner.personnel not in (select professeur from emploi_temps where debut ='$debut'  and jour='$jour' and annee='$annee' and semestre='$semestre')";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
$slib2=$ligne['discipline'];
$prof=$ligne['personnel'];
 $naturee = findByValue('disciplines','iddis',$slib2);
						$entitee = mysql_fetch_row($naturee);
						$uv=$entitee[1];
echo'
<OPTION value="'.$slib2.'*'.$prof.'">'. utf8_encode($uv);
  
}
echo' </OPTION>

</SELECT></TD>
';

}
}
?>