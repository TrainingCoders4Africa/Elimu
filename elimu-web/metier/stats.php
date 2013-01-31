<?php

function saisiedate($test){
    echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."?j=sss&' onsubmit='return (conform(this));'  enctype='multipart/form-data'   method='POST'>";
    echo'
          
    <table border=0 cellpadding=2 cellspacing=0 >
            <tr>';
                 if($test!=""){
				 echo'
                 <td width=150 >Choisissez Une période</td><td>
                 <select size="1" name="periode" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: Obligatoire;erreur:Choisissez  une Période"  onchange="submit();">
                 <option value=></option>';
                 $exess1=mysql_query("select distinct id,libelle from semestres where id like 'S%' order by id desc");
                 while ($roi1=mysql_fetch_array($exess1)) {
                   echo"<option value='".$roi1["id"]."'>".$roi1["libelle"]."</option>";
                 }
                 echo'</select></td>';
				 
                
                }
                 echo'
         </tr>
		 
    </table>
    ';
	if(@$_POST['periode']!=""){
        	$periode=$_POST['periode'];
			//$banque=$_POST['banque'];
			$donne=$periode;
		return $donne;	 
 }
  
  } 
//
function semestre($matricule,$annee){
  $personnel=$matricule;
    $annee=$annee;
  echo"<form name='frm' action='".$_SERVER['REQUEST_URI']."?j=sss&' onsubmit='return (conform(this));'  enctype='multipart/form-data'   method='POST'>";
    echo'
          
    <table border=0 cellpadding=2 cellspacing=0 >
            <tr>';
                 if($personnel!=""){
				 echo'
                 <td width=150 >Choisissez Une Classe</td><td>
                 <select size="1" name="periode" lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type: Obligatoire;erreur:Choisissez  une Période"  onchange="submit();">
                 <option value=></option>';
                 $exess1=mysql_query("select etude  from surveiller where personnel='$personnel' and annee='$annee'");
                 while ($roi1=mysql_fetch_array($exess1)) {
                   echo"<option value='".$roi1["etude"]."'>".$roi1["etude"]."</option>";
                 }
                 echo'</select></td>';
				 
             }
                 echo'
         </tr>
		 
    </table>
    ';
	if(@$_POST['periode']!=""){
        	$periode=$_POST['periode'];
			//$banque=$_POST['banque'];
			$classe=$periode;
		return $classe;	 
 
  
  } 
  }

function banque($donne,$sclasse,$annee){
$code=$donne;
$sclasse=$sclasse;
$annee=$annee;
$nb=0;
  $exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste du planning pour le <?php echo $sem;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD align=left><img src="t-rouge.gif" align=baseline>
<A HREF="ajemplois.php?num=<?php echo $sclasse;?>&annee=<?php echo $annee;?>&semestre=<?php echo $code;?>"
onMouseOver="self.status='Ajouter un achat de produit'; return true"
            onMouseOut="self.status=''; return true">
<B>Ajouter Emploi du temps pour la période en cours</B></A></TD>

<TD class=petit>&nbsp;</TD>
<TD align=left><img src="t-rouge.gif" align=baseline>
<A HREF="#" OnClick="window.open('aemploi.php?classe=<?php echo $sclasse;?>&annee=<?php echo $annee;?>&se=<?php echo $code;?>','icfenetre','toolbar=no,status=nomenubar=yes,scrollbars=yes,dependant=yes,resizeable=yes,location=no,width=500,height=400,top=10,left=300');return(false)">
	&nbsp;<?php echo "<font color=blue><font color=blue> Apperçu";?>&nbsp;</A>

</TD>

</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;HORAIRE&nbsp;</B></FONT></TD>
';


$sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

echo'

<Td align=center colspan=1 NOWRAP ><FONT color="black" ><B>&nbsp;'. $libellec0.' &nbsp;</B></FONT></Td>';
}

echo'
</tr>
<tr>';


 $sqlstm1mel100="select distinct debut ,fin  from emploi_temps where classe='$sclasse' and semestre='$code' and annee='$annee' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$debut=$ligne10u14mel100['debut'];
$fin=$ligne10u14mel100['fin'];

$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];




echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$d.' - '.$fi.'&nbsp;</B></FONT></TD>';


 $sqlstm1gaz100="select id from jours  order by id";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$jour=$ligne10u14gaz100['id'];
//$b=$b+1;

//$nb=$nb+1;


$sqlstm11000="select discipline,salle  from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and classe='$sclasse' and semestre='$code' and annee='$annee'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$discipline=$ligne10u141000['discipline'];
$salle=$ligne10u141000['salle'];
//$retro=$ligne10u141000['retrocession'];
//$livre=$ligne10u141000['livraison'];

if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
}//$svent=$svent+@$nombre;
else{
echo'
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP ><A HREF="modif_emploi.php?j='. $jour.'&hd='. $debut.'&hf='.$fin.'&cl='. $sclasse.'&se='. $code.'&an='. $annee.'"><FONT color= "black" >&nbsp;'. $discipline.'<br/>'.$salle.'&nbsp;</TD>';


}
}

echo"</tr>";

}
echo'</table>';

 }
//emploi prof

function prof($donne,$personnel,$annee){
$code=$donne;
$matricule=$personnel;
$aca=$annee;
$nb=0;
  $exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste du planning pour le <?php echo $sem;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR>

<TD class=petit>&nbsp;</TD>
<TD align=left><img src="t-rouge.gif" align=baseline>
<A HREF="#" OnClick="window.open('profemploi.php?matricule=<?php echo $matricule;?>&annee=<?php echo $aca;?>&se=<?php echo $code;?>','icfenetre','toolbar=no,status=nomenubar=yes,scrollbars=yes,dependant=yes,resizeable=yes,location=no,width=500,height=400,top=10,left=300');return(false)">
	&nbsp;<?php echo "<font color=blue><font color=blue> Apperçu";?>&nbsp;</A>

</TD>

</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;HORAIRE&nbsp;</B></FONT></TD>
';


$sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;

echo'

<Td align=center colspan=1 NOWRAP ><FONT color="black" ><B>&nbsp;'. $libellec0.' &nbsp;</B></FONT></Td>';



}

echo'
</tr>
<tr>';
$sqlstm1mel100="select distinct  debut, fin  from emploi_temps where classe in( select classe from enseigner where personnel='$matricule' and annee='$aca')and
 discipline in( select discipline from enseigner where personnel='$matricule' and annee='$aca') and semestre='$code' and annee='$aca' order by debut";
$req10mu14mel100=mysql_query($sqlstm1mel100);
while($ligne10u14mel100=mysql_fetch_array($req10mu14mel100))
{
$debut=$ligne10u14mel100['debut'];
$fin=$ligne10u14mel100['fin'];

$array_heure=explode(":",$debut);
	$d=$array_heure[0]."H ".$array_heure[1];

	$array_heuref=explode(":",$fin);
	$fi=$array_heuref[0]."H ".$array_heuref[1];




?>
<td align=center ROWSPAN=1 NOWRAP>&nbsp;<?php echo $d.' - '.$fi?>&nbsp;</B></FONT></TD>

<?php
 $sqlstm1gaz100="select id from jours  order by id";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$jour=$ligne10u14gaz100['id'];
//$b=$b+1;

//$nb=$nb+1;


$sqlstm11000="select discipline,salle,classe  from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and classe in( select classe from enseigner where personnel='$matricule' and annee='$aca')and discipline in( select discipline from enseigner where personnel='$matricule' and annee='$aca') and semestre='$code' and annee='$aca'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$discipline=$ligne10u141000['discipline'];
$salle=$ligne10u141000['salle'];
$classe=$ligne10u141000['classe'];
//$livre=$ligne10u141000['livraison'];

if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
}//$svent=$svent+@$nombre;
else{
?>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >&nbsp;<?php echo $classe.'<br/>'.$discipline.'<br/>'.$salle;?>&nbsp;</TD>

<?php
}
}
//}
echo"</tr>";
}
echo'</table>';

 }
function periodes($mois){
if ($mois=='1')
	$smois="Janvier";
		else
if ($mois=='2')
	$smois="Fevrier";
		else
if ($mois=='3')
	$smois="Mars";
		else
if ($mois=='4')
	$smois="Avril";
		else
if ($mois=='5')
	$smois="Mai";
		else
if ($mois=='6')
	$smois="Juin";
		else
if ($mois=='7')
	$smois="Juillet";
		else
if ($mois=='8')
	$smois="Aout";
		else
if ($mois=='9')
	$smois="Septembre";
		else
if ($mois=='10')
	$smois="Octobre";
		else
if ($mois=='11')
	$smois="Novembre";
		else
if ($mois=='12')
	$smois="Decembre";
	
	return $smois;
}

//affichage résultats semestriels
function resultatsemestriel($donne,$personnel,$annee){
$code=$donne;
$personnel=$personnel;
$annee=$annee;
$nb=0;
$nbrel=0;
$mi=0;
$ma=0;
$somoy=0;
/*$sqlstmcl="select etude  from surveiller where personnel='$personnel' and annee='$annee'";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$sclasse=$lignecl['etude'];
}*/

  $exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste des résultats pour le <?php echo $sem;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;CLASSES&nbsp;</B></FONT></TD>
';


/*$sqlstm4clc0="select libelle de from jours order by id";
$req4clc0=mysql_query($sqlstm4clc0);
while($ligne4clc0=mysql_fetch_array($req4clc0))
{
$libellec0=$ligne4clc0['de'];
$nb=$nb+1;*/

echo'

<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;EFFECTIF CLASSE&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;EFFECTIF COMPOSE&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;EFFECTIF ABSENT&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;MOYENNE CLASSE&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;MOYENNE MINIMALE&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;MOYENNE MAXIMALE&nbsp;</B></FONT></TD>
';

 $nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
						//$b="CLASSES;EFFECTIF CLASSE;EFFECTIF COMPOSE;EFFECTIF ABSENT;MOYENNE CLASSE;MOYENNE MINIMALE;MOYENNE MAXIMALE\r\n";
              				// fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="select etude  from surveiller where personnel='$personnel' and annee='$annee'";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$sclasse=$lignecl['etude'];



echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$sclasse.'&nbsp;</B></FONT></TD>';

$sqlstm1el="select count(distinct eleve) from inscription where classe='$sclasse' and annee='$annee'";
$reqel=mysql_query($sqlstm1el);
$ligneel=mysql_fetch_array($reqel);
{
$nbre_eleve=$ligneel['count(distinct eleve)'];
}
 $sqlstm1gaz100="select min(moyenne) mim,max(moyenne) mam,count(eleve) ce,sum(moyenne) sm from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee')";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$mi=$ligne10u14gaz100['mim'];
$ma=$ligne10u14gaz100['mam'];
$nbrel=$ligne10u14gaz100['ce'];
$somoy=$ligne10u14gaz100['sm'];
}
$moye=@round($somoy/$nbrel,3);
$nbabsent=$nbre_eleve-$nbrel;
$b="$sclasse;$nbre_eleve;$nbabsent;$nbrel;$moye;$mi;$ma\r\n";
		                      fwrite($fichier,$b);
                  
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$nbre_eleve.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$nbrel.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$nbre_eleve-$nbrel.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@round($somoy/$nbrel,3).'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$mi.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$ma.'</TD>';
echo"</tr>";

}
echo'</table>';
 echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;CLASSES&nbsp;</B></FONT></TD>
';
echo'
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;NBRE A FELICITER &nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;NBRE A ENCOURAGER&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;NBRE AVEC TABLEAU D\'HONNEUR&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;NBRE A AVERTIR&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;NBRE A BLAMER&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;MOYENNE >=10 &nbsp;</B></FONT></TD>';

$b="CLASSES;FELICITTATION;ENCOURAGEMENT;TABLEAU D\'HONNEUR;AVERTISSEMENT;BLAME;MOYENNE >=10\r\n";
						fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="select etude  from surveiller where personnel='$personnel' and annee='$annee'";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$sclasse=$lignecl['etude'];



echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$sclasse.'&nbsp;</B></FONT></TD>';
//qui ont la moyenne
 $sqlstm1g="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne>=10";
$req10mu14g=mysql_query($sqlstm1g);
$ligne10u14g=mysql_fetch_array($req10mu14g);
$nmoy=$ligne10u14g['ce'];
//féliciter
 $sqlstm1gaz="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne>=14";
$req10mu14gaz=mysql_query($sqlstm1gaz);
$ligne10u14gaz=mysql_fetch_array($req10mu14gaz);
$feliciter=$ligne10u14gaz['ce'];
//encourager
$sqlstm11000="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne>=13";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$encourager=$ligne10u141000['ce'];
//honneur
 $sqlstm1gazh="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne>=12";
$req10mu14gazh=mysql_query($sqlstm1gazh);
$ligne10u14gazh=mysql_fetch_array($req10mu14gazh);

$honneur=$ligne10u14gazh['ce'];
//avertissement
$sqlstm11000a="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne>=7 and moyenne<8";
$req10mu141000a=mysql_query($sqlstm11000a);
$ligne10u141000a=mysql_fetch_array($req10mu141000a);
$avertissement=$ligne10u141000a['ce'];
//blame
$sqlstm11000ba="select count(eleve) ce from moyennes where annee='$annee' and semestre='$code' and moyennes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee') and moyenne<7";
$req10mu141000ba=mysql_query($sqlstm11000ba);
$ligne10u141000ba=mysql_fetch_array($req10mu141000ba);
$blame=$ligne10u141000ba['ce'];
/*
$discipline=$ligne10u141000['discipline'];
$salle=$ligne10u141000['salle'];
//$retro=$ligne10u141000['retrocession'];
//$livre=$ligne10u141000['livraison'];

if(mysql_num_rows($req10mu141000)==0){
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
//echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >-</TD>';
}//$svent=$svent+@$nombre;
else{*/
$b="$sclasse;$feliciter;$encourager;$honneur;$avertissement;$blame;$nmoy\r\n";
		                      fwrite($fichier,$b);
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$feliciter.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$encourager.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$honneur.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$avertissement.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$blame.'</TD>';
echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$nmoy.'</TD>';
//}
//}

echo"</tr>";
}
  fclose($fichier);
echo"</TABLE>";
?>
<div>          
<a href="impression/impression.php?id=<?php echo $annee;?>&sem=<?php echo $sem;?>&page=<?php echo 'RESULTATSEMESTRE';?>" target="_blank" class=imp>Apperçu</a>
</div>
<?php
 }
?>
<?php
function resultatpassant($classe,$annee){
$sclasse=$classe;
//$personnel=$personnel;
$annee=$annee;
$nb=0;
$nbrel=0;
$mi=0;
$ma=0;
$somoy=0;
  /*$exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }*/
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste des passants en classe supérieure pour l'année académique <?php echo $annee.' de la classe de '.$sclasse;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Eléve&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date de Naissance&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Moyenne Annuelle&nbsp;</B></FONT></TD>';

 $nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
						//$b="ELEVES;DATE DE NAISSANCE;MOYENNE ANNUELLE\r\n";
              				//fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="SELECT matricule,prenom,nom,lieu_nais,date_format(date_nais,'%d/%m/%Y') date_n FROM eleves WHERE matricule in( select eleve from inscription where classe='$sclasse' and annee='$annee')";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$matricule=$lignecl['matricule'];
$prenom=$lignecl['prenom'];
$nom=$lignecl['nom'];
$lieu=$lignecl['lieu_nais'];
$date_nais=$lignecl['date_n'];
$ele=$prenom.' '.$nom;
$dt=$date_nais.' à '.$lieu;
$sqlstm1el="select moyenne from moyennes where annee='$annee' and semestre='S1' and eleve='$matricule'";
$reqel=mysql_query($sqlstm1el);
$ligneel=mysql_fetch_array($reqel);
{
$ms1=$ligneel['moyenne'];
}
 $sqlstm1gaz100="select moyenne from moyennes where annee='$annee' and semestre='S2' and eleve='$matricule'";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$ms2=$ligne10u14gaz100['moyenne'];
}
$exess1=mysql_query("select valeur  from formules");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $val=$roi1["valeur"];
				 }
				 if($val==3)
$moye=@round(($ms1+$ms2*2)/3,3);
else
$moye=@round(($ms1+$ms2)/2,3);
//$nbabsent=$nbre_eleve-$nbrel;

 $sqlstm1rq="SELECT mini FROM decisions where decisions.etude = (select distinct classes.etude from classes where libelle='$sclasse' and annee='$annee')and libelle='ADMIS(E) EN CLASSE SUPÉRIEURE' ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	$debutrq=$lignerq['mini'];
       } 
if($moye>=$debutrq){
	   $b="$ele;$dt;$moye\r\n";
		                      fwrite($fichier,$b);         
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$prenom.' '.$nom.'&nbsp;</B></FONT></TD>';
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$date_nais.' à '.$lieu.'&nbsp;</B></FONT></TD>';

echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$moye.'</TD>';
echo"</tr>";
}
}
  fclose($fichier);
echo'</table>';

?>
<div>          
<a href="impression/impression.php?id=<?php echo $annee;?>&sem=<?php echo $sclasse;?>&page=<?php echo 'RESULTATPASSANT';?>" target="_blank" class=imp>Apperçu</a>
</div>
<?php
 }
?>

<?php
function resultatrebouble($classe,$annee){
$sclasse=$classe;
//$personnel=$personnel;
$annee=$annee;
$nb=0;
$nbrel=0;
$mi=0;
$ma=0;
$somoy=0;
  /*$exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }*/
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste des redoublants pour l'année académique <?php echo $annee.' de la classe de '.$sclasse;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Eléve&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date de Naissance&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Moyenne Annuelle&nbsp;</B></FONT></TD>';

 $nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
						//$b="ELEVES;DATE DE NAISSANCE;MOYENNE ANNUELLE\r\n";
              				//fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="SELECT matricule,prenom,nom,lieu_nais,date_format(date_nais,'%d/%m/%Y') date_n FROM eleves WHERE matricule in( select eleve from inscription where classe='$sclasse' and annee='$annee')";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$matricule=$lignecl['matricule'];
$prenom=$lignecl['prenom'];
$nom=$lignecl['nom'];
$lieu=$lignecl['lieu_nais'];
$date_nais=$lignecl['date_n'];
$ele=$prenom.' '.$nom;
$dt=$date_nais.' à '.$lieu;
$sqlstm1el="select moyenne from moyennes where annee='$annee' and semestre='S1' and eleve='$matricule'";
$reqel=mysql_query($sqlstm1el);
$ligneel=mysql_fetch_array($reqel);
{
$ms1=$ligneel['moyenne'];
}
 $sqlstm1gaz100="select moyenne from moyennes where annee='$annee' and semestre='S2' and eleve='$matricule'";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$ms2=$ligne10u14gaz100['moyenne'];
}
$exess1=mysql_query("select valeur  from formules");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $val=$roi1["valeur"];
				 }
				 if($val==3)
$moye=@round(($ms1+$ms2*2)/3,3);
else
$moye=@round(($ms1+$ms2)/2,3);
//$nbabsent=$nbre_eleve-$nbrel;

 $sqlstm1rq="SELECT mini,maxi FROM decisions where decisions.etude = (select distinct classes.etude from classes where libelle='$sclasse' and annee='$annee')and libelle='REDOUBLE' ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	$debutrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
       } 
if($moye>=$debutrq and $moye<$finrq){
	   $b="$ele;$dt;$moye\r\n";
		                      fwrite($fichier,$b);         
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$prenom.' '.$nom.'&nbsp;</B></FONT></TD>';
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$date_nais.' à '.$lieu.'&nbsp;</B></FONT></TD>';

echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$moye.'</TD>';
echo"</tr>";
}
}
  fclose($fichier);
echo'</table>';

?>
<div>          
<a href="impression/impression.php?id=<?php echo $annee;?>&sem=<?php echo $sclasse;?>&page=<?php echo 'RESULTATREDOUBLE';?>" target="_blank" class=imp>Apperçu</a>
</div>
<?php
 }
?>
<?php
function resultatexclus($classe,$annee){
$sclasse=$classe;
//$personnel=$personnel;
$annee=$annee;
$nb=0;
$nbrel=0;
$mi=0;
$ma=0;
$somoy=0;
  /*$exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }*/
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste des Exclus pour l'année académique <?php echo $annee.' de la classe de '.$sclasse;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Eléve&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date de Naissance&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Moyenne Annuelle&nbsp;</B></FONT></TD>';

 $nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
						//$b="ELEVES;DATE DE NAISSANCE;MOYENNE ANNUELLE\r\n";
              				//fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="SELECT matricule,prenom,nom,lieu_nais,date_format(date_nais,'%d/%m/%Y') date_n FROM eleves WHERE matricule in( select eleve from inscription where classe='$sclasse' and annee='$annee')";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$matricule=$lignecl['matricule'];
$prenom=$lignecl['prenom'];
$nom=$lignecl['nom'];
$lieu=$lignecl['lieu_nais'];
$date_nais=$lignecl['date_n'];
$ele=$prenom.' '.$nom;
$dt=$date_nais.' à '.$lieu;
$sqlstm1el="select moyenne from moyennes where annee='$annee' and semestre='S1' and eleve='$matricule'";
$reqel=mysql_query($sqlstm1el);
$ligneel=mysql_fetch_array($reqel);
{
$ms1=$ligneel['moyenne'];
}
 $sqlstm1gaz100="select moyenne from moyennes where annee='$annee' and semestre='S2' and eleve='$matricule'";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$ms2=$ligne10u14gaz100['moyenne'];
}
$exess1=mysql_query("select valeur  from formules");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $val=$roi1["valeur"];
				 }
				 if($val==3)
$moye=@round(($ms1+$ms2*2)/3,3);
else
$moye=@round(($ms1+$ms2)/2,3);
//$nbabsent=$nbre_eleve-$nbrel;

 $sqlstm1rq="SELECT mini,maxi FROM decisions where decisions.etude = (select distinct classes.etude from classes where libelle='$sclasse' and annee='$annee')and libelle='PROPOSÉ(E) POUR L\'EXCLUSION ' ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	$debutrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
       } 
if($moye>=$debutrq and $moye<$finrq){
	   $b="$ele;$dt;$moye\r\n";
		                      fwrite($fichier,$b);         
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$prenom.' '.$nom.'&nbsp;</B></FONT></TD>';
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$date_nais.' à '.$lieu.'&nbsp;</B></FONT></TD>';

echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$moye.'</TD>';
echo"</tr>";
}
}
  fclose($fichier);
echo'</table>';

?>
<div>          
<a href="impression/impression.php?id=<?php echo $annee;?>&sem=<?php echo $sclasse;?>&page=<?php echo 'RESULTATEXCLUS';?>" target="_blank" class=imp>Apperçu</a>
</div>
<?php
 }
?>
<?php
function resultatexam($classe,$annee){
$sclasse=$classe;
//$personnel=$personnel;
$annee=$annee;
$nb=0;
$nbrel=0;
$mi=0;
$ma=0;
$somoy=0;
  /*$exess1=mysql_query("select distinct libelle from semestres where id='$code' ");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $sem=$roi1["libelle"];
				 }*/
?>
<TABLE BORDER="0" CELLSPACING="0" align="left">
<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD align=center colspan=6 NOWRAP  ><B>&nbsp;Liste des recalés pour examen de passage pour l'année académique <?php echo $annee.' de la classe de '.$sclasse;?>.&nbsp;</B></TD>
</tr>
<TR><TD class=petit>&nbsp;</TD></tr>
<TR><TD class=petit>&nbsp;</TD></TR>
</TABLE>
</td></tr>
<TR><TD>
<?php
  echo'
   <table border="1" cellspacing="0" bordercolor="#033155" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=LEFT>
<TR>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Eléve&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date de Naissance&nbsp;</B></FONT></TD>
<TD align=center colspan=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Moyenne Annuelle&nbsp;</B></FONT></TD>';

 $nomfichier="impression/impression.txt";
      					touch($nomfichier);
        				$fichier = fopen($nomfichier, 'wb+');
						//$b="ELEVES;DATE DE NAISSANCE;MOYENNE ANNUELLE\r\n";
              				//fwrite($fichier,$b);

//}

echo'
</tr>
<tr>';


$sqlstmcl="SELECT matricule,prenom,nom,lieu_nais,date_format(date_nais,'%d/%m/%Y') date_n FROM eleves WHERE matricule in( select eleve from inscription where classe='$sclasse' and annee='$annee')";
$reqcl=mysql_query($sqlstmcl);
while($lignecl=mysql_fetch_array($reqcl))
{
$matricule=$lignecl['matricule'];
$prenom=$lignecl['prenom'];
$nom=$lignecl['nom'];
$lieu=$lignecl['lieu_nais'];
$date_nais=$lignecl['date_n'];
$ele=$prenom.' '.$nom;
$dt=$date_nais.' à '.$lieu;
$sqlstm1el="select moyenne from moyennes where annee='$annee' and semestre='S1' and eleve='$matricule'";
$reqel=mysql_query($sqlstm1el);
$ligneel=mysql_fetch_array($reqel);
{
$ms1=$ligneel['moyenne'];
}
 $sqlstm1gaz100="select moyenne from moyennes where annee='$annee' and semestre='S2' and eleve='$matricule'";
$req10mu14gaz100=mysql_query($sqlstm1gaz100);
while($ligne10u14gaz100=mysql_fetch_array($req10mu14gaz100))
{
$ms2=$ligne10u14gaz100['moyenne'];
}
$exess1=mysql_query("select valeur  from formules");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $val=$roi1["valeur"];
				 }
				 if($val==3)
$moye=@round(($ms1+$ms2*2)/3,3);
else
$moye=@round(($ms1+$ms2)/2,3);
//$nbabsent=$nbre_eleve-$nbrel;

 $sqlstm1rq="SELECT mini,maxi FROM decisions where decisions.etude = (select distinct classes.etude from classes where libelle='$sclasse' and annee='$annee')and libelle='DOIT SUBIR UN EXAMEN DE PASSAGE ' ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	$debutrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
       } 
if($moye>=$debutrq and $moye<$finrq){
	   $b="$ele;$dt;$moye\r\n";
		                      fwrite($fichier,$b);         
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$prenom.' '.$nom.'&nbsp;</B></FONT></TD>';
echo'
<td align=center ROWSPAN=1 NOWRAP>&nbsp;'.$date_nais.' à '.$lieu.'&nbsp;</B></FONT></TD>';

echo'<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP >'.@$moye.'</TD>';
echo"</tr>";
}
}
  fclose($fichier);
echo'</table>';

?>
<div>          
<a href="impression/impression.php?id=<?php echo $annee;?>&sem=<?php echo $sclasse;?>&page=<?php echo 'RESULTATEXAM';?>" target="_blank" class=imp>Apperçu</a>
</div>
<?php
 }
?>
