<?php
include 'all_function.php';
if(isset($_POST['DEBUT_ID']) and isset($_POST['CL_ID'])and isset($_POST['DURE']) and isset($_POST['DP']))
{
$dp =securite_bdd($_POST['DP']);
$debut=securite_bdd($_POST['DEBUT_ID']);
$duree =securite_bdd($_POST['DURE']);
$fin=@add_heures($debut,$duree);
$sclasse=securite_bdd($_POST['CL_ID']);
if($duree<>""){
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1="SELECT id,libelle,date_debut debut,date_fin fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
	$code=$ligne['id'];
	$libelle=$ligne['libelle'];
	$semdebut=$ligne['debut'];
	$semfin=$ligne['fin'];
	}
$sq45="select * from evaluations WHERE ((heure_debut  <='$debut'  and heure_fin >='$fin') or(heure_debut  >='$debut'  and heure_fin <='$fin')  or heure_debut >='$fin' or (heure_debut  <='$debut'  and heure_fin <='$fin' and heure_fin >'$debut')) 
 and date_prevue='$dp' and annee='$annee' and semestre='$code' and classe='$sclasse' ";
$rq45=mysql_query($sq45);

$stkhd = "select * from evaluations where  ((heure_debut  >='$debut'  and heure_fin >='$fin' and heure_debut<'$fin') 
 or (heure_debut  <='$debut'  and heure_fin <='$fin' and heure_fin >'$debut') or (heure_debut  >='$debut'  and heure_fin <='$fin'))  
and date_prevue='$dp' and annee='$annee' and semestre='$code' and classe='$sclasse' ";
$hdp=mysql_query($stkhd);
$stk = "select * from evaluations where date_prevue='$dp' and heure_debut='$debut' and heure_fin='$fin' and annee='$annee' and semestre='$code' and classe='$sclasse'  ";
$RSU1=mysql_query($stk);


if($sclasse=="" and $dp=="" and $debut==""){
echo" Renseignez les champs classes,date pr&eacute;vue, heure debut &eacute;valuation";}
elseif($sclasse=="" and $dp<>"" and $debut<>""){echo" choisissez le classe";}
elseif($sclasse=="" and $dp=="" and $debut<>""){echo" Renseignez les champs classe,date &eacute;valuation";}
elseif($sclasse=="" and $dp<>"" and $debut==""){echo"  Renseignez les champs classe,debut de cours";}

elseif($dp=="" and $sclasse<>"" and $debut<>""){echo"Renseigner date &eacute;valuation SVP !!!";}
elseif($dp=="" and $sclasse<>"" and $debut==""){echo" Renseignez les champs date &eacute;valuation ,heure de debut ";}
elseif($debut=="" and $sclasse<>"" and $dp<>""){echo"Choisissez l'heure de debut  SVP !!!";}
elseif(mysql_num_rows($RSU1)<>0){
echo'Planning d&eacute;ja enregistr&eacute;';
}
elseif($semdebut>$dp or $semfin<$dp){

echo'Planning doit &Ecirc;tre dans le semestre en cours';			
}
elseif(mysql_num_rows($hdp)<>0){
echo'Planning Impossible car la classe  a une &eacute;valuation a cette p&eacute;riode';
}
elseif($duree<>''){
echo'<tr>
	<TD width="70" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>&nbsp;Type: &nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="type" id="Type evaluation" required lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire"  >
<OPTION  value=""></OPTION>
<OPTION  value="DEVOIR">DEVOIR</OPTION>
<OPTION  value="COMPOSITION">COMPOSITION</OPTION>
      
</SELECT ></TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';


echo'<B>Salles Disponibles </FONT></B><SELECT NAME="salle" id="salle" required onchange="go2()"  >
<OPTION ></OPTION>';
$sqlstm10="select id,libelle1 from salles where id  in (SELECT distinct salle  FROM emploi_temps where classe='$sclasse' and annee='$annee' and semestre='$code' )";
$req10=mysql_query($sqlstm10);
while($ligne0=mysql_fetch_array($req10))
{
$id=$ligne0['id'];
$slib=$ligne0['libelle1'];

echo'
<OPTION value="'.$id.'">'. $slib;
}
echo'</SELECT></TD>


<TD class=petit>&nbsp;<input type=hidden name="semestre" value="'.$code.'"></TD>
<TD class=petit>&nbsp;<input type=hidden name="fin" value="'.$fin.'"></TD>
';


}
}
}
?>