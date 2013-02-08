<?php
$classe=securite_bdd($_GET['num']);
$eleve=securite_bdd($_GET['matricule']);
$annee=annee_academique();
$preanne=preannee_academique();
$cycle=lcycle($classe);
//afficher Etat civil de lélève
	$sqlstmel="SELECT prenom8,nom8,date_format(date_nais8,'%d/%m/%Y') dtn,lieu_nais8,adresse8 FROM eleves WHERE matricule='$eleve'";
	$reqel=mysql_query($sqlstmel);
	$ligneel=mysql_fetch_array($reqel);
	$prenom=$ligneel['prenom8'];
	$nom=$ligneel['nom8'];
	$date_n=$ligneel['dtn'];
	$lieu=$ligneel['lieu_nais8'];
	$adresse=$ligneel['adresse8'];
//vérifier si l'élève a fait une évaluation
	$reqelea=findByNValue("notes","notes.eleve='$eleve' and evaluation in(select id from evaluations where annee='$annee'and classe='$classe')");
	$nbea=mysql_num_rows($reqelea);
//vérifier sil a des notes de composition pour le premier semestre
	$nb1=verifNcomposotion($eleve,$annee,$classe,"S1");
//vérifier sil a des notes de composition pour le SECOND semestre
	$nb2=verifNcomposotion($eleve,$annee,$classe,"S2");
// recup info établissement
	$req9=findByAll("etablissements");
	$ligne9=mysql_fetch_array($req9);
	$eta=$ligne9['libelle'];
	$ia=$ligne9['ia'];
	$iden=$ligne9['iden'];
//lister les évaluations déja réalisée et notée
	$sqlstm1="select id,date_format(date_prevue,'%d/%m/%Y') affi,discipline,type,semestre from evaluations where id in (select evaluation from notes where eleve='$eleve') and annee='$annee' and classe='$classe'
	order by discipline,semestre,type desc ,date_prevue  ";
	$req1=mysql_query($sqlstm1);
//moyenne du premier semestre
	$moy1=moyennesem($eleve,$annee,"S1");
//moyenne du second semestre
	$moy2=moyennesem($eleve,$annee,"S2");	
//calcule de la moyenne annuelle
	$sqlformoy=mysql_query("select valeur  from formules");
    $formmoy=mysql_fetch_array($sqlformoy);
	$formule=$formmoy["valeur"];
		if($formule ==3)
		$note_finale=round(($moy1+$moy2*2)/3,3);
		else
		$note_finale=round(($moy1+$moy2)/2,3);
// Décision du conseil de classe
	$sqlsdecision="SELECT id,libelle FROM decisions where  etude='".niveauE($classe)."' ";
	$reqdecision=mysql_query($sqlsdecision);
	//verifier si l'éleve est un redoublant ou pas
	$redoublant=redoublant($eleve,$classe,$annee);
 ?>
<form name="inscription_form" action="<?php echo lien() ?>" method="post"onsubmit='return (conform(this));' >
<input name="action" value="submit" type="hidden">
<div class="formbox">
	<table border="0" cellpadding="3" cellspacing="0" width="600" >
		<tbody><tr>
			<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP width="200">&nbsp;Notes <SELECT NAME="libelle1" id="libelle1" required
placeholder="Selectionner" autofocus/  onchange="submit();" >
<OPTION >Selectionner</OPTION>
 <?php
 if($nbea<>0)
{
 echo' <OPTION value="CARNET"> CARNET DE NOTES</OPTION>';
 }
  if(verifNcomposotion($eleve,$annee,$classe,"S1")<>0)
{
 echo' <OPTION value="BULLETINS1"> BULLETIN DU PREMIER SEMESTRE</OPTION>';
 }
  if(verifNcomposotion($eleve,$annee,$classe,"S2")<>0)
{
 echo' <OPTION value="BULLETINS2"> BULLETIN DU SECOND SEMESTRE</OPTION>';
 }
  if((verifNcomposotion($eleve,$annee,$classe,"S1")<>0) and (verifNcomposotion($eleve,$annee,$classe,"S2")<>0))
{
 echo' <OPTION value="DOSSIERBAC"> DOSSIER DE BAC</OPTION>';
 }

  if(@$_POST["libelle1"]<>"") {
 $choix_notes=$_POST["libelle1"];
 switch ($choix_notes)
	{
	case 'CARNET':
    // carnet de notes  				
 //if($choix_notes=="CARNET"){ 
echo'
	 <tr><TD class=petit>&nbsp;</TD></tr>
	 <tr><td>
	<table border="1" cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" bgcolor="#EFF2FB" width=100 ALIGN=left>
	<TR>
	<TD align=center colspan=5 NOWRAP  ><B>&nbsp; Carnet de Notes de l\'éléve '.$prenom.' '.$nom.'&nbsp;</B></TD>
	</tr>
	<TR>
	<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date Evaluation&nbsp;</B></FONT></TH>
	<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
	<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Type&nbsp;</B></FONT></TH>
	<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Note&nbsp;</B></FONT></TH>
	<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Semestre&nbsp;</B></FONT></TH>
	</TR>';
	while($ligne=mysql_fetch_array($req1))
	{
		$eva=$ligne['id'];
		$date_af=$ligne['affi'];
		$dis=$ligne['discipline'];
		$type=$ligne['type'];
		$se=$ligne['semestre'];
		//note evaluation
		$sq="SELECT note FROM notes WHERE eleve='$eleve' and evaluation='$eva'";
		$re=mysql_query($sq);
		$li=mysql_fetch_array($re);
		$note=$li['note'];		
		//discipline composée
$disciple = explode("D", $dis);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
					
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$discipline=$tit[1];
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$sousd;
						else
						$affi=$discipline;
		echo'
		<TD ALIGN=left ROWSPAN=1 NOWRAP>'. $date_af.'&nbsp;</a></TD>
		<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'. $affi.'&nbsp;</a></TD>
		<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$type.'&nbsp;</TD>
		<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'. $note.'&nbsp;</TD>
		<TD ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.libelle_semestre($se).'&nbsp;</TD>
		</TR>';
	}
	 echo'</TABLE></td></tr><table>
<div><a href="forms/imprimer/notes.php?classe='.$classe.'&eleve='.$eleve.'&choix='.$choix_notes.'" target="_blank" class=imp>Aper&ccedil;u</a>
</div></table>';

// }
 break;
 //bulletin du premier semestre
 case 'BULLETINS1':
 //elseif($choix_notes=="BULLETINS1"){

  $se="S1";
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
echo'
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">
<tr><TD class="petit">&nbsp;</TD></tr>
<Tr align="center">
<Td ROWSPAN="1" ALIGN="LEFT" NOWRAP><b>MINISTERE DE L\'EDUCATION NATIONALE</b></Td>
</Tr>
<Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>IA : '. $ia.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>IEF : '. $iden.'</b></Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr><Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>ETABLISSEMENT : '.$eta.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>Cycle : '.lcycle($classe).'</b></Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td colspan="8"><b>&nbsp;BULLETIN DE NOTES DU '.libelle_semestre($se).' DE L\'ANNEE ACADEMIQUE '.$annee.'</b></Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr>
<Tr>
<Td  ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Prénom :<b>&nbsp;'. $prenom.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Nom:<b>&nbsp;'. $nom.'</b></Td>
</Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Né(e) le :<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$date_n.' à '.$lieu.'</b></Td>
</Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Classe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'. libclasse($classe).'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Effectif :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'. Effectifclasse($classe,$annee).'</b></Td></Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Nbre Absence:&nbsp;&nbsp;&nbsp;<b>'.absenceeleve($eleve,$annee,$se).'</b></Td></Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Nbre Retard:&nbsp;&nbsp;&nbsp;<b>'.retardeleve($eleve,$annee,$se).'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Redoublant :&nbsp;&nbsp;&nbsp;<b>'.redoublant($eleve,$classe,$annee).'</b></Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr></table>';
 echo'
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100" ALIGN="center">
<Tr>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;TH&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Appréciations&nbsp;</B></FONT></TH>

</Tr>';

$nc=0;
$div1=1;
//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe')");

//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
echo'<Tr>';
$discipline=$lignecoef['discipline'];

$disciple = explode("D", $discipline);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
			//connaite le lv2 de léléve
			$selection1 = findByNValue('inscription',"eleve='$eleve' and annee='$annee'");
$rowlv1 = mysql_fetch_row($selection1);
$lv2=$rowlv1[7];
//discipline au niveau du crédit horaire
$selection1c = findByNValue('credit_horaire',"idch='$lv2'");
$rowlv1c = mysql_fetch_row($selection1c);
$lv2c=$rowlv1c[1];

				//gestion credit horaire
$selection = findByNValue('credit_horaire',"credit_horaire.etude in(select etude from classes where idclasse='$classe') and discipline='$iddis'");
$row1 = mysql_fetch_row($selection);
$idnature=$row1[5];
$t_nature = findByValue('nature','idnature',$idnature);
						$val_nature = mysql_fetch_row($t_nature);
						$nature=$val_nature[1];
if(($nature=='Autres') or ($nature=='Langue vivante I') or $lv2c==$iddis){
$coef=$lignecoef['coef'];
$soc=$soc+$coef;
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$disciplines=$tit[1];
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$sousd;
						else
						$affi=$disciplines;
						if($lv2c==$iddis)
						$disciple='L.V. II : '.$affi;
						else 
						$disciple=$affi;
						//}
echo'
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$disciple.'&nbsp;</Td>';

//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve' and note<>'ABS'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];
if($md=='')
$moyd='ABS';
else
$moyd=$md;
//note composition

$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
if($nc<>'ABS' and $moyd<>'ABS')
$ms=($moyd+$nc)/2;
elseif($nc=='ABS' and $moyd<>'ABS')
$ms=$moyd;
elseif($nc<>'ABS' and $moyd=='ABS')
$ms=$nc;
$tp=$ms*$coef;
$son=$son+$tp;
//gestion remarque
$sqere="select libelle,th   from apreciation_prof where eleve='$eleve' and semestre='$se' and discipline='$discipline'
and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
	$rem=$ligere['libelle'];
	$th=$ligere['th'];


echo'

<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$moyd.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $nc.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $ms.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$coef.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $tp.'&nbsp;</Td>
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$th.'&nbsp;</Td> 
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$rem.'&nbsp;</Td> 
</Tr>';
}
}
//echo'</table>';

if(Econduite($cycle)<>0){
$sct="SELECT sum(note),count(personnel),round(sum(note)/count(personnel),3) nt FROM note_conduite WHERE annee='$annee'and semestre='$se'and eleve='$eleve'";
$rct=mysql_query($sct);
$lct=mysql_fetch_array($rct);
$conduite=$lct['nt'];
echo'<Tr>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Conduite &nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;'. $conduite.'&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;1&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;'. $conduite.'&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> 
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
</Tr>';

$tpoint=$son+$conduite;
$tcoef=$soc+1;

}
else{
$tpoint=$son;
$tcoef=$soc;
}
$fi=round($tpoint/$tcoef,3);
$sqserang ="select count(eleve) nbre from moyennes where  annee='$annee' and semestre='$se' and moyenne>'$fi'  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$rg=$rang['nbre']+1;
	
$place=$rg.'éme/ '.Effectifclasse($classe,$annee).' Eléves';

echo'
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b> Total &nbsp;</b></Td>

<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tcoef.'&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP colspan="2">&nbsp;<b>'. $tpoint.'&nbsp;</b></Td>
</Tr>
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne &nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $fi.'&nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>RANG &nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$rg.'éme/ '.Effectifclasse($classe,$annee).' Eléves &nbsp;</b></Td>

<Td ALIGN="left" ROWSPAN="1" NOWRAP colspan="4"> &nbsp;</Td>
</Tr><Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
</Tr><Tr>';
//avoir la min de la borne max supérieur a la moyenne
$sqre="select min(maxi) mm from honneurs where maxi>='$fi'";
$rere=mysql_query($sqre);
$ligee=mysql_fetch_array($rere);
	$maxinote=$ligee['mm'];
if($fi>10){
$minnote=10;
//$maxinote=round($fi+1,0);
$condition=" mini>=$minnote and maxi<= $maxinote ";
}
else{
$condition="mini>=$fi and maxi<=$maxinote ";
}
$sqere="select libelle1   from honneurs where ".$condition;
$reere=mysql_query($sqere);
while($ligere=mysql_fetch_array($reere)){
	$ho=$ligere['libelle1'];
	echo'<Td ALIGN="left" ROWSPAN="1" colspan="2" NOWRAP>&nbsp;<b>'. $ho.'</b>&nbsp;</Td>';
}
echo'
</Tr><Tr>

<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</Tr>';
	
$sqlstm1rq="SELECT libelle1,mini,maxi FROM remarques ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	echo'<Tr>';
	$libellerq=$lignerq['libelle1'];
	$debuTrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
echo'
<td align="center" ROWSPAN="1" NOWRAP>&nbsp;'. $libellerq.'&nbsp;</Td>';

$val="X";
$sqlstm11000="select libelle1 quant from remarques where  mini<='$fi' and maxi>'$fi' and libelle1='$libellerq'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$nombre1000=$ligne10u141000['quant'];
if(mysql_num_rows($req10mu141000)==0){
$val="-";
}
echo'<Td ALIGN="center" ROWSPAN="1" NOWRAP ><B>&nbsp;'.$val.'&nbsp;</B></Td></Tr>';
}
echo'</table>

<table>
<div><a href="forms/imprimer/notes.php?classe='.$classe.'&eleve='.$eleve.'&choix='.$choix_notes.'" target="_blank" class=imp>Aper&ccedil;u</a>
</div></table>';

 //}
 
  break;
  //bulletin du second semestre
   case 'BULLETINS2':
 // elseif($choix_notes=="BULLETINS2"){

$se="S2";
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
echo'
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">
<tr><TD class="petit">&nbsp;</TD></tr>
<Tr align="center">
<Td ROWSPAN="1" ALIGN="LEFT" NOWRAP><b>MINISTERE DE L\'EDUCATION NATIONALE</b></Td>
</Tr>
<Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>IA : '. $ia.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>IEF : '. $iden.'</b></Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr><Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>ETABLISSEMENT : '.$eta.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>Cycle : '.$cycle.'</b></Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td><b>&nbsp;BULLETIN DE NOTES DU '.libelle_semestre($se).' DE L\'ANNEE ACADEMIQUE '.$annee.'</b></Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr>
<Tr>
<Td  ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Prénom :<b>&nbsp;'. $prenom.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Nom:<b>&nbsp;'. $nom.'</b></Td>
</Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Date et lieu de Naissance:<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$date_n.' à '.$lieu.'</b></Td>
</Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Classe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'. libclasse($classe).'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Effectif :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'. Effectifclasse($classe,$annee).'</b></Td></Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Nbre Absence:&nbsp;&nbsp;&nbsp;<b>'.absenceeleve($eleve,$annee,$se).'</b></Td></Tr><Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Nbre Retard:&nbsp;&nbsp;&nbsp;<b>'.retardeleve($eleve,$annee,$se).'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Redoublant :&nbsp;&nbsp;&nbsp;<b>'.redoublant($eleve,$classe,$annee).'</b></Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr></table>';
 echo'
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100" ALIGN="center">
<Tr>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Appréciations&nbsp;</B></FONT></TH>
</Tr>';

$nc=0;
$div1=1;
//connaiTre  coef,uv suivant la classe de l'élève en question 
//$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe' )");

//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
echo'<Tr>';
$discipline=$lignecoef['discipline'];
$disciple = explode("D", $discipline);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
					
			//connaite le lv2 de léléve
			$selection1 = findByNValue('inscription',"eleve='$eleve' and annee='$annee'");
$rowlv1 = mysql_fetch_row($selection1);
$lv2=$rowlv1[7];
//discipline au niveau du crédit horaire
$selection1c = findByNValue('credit_horaire',"idch='$lv2'");
$rowlv1c = mysql_fetch_row($selection1c);
$lv2c=$rowlv1c[1];

				//gestion credit horaire
$selection = findByNValue('credit_horaire',"credit_horaire.etude in(select etude from classes where idclasse='$classe') and discipline='$iddis'");
$row1 = mysql_fetch_row($selection);
$idnature=$row1[5];
$t_nature = findByValue('nature','idnature',$idnature);
						$val_nature = mysql_fetch_row($t_nature);
						$nature=$val_nature[1];
if(($nature=='Autres') or ($nature=='Langue vivante I') or $lv2c==$iddis){
$coef=$lignecoef['coef'];
$soc=$soc+$coef;
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$disciplines=$tit[1];
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$sousd;
						else
						$affi=$disciplines;
						if($lv2c==$iddis)
						$disciples='L.V. II : '.$affi;
						else 
						$disciples=$affi;

echo'
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'. $disciples.'&nbsp;</Td>';

//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve' and note<>'ABS'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];
if($md=='')
$moyd='ABS';
else
$moyd=$md;
//note composition

$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
$ms=($md+$nc)/2;
if($nc<>'ABS' and $moyd<>'ABS')
$ms=($moyd+$nc)/2;
elseif($nc=='ABS' and $moyd<>'ABS')
$ms=$moyd;
elseif($nc<>'ABS' and $moyd=='ABS')
$ms=$nc;
$tp=$ms*$coef;
$son=$son+$tp;
//gestion remarque
$sqere="select libelle   from apreciation_prof where eleve='$eleve' and semestre='$se' and discipline='$discipline'
and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
	$rem=$ligere['libelle'];
//gestion appréciation	
$sqeap="select libelle1   from apreciations where mini<='$ms' and maxi<'$ms' ";
$reeap=mysql_query($sqeap);
$ligeap=mysql_fetch_array($reeap);
	$apr=$ligeap['libelle1'];

echo'

<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$moyd.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $nc.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $ms.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$coef.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $tp.'&nbsp;</Td>
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$rem.'&nbsp;</Td> 
</Tr>';
}
}
//echo'</table>';

if(Econduite($cycle)<>0){
$sct="SELECT sum(note),count(personnel),round(sum(note)/count(personnel),3) nt FROM note_conduite WHERE annee='$annee'and semestre='$se'and eleve='$eleve'";
$rct=mysql_query($sct);
$lct=mysql_fetch_array($rct);
$conduite=$lct['nt'];
echo'<Tr>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Conduite &nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;'. $conduite.'&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;1&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;'. $conduite.'&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> 
</Tr>';

$tpoint=$son+$conduite;
$tcoef=$soc+1;

}
else{
$tpoint=$son;
$tcoef=$soc;
}
$fi=round($tpoint/$tcoef,3);

$sqserang ="select count(eleve) nbre from moyennes where  annee='$annee' and semestre='$se' and moyenne>'$fi'  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$rg=$rang['nbre']+1;
	
$place=$rg.'éme/ '.Effectifclasse($classe,$annee).' Eléves';

echo'
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b> Total &nbsp;</b></Td>

<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tcoef.'&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tpoint.'&nbsp;</b></Td>
</Tr>
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne Semestrielle &nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $fi.'&nbsp;</b></Td>
</Tr><Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>RANG &nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$rg.'éme/ '.Effectifclasse($classe,$annee).' Eléves &nbsp;</b></Td>
</Tr><Tr>';
//avoir la min de la borne max supérieur a la moyenne
$sqre="select min(maxi) mm from honneurs where maxi>='$fi'";
$rere=mysql_query($sqre);
$ligee=mysql_fetch_array($rere);
	$maxinote=$ligee['mm'];
if($fi>10){
$minnote=10;
//$maxinote=$fi+1;
$condition=" mini>=$minnote and maxi<= $maxinote ";
}
else{
$condition="mini>=$fi and maxi<=$maxinote ";
}
$sqehonneur="select id,libelle1 from honneurs where ".$condition;
$reerehonneur=mysql_query($sqehonneur);
	while($ligerehonneur=mysql_fetch_array($reerehonneur)){
	$ho=$ligerehonneur['libelle1'];
	$idh=$ligerehonneur['id'];
	$eg="<b>";$ceg="</b>";
	echo'<Td ALIGN="left" ROWSPAN="1" colspan="1" NOWRAP>'.$eg.'&nbsp;'. $ho.'&nbsp;'.$ceg.'</Td>';
	}
echo'
</Tr><Tr>
<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</Tr><tr>
<Td ALIGN="MIDDLE" ROWSPAN="3" colspan="5" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne Premier Semestre</b>&nbsp;</Td>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$moy1.'&nbsp;</big></Td>
</tr><tr>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne Second Semestre&nbsp;</Td>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$moy2.'&nbsp;</Td>
</tr><tr>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne Générale&nbsp;</b></Td>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$note_finale.'</b>&nbsp;</Td>
</tr><tr>
<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr><tr>
<Td ALIGN="MIDDLE" ROWSPAN="1" NOWRAP colspan="3">&nbsp;<b>DECISION DU CONSEIL &nbsp;</b></Td>
<Td ALIGN="MIDDLE" ROWSPAN="5" colspan="4" NOWRAP>&nbsp;<b>L\'ADMINISTRATION&nbsp;</Td>
</tr>';
while($lignerq=mysql_fetch_array($reqdecision))
{
	echo'<Tr>';
	$idec=$lignerq['id'];
	$libellerq=$lignerq['libelle'];

echo'
<Td align="center" ROWSPAN="1" NOWRAP>&nbsp;'. $libellerq.'&nbsp;</Td>';

$val="X";
$sqlstm11000="select libelle quant from decisions where  mini<='$note_finale' and maxi>'$note_finale' and id='$idec'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$nombre1000=$ligne10u141000['quant'];
if(mysql_num_rows($req10mu141000)==0){
$val="-";
}

echo'<Td ALIGN="center" ROWSPAN="1" NOWRAP ><B>&nbsp;'.$val.'&nbsp;</B></Td></Tr>';
}
echo'</table><table>
<div><a href="forms/imprimer/notes.php?classe='.$classe.'&eleve='.$eleve.'&choix='.$choix_notes.'" target="_blank" class=imp>Aper&ccedil;u</a>
</div></table>';
 //}
 
 break;
 //Dossier de bac
  case 'DOSSIERBAC':
 //  elseif($choix_notes=="DOSSIERBAC"){
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
echo'
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">
<Tr><Td class="petit">&nbsp;</Td></Tr>

<Tr><Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Nom:<b>&nbsp;'. $nom.'</b></Td></Tr>
<Tr>
<Td  ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Prénom :<b>&nbsp;'. $prenom.'</b></Td>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Adresse des Parents ou du tuteur:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'. $adresse.'</b></Td>
</Tr>

<Tr><Td class="petit">&nbsp;</Td></Tr></table>';
 echo'
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100" ALIGN="center">
<Tr>
<TH align="center" ROWSPAN="4" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline <br> Notes sur 20&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="4" NOWRAP><FONT COLOR="black"><B>&nbsp;Sem&nbsp;</B></FONT></TH></Tr><tr>
<TH align="center" ROWSPAN="1"  colspan="6"NOWRAP><FONT COLOR="black"><B>&nbsp;N=notes - R=rang - T=Nombre d\'éleve dans la discipline&nbsp;</B></FONT></TH>
</tr><tr>
<TH align="center" ROWSPAN="1" colspan="3" NOWRAP><FONT COLOR="black"><B>&nbsp;'.libclasse($classe).'&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" colspan="3" NOWRAP><FONT COLOR="black"><B>&nbsp;Redoublement&nbsp;</B></FONT></TH></tr>
<tr>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Note&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Rang&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;T&nbsp;</B></FONT></TH>

<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Note&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Rang&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;T&nbsp;</B></FONT></TH>
</Tr>';
//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe' )");
//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
echo'<Tr>';
$discipline=$lignecoef['discipline'];
$coef=$lignecoef['coef'];
$soc=$soc+$coef;

$disciple = explode("D", $discipline);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
						//connaite le lv2,lv1,lc de léléve
			$selection1 = findByNValue('inscription',"eleve='$eleve' and annee='$annee'");
$rowlv = mysql_fetch_row($selection1);
$lv1=$rowlv[6];
$lv2=$rowlv[7];
$lc=$rowlv[8];
//discipline au niveau du crédit horaire du lv1
$selection1v1 = findByNValue('credit_horaire',"idch='$lv1'");
$rowlv1 = mysql_fetch_row($selection1v1);
$lv1c=$rowlv1[1];
//discipline au niveau du crédit horaire du lv2
$selection1v2 = findByNValue('credit_horaire',"idch='$lv2'");
$rowlv2 = mysql_fetch_row($selection1v2);
$lv2c=$rowlv2[1];
//discipline au niveau du crédit horaire du lc
$selection1c = findByNValue('credit_horaire',"idch='$lc'");
$rowlv1c = mysql_fetch_row($selection1c);
$lvc=$rowlv1c[1];
				//gestion credit horaire
$selection = findByNValue('credit_horaire',"credit_horaire.etude in(select etude from classes where idclasse='$classe') and discipline='$iddis'");
$row1 = mysql_fetch_row($selection);
$idnature=$row1[5];
$t_nature = findByValue('nature','idnature',$idnature);
						$val_nature = mysql_fetch_row($t_nature);
						$nature=$val_nature[1];
if(($nature=='Autres') or ($lv1c==$iddis) or ($lv2c==$iddis) or ($lvc==$iddis)){
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$disciplines=$tit[1];
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=$sousmat[1];
						if($sousd<>"")
						$affi=$disciplines.' : '.$sousd;
						else
						$affi=$disciplines;
	if($lv1c==$iddis)
	$disciples='Langue vivante I : '.$affi;// afficher le lc1
	elseif($lv2c==$iddis)
	$disciples='Langue vivante  II : '.$affi;// afficher le lc2
	elseif($lvc==$iddis)
	$disciples='Langue classique : '.$affi;// afficher le lc2
	else 
	$disciples=$affi;		
			

echo'
<Td ALIGN="left" ROWSPAN="3" NOWRAP>&nbsp;'.$disciples.'&nbsp;</Td>';


if($redoublant=='OUI'){
//total devoir + moyenne devoir pour le premier semestre de l'année précédente
$control1=moyennecontrole("S1",$discipline,$eleve,$classe,$preanne);
$notecomp1=notecomposition($classe,$preanne,"S1",$discipline,$eleve);
$moy1=($control1+$notecomp1)/2;
$rang1=rangeleveDiscipline($preanne,"S1",$moy1,$discipline);
$nbreleve1=nombreeleveDiscipline($preanne,"S1",$classe,$discipline);
//pour le second semestre de l'année précédente
$control2=moyennecontrole("S2",$discipline,$eleve,$classe,$preanne);
$notecomp2=notecomposition($classe,$preanne,"S2",$discipline,$eleve);
$moy2=($control2+$notecomp2)/2;
$nbreleve2=nombreeleveDiscipline($preanne,"S2",$classe,$discipline);
$rang2=rangeleveDiscipline($preanne,"S2",$moy2,$discipline);
//total devoir + moyenne devoir pour le premier semestre
$controls1=moyennecontrole("S1",$discipline,$eleve,$classe,$annee);
$notecomps1=notecomposition($classe,$annee,"S1",$discipline,$eleve);
$moys1=($controls1+$notecomps1)/2;
$rangs1=rangeleveDiscipline($annee,"S1",$moys1,$discipline);
$nbreleves1=nombreeleveDiscipline($annee,"S1",$classe,$discipline);
//pour le second semestre
$controls2=moyennecontrole("S2",$discipline,$eleve,$classe,$annee);
$notecomps2=notecomposition($classe,$annee,"S2",$discipline,$eleve);
$moys2=($controls2+$notecomps2)/2;
$rangs2=rangeleveDiscipline($annee,"S2",$moys2,$discipline);
$nbreleves2=nombreeleveDiscipline($annee,"S2",$classe,$discipline);
}
else{
//total devoir + moyenne devoir pour le premier semestre
$control1=moyennecontrole("S1",$discipline,$eleve,$classe,$annee);
$notecomp1=notecomposition($classe,$annee,"S1",$discipline,$eleve);
$moy1=($control1+$notecomp1)/2;
$rang1=rangeleveDiscipline($annee,"S1",$moy1,$discipline);
$nbreleve1=nombreeleveDiscipline($annee,"S1",$classe,$discipline);
//pour le second semestre
$control2=moyennecontrole("S2",$discipline,$eleve,$classe,$annee);
$notecomp2=notecomposition($classe,$annee,"S2",$discipline,$eleve);
$moy2=($control2+$notecomp2)/2;
$rang2=rangeleveDiscipline($annee,"S2",$moy2,$discipline);
$nbreleve2=nombreeleveDiscipline($annee,"S2",$classe,$discipline);
$moys1="";
$moys2="";
$rangs2="";
$rangs1="";
$nbreleves1="";
$nbreleves2="";
}
echo'<tr><td>1er Sem</td><td ALIGN="center">'.$moy1.'</td><td ALIGN="center">'.$rang1.'</td><td ALIGN="center">'.$nbreleve1.'</td>
<td ALIGN="center">'.$moys1.'</td><td ALIGN="center">'.$rangs1.'</td><td ALIGN="center">'.$nbreleves1.'</td>
</tr>
<tr><td>2e Sem</td><td ALIGN="center">'. $moy2.'</td><td ALIGN="center">'.$rang2.'</td><td ALIGN="center">'.$nbreleve2.'</td><td ALIGN="center">'.$moys2.'</td><td ALIGN="center">'.$rangs2.'</td><td ALIGN="center">'.$nbreleves2.'</td>
</tr>';
echo'<Tr>';
}
}
echo'</table><table>
<div><a href="forms/imprimer/notes.php?classe='.$classe.'&eleve='.$eleve.'&choix='.$choix_notes.'" target="_blank" class=imp>Aper&ccedil;u</a>
</div></table>';
 //}
 break;
} 
}
echo'
<div>&nbsp;&nbsp;&nbsp;</div>


</SELECT></Td>
</Tr>
<Tr><Td class=petit>&nbsp;</Td></Tr>

	</tbody>
	</table>
</div>

</form>';
?>
