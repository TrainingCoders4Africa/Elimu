<?php
include '/../../dao/connection.php';
include '/../../dao/select.php';
$classe=securite_bdd($_GET["classe"]);
$eleve=securite_bdd($_GET["eleve"]);//matricule élève
$choix=securite_bdd($_GET["choix"]);//carnet de note ou bulletin de note
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
	$adresse=$ligne9['adresse'];
	$tel=$ligne9['tel'];
	$fax=$ligne9['faxe'];
	$mail=$ligne9['mail'];
	$site=$ligne9['web'];
	$bp=$ligne9['bp'];
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
	//pied de page du fichier pdf
$t_print=' <page_footer>
        <table style="width: 100%;">
            <tr>
                <Td style="text-align: left;    width: 50%">Adresse : '.utf8_encode($adresse).'</Td>
                <Td style="text-align: right;    width: 50%">Fax : '.$fax.'</Td>
            </tr>
			<tr>
			<Td style="text-align: left;    width: 50%">Tel : '.$tel.'</Td>
			<Td style="text-align: right;    width: 50%">BP : '.$bp.'</Td>
			</tr>
			<tr>
			<Td style="text-align: left;    width: 50%">Email : '.$mail.'</Td>
			<Td style="text-align: right;    width: 50%">Web : '.$site.'</Td>
			</tr>
        </table>
    </page_footer>';
	switch ($choix)
	{
	case 'CARNET':
	// le carnet de note de l'éleve
$t_print.='
	<table border="1" cellspacing="0"  cellpadding="2" width="100" ALIGN="center">
	<Tr>
	<Td align="center" colspan="5" NOWRAP  ><B>&nbsp; Carnet de Notes de '.$prenom.' '.$nom.' de la '.libclasse($classe).'</B></Td>
	</tr>
	<Tr>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT ><B>&nbsp;Date Evaluation&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT ><B>&nbsp;Disciplines&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT><B>&nbsp;Type&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT><B>&nbsp;Notes&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT ><B>&nbsp;Semestres&nbsp;</B></FONT></TH>
	</Tr>';//$t_print.
	while($ligne=mysql_fetch_array($req1))
	{
	$t_print.='<tr>';
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
			
			$disciple = explode("D", $dis);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
					
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$disciplines=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")//$disciplines.': '.
						$affi=$sousd;
						else
						$affi=$disciplines;

		$t_print.='<Td ALIGN="left" ROWSPAN="1" NOWRAP>'. $date_af.'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'. $affi.'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'.$type.'</Td>
		<Td ALIGN="center" ROWSPAN="1" NOWRAP>'. $note.'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'.libelle_semestre($se).'</Td>
		</Tr>';
	}
	$t_print.='</table>';
break;

//Bulletin du premier semestre
case 'BULLETINS1':
  $se="S1";
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
//journée début  
$t_print.='
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="left" border="0">
<tr><Td class="petit">&nbsp;</Td></tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>IA '. $ia.'</Td><Td class="petit">&nbsp;</Td><Td class="petit">&nbsp;</Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>'.utf8_encode("Année").' Scolaire : '. $annee.'</Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>IEF '. utf8_encode($iden).'</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>'. libelle_semestre($se).'</Td>
</Tr>
<Tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>'.utf8_encode($eta).'</b></Td>
</Tr>
</table>
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">
<Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr><Td ROWSPAN=1 ><HR width=100%></Td></Tr>
<Tr>
<Td ALIGN="center" ><b>&nbsp;BULLETIN DE NOTES</b></Td>
</Tr>
<Tr><Td ROWSPAN=1 ><HR width=100%></Td></Tr>
</table>
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="left" border="0">

<Tr>
<Td class="petit">&nbsp;</Td>
</Tr>
<Tr>
<Td  ROWSPAN="1"  ALIGN="left" NOWRAP >&nbsp;'.utf8_encode("Prénom").':<b>&nbsp;'. $prenom.'</b></Td>
<Td ROWSPAN="1"  ALIGN="right" NOWRAP >&nbsp;Nom:<b>&nbsp;'. $nom.'</b></Td>
</Tr><Tr><Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="left" NOWRAP>&nbsp;'.utf8_encode("Né(e)").' le :&nbsp;&nbsp;&nbsp;'.$date_n.' '.utf8_encode("à") .' '.accents($lieu).'</Td>
<Td ROWSPAN="1"  ALIGN="right" NOWRAP>&nbsp;Classe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. libclasse($classe).'</Td>
</Tr><Tr><Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="left" NOWRAP>&nbsp;Matricule:&nbsp;&nbsp;&nbsp;<b>'. $eleve.'</b></Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="center" NOWRAP>&nbsp;'.utf8_encode("Nbre d'élèves").' :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'. Effectifclasse($classe,$annee).'</b></Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="center" NOWRAP>&nbsp;Redoublant :&nbsp;&nbsp;&nbsp;'.redoublant($eleve,$classe,$annee).'</Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr></table>';
 $t_print.='
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100" ALIGN="left">
<Tr>
<TH align="left" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Disciplines&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;TH&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;'.utf8_encode("Appréciations").'&nbsp;</B></FONT></TH>
</Tr>';

$nc=0;
$div1=1;
//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe' )");

//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
$t_print.='<Tr>';
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
						$disciplines=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")
						$affi=$sousd;
						else
						$affi=$disciplines;
						if($lv2c==$iddis)
						$disciples='L.V. II : '.$affi;
						else 
						$disciples=$affi;
$t_print.='
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'. $disciples.'&nbsp;</Td>';

//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semesTre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve' and note<>'ABS'";
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
 evaluations.type='COMPOSITION' and evaluations.semesTre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
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
$sqere="select libelle,th   from apreciation_prof where eleve='$eleve' and semesTre='$se' and discipline='$discipline'
and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
$rem=$ligere['libelle'];
$th=$ligere['th'];
$t_print.='
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$moyd.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $nc.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $ms.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$coef.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $tp.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $th.'&nbsp;</Td>
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.accents($rem).'&nbsp;</Td> ';
}
$t_print.='</Tr>';

}
//$t_print.='</table>';

if(Econduite($cycle)<>0){
$sct="SELECT sum(note),count(personnel),round(sum(note)/count(personnel),3) nt FROM note_conduite WHERE annee='$annee'and semesTre='$se'and eleve='$eleve'";
$rct=mysql_query($sct);
$lct=mysql_fetch_array($rct);
$conduite=$lct['nt'];
$t_print.='<Tr>
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
$sqserang ="select count(eleve) nbre from moyennes where  annee='$annee' and semesTre='$se' and moyenne>'$fi'  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$rg=$rang['nbre']+1;
	
$place=$rg.'éme';

$t_print.='
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b> Total &nbsp;</b></Td>

<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tcoef.'&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tpoint.'&nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> <Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> 
</Tr>
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne  &nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $fi.'&nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Rang &nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$rg.'éme</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Retards&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;'.retardeleve($eleve,$annee,$se).'&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Absences&nbsp;</Td> 
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;'.absenceeleve($eleve,$annee,$se).'&nbsp;</Td> 
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
	$t_print.='<Td ALIGN="left" ROWSPAN="1" colspan="2" NOWRAP>&nbsp;<b>'. $ho.'</b>&nbsp;</Td>';
}
$t_print.='
</Tr><Tr>

<Td colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</Td>
</Tr>';
	
$sqlstm1rq="SELECT libelle1,mini,maxi FROM remarques ";
$req1rq=mysql_query($sqlstm1rq);
while($lignerq=mysql_fetch_array($req1rq))
{
	$t_print.='<Tr>';
	$libellerq=$lignerq['libelle1'];
	$debuTrq=$lignerq['mini'];
	$finrq=$lignerq['maxi'];
$t_print.='
<Td align="left" ROWSPAN="1" NOWRAP>&nbsp;'. $libellerq.'&nbsp;</Td>';

$val="X";
$sqlstm11000="select libelle1 quant from remarques where  mini<='$fi' and maxi>'$fi' and libelle1='$libellerq'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$nombre1000=$ligne10u141000['quant'];
if(mysql_num_rows($req10mu141000)==0){
$val="-";
}
$t_print.='<Td ALIGN="center" ROWSPAN="1" NOWRAP ><B>&nbsp;'.$val.'&nbsp;</B></Td></Tr>';
}
$t_print.='</table>';
break;
//Bulletin du second semestre
case 'BULLETINS2':
$se="S2";
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
$t_print.='
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="left" border="0">
<tr><Td class="petit">&nbsp;</Td></tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>IA '. $ia.'</Td><Td class="petit">&nbsp;</Td><Td class="petit">&nbsp;</Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>'.utf8_encode("Année").' Scolaire : '. $annee.'</Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>IEF '. utf8_encode($iden).'</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>'. libelle_semestre($se).'</Td>
</Tr>
<Tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP><b>'.utf8_encode($eta).'</b></Td>
</Tr><Tr><Td class="petit">&nbsp;</Td></Tr>
</table>
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">

<Tr><Td ROWSPAN=1 ><HR width=100%></Td></Tr>
<Tr>
<Td ALIGN="center" ><b>&nbsp;BULLETIN DE NOTES</b></Td>
</Tr>
<Tr><Td ROWSPAN=1 ><HR width=100%></Td></Tr>
</table>
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="left" border="0">

<Tr>
<Td class="petit">&nbsp;</Td>
</Tr>
<Tr>
<Td  ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;'.utf8_encode("Prénom").':<b>&nbsp;'. $prenom.'</b></Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP >&nbsp;Nom:<b>&nbsp;'. $nom.'</b></Td>
</Tr><Tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;'.utf8_encode("Né(e)").' le :&nbsp;&nbsp;&nbsp;'.$date_n.' '.utf8_encode("à") .' '.accents($lieu).'</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Classe:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. libclasse($classe).'</Td>
</Tr><Tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></Tr>
<Tr>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Matricule:&nbsp;&nbsp;&nbsp;<b>'. $eleve.'</b></Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;'.utf8_encode("Nbre d'élèves").' :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>'. Effectifclasse($classe,$annee).'</b></Td><Td class="petit">&nbsp;</Td>
<Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP>&nbsp;Redoublant :&nbsp;&nbsp;&nbsp;'.redoublant($eleve,$classe,$annee).'</Td>
</Tr><Tr>
<Td class="petit">&nbsp;</Td>
</Tr></table>';
  $t_print.='
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100" ALIGN="left">
<Tr>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;TH&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;'.utf8_encode("Appréciations").'&nbsp;</B></FONT></TH>
</Tr>';

$nc=0;
$div1=1;
//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe')");
while($lignecoef=mysql_fetch_array($reqcoef))
{
 $t_print.='<Tr>';
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
						$disciplines=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")
						$affi=$sousd;
						else
						$affi=$disciplines;
						if($lv2c==$iddis)
						$disciples='L.V. II : '.$affi;
						else 
						$disciples=$affi;
 $t_print.='
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.$disciples.'&nbsp;</Td>';
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
$sqere="select libelle,th   from apreciation_prof where eleve='$eleve' and semestre='$se' and discipline='$discipline' and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
	$rem=$ligere['libelle'];
	$th=$ligere['th'];
 $t_print.='
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$moyd.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $nc.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $ms.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$coef.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $tp.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $th.'&nbsp;</Td>
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.utf8_encode($rem).'&nbsp;</Td> ';
}
$t_print.='</Tr>';

}
// $t_print.='</table>';

if(Econduite($cycle)<>0){
$sct="SELECT sum(note),count(personnel),round(sum(note)/count(personnel),3) nt FROM note_conduite WHERE annee='$annee'and semestre='$se'and eleve='$eleve'";
$rct=mysql_query($sct);
$lct=mysql_fetch_array($rct);
$conduite=$lct['nt'];
 $t_print.='<Tr>
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

 $t_print.='
<Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b> Total &nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tcoef.'&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $tpoint.'&nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> <Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td> 
</Tr><Tr >
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>Moyenne  &nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'. $fi.'&nbsp;</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Rang &nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$rg.'éme</b></Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Retards&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;'.retardeleve($eleve,$annee,$se).'&nbsp;</Td>
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;Absences&nbsp;</Td> 
<Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;'.absenceeleve($eleve,$annee,$se).'&nbsp;</Td> 
</Tr><Tr>';
//avoir la min de la borne max supérieur a la moyenne
$sqre="select min(maxi) mm from honneurs where maxi>='$fi'";
$rere=mysql_query($sqre);
$ligee=mysql_fetch_array($rere);
	$maxinote=$ligee['mm'];
if($fi>10){
$minnote=10;

$condition=" mini>=$minnote and maxi<= $maxinote ";
}
else{
$condition="mini>=$fi and maxi<=$maxinote ";
}
$sqere="select libelle1   from honneurs where ".$condition;
$reere=mysql_query($sqere);
while($ligere=mysql_fetch_array($reere)){
	$ho=$ligere['libelle1'];
	 $t_print.='<Td ALIGN="left" ROWSPAN="1" colspan="2" NOWRAP>&nbsp;<b>'. $ho.'</b>&nbsp;</Td>';
}

 $t_print.='</Tr>';

 $t_print.='<Tr>
<Td colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</Td>
</Tr>
<Tr>
<Td ALIGN="center" ROWSPAN="1" NOWRAP colspan="2" >&nbsp;<b>Premier Semestre</b>&nbsp;</Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$moy1.'&nbsp;</b></Td>
</Tr>
<Tr>
<Td ALIGN="center" ROWSPAN="1" NOWRAP colspan="2">&nbsp;<b>Second Semestre&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$moy2.'&nbsp;</b></Td>
</Tr><Tr>
<Td ALIGN="center" ROWSPAN="1" NOWRAP colspan="2">&nbsp;<b>Moyenne '.utf8_encode("Générale").'&nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="1" NOWRAP>&nbsp;<b>'.$note_finale.'&nbsp;</b></Td>
</Tr><Tr>
<Td colspan="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</Td>
</Tr><Tr>
<Td ALIGN="center" ROWSPAN="1" NOWRAP colspan="4"><b>&nbsp;DECISION DU CONSEIL &nbsp;</b></Td>
<Td ALIGN="center" ROWSPAN="5" colspan="3" NOWRAP><b>&nbsp;<u>L\'ADMINISTRATION</u>&nbsp;</b></Td>
</Tr>';
while($lignerq=mysql_fetch_array($reqdecision))
{
	 $t_print.='<Tr>';
	 $idec=$lignerq['id'];
	$libellerq=$lignerq['libelle'];
 $t_print.='
<Td align="left" ROWSPAN="1" colspan="3" NOWRAP>&nbsp;'. $libellerq.'&nbsp;</Td>';

$val="X";

$sqlstm11000="select libelle quant from decisions where  mini<='$note_finale' and maxi>'$note_finale' and id='$idec'";
$req10mu141000=mysql_query($sqlstm11000);
$ligne10u141000=mysql_fetch_array($req10mu141000);
$nombre1000=$ligne10u141000['quant'];
if(mysql_num_rows($req10mu141000)==0){
$val="-";
}
 $t_print.='<Td ALIGN="center" ROWSPAN="1" NOWRAP ><B>&nbsp;'.$val.'&nbsp;</B></Td></Tr>';
}/*';*/
 $t_print.='</table>';
 break;
//}
 // afficher le dossier de bac
 case 'DOSSIERBAC':
 //elseif($choix=="DOSSIERBAC"){
 $son=0;//somme total des totaux points
$soc=0;//totaux coefficient
$t_print.='
<table cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN="center" border="0">
	<Tr><Td class="petit">&nbsp;</Td></Tr>
	<Tr><Td ROWSPAN="1"  ALIGN="LEFT" NOWRAP >Nom:<b>&nbsp;'. $nom.'</b></Td></Tr>
	<Tr>
	<Td ROWSPAN="1" ALIGN="LEFT" NOWRAP >Prénom :<b>&nbsp;'. $prenom.'</b></Td></TR>
	<Tr>
	<Td ROWSPAN="1" ALIGN="LEFT" NOWRAP>Adresse des Parents ou du tuteur:<b>'.$adresse.'</b></Td>
	</Tr>
	<Tr><Td class="petit">&nbsp;</Td></Tr>
</table>';
$t_print.='
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100%" ALIGN="left">
	<Tr>
		<Td align="center" ROWSPAN="4" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline  Notes sur 20&nbsp;</B></FONT></Td>
		<Td align="center" ROWSPAN="4" NOWRAP><FONT COLOR="black"><B>&nbsp;Sem&nbsp;</B></FONT></Td>
		<Td colspan="6" >
			<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" width="100%" ALIGN="left">
				<tr>
				   <Td align="center" ROWSPAN="1"  colspan="6" NOWRAP><FONT COLOR="black"><B>&nbsp;N=notes - R=rang - T=Nombre d\'éleve dans la discipline&nbsp;</B></FONT></Td>
				</Tr>
				<Tr>
				   <Td align="center"  colspan="3" NOWRAP><FONT COLOR="black"><B>&nbsp;'.libclasse($classe).'&nbsp;</B></FONT></Td>
				   <Td align="center"  colspan="3" NOWRAP><FONT COLOR="black"><B>&nbsp;Redoublement&nbsp;</B></FONT></Td>
				</Tr>
				<Tr>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Note&nbsp;</B></FONT></Td>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Rang&nbsp;</B></FONT></Td>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;T&nbsp;</B></FONT></Td>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Note&nbsp;</B></FONT></Td>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Rang&nbsp;</B></FONT></Td>
					<Td align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;T&nbsp;</B></FONT></Td>
				</Tr>
			</table>
		</Td>
	</Tr>';

//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe' )");
//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
$t_print.='
<Tr>';
$discipline=$lignecoef['discipline'];
$coef=$lignecoef['coef'];
$soc=$soc+$coef;

$disciple = explode("D", $discipline);
			$iddis = $disciple[0];
			$idsm=$disciple[1];
					
						//libelle discipline
					 $titres = findByValue('disciplines','iddis',$iddis);
						$tit = mysql_fetch_row($titres);
						$disciplines=accents($tit[1]);
							//libelle sous discipline
					 $smat = findByValue('sous_matiere','idsm',$idsm);
						$sousmat = mysql_fetch_row($smat);
						$sousd=accents($sousmat[1]);
						if($sousd<>"")
						$affi=$disciplines.': '.$sousd;
						else
						$affi=$disciplines;


$t_print.='
	<Td ALIGN="left" ROWSPAN="3" NOWRAP>&nbsp;'.$affi.'&nbsp;
		
	</Td>';


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
$t_print.='
	<td>
		<table>
			<tr>
				<Td>1er Sem</Td><td ALIGN="center">'.$moy1.'</Td>
				<Td ALIGN="center">'.$rang1.'</Td><Td ALIGN="center">'.$nbreleve1.'</Td>
				<Td ALIGN="center">'.$moys1.'</Td><Td ALIGN="center">'.$rangs1.'</Td><Td ALIGN="center">'.$nbreleves1.'</Td>
			</tr>
		</table>
	</Td>
	<Td>
		<table>
			<tr>
				<Td>2e Sem</Td>
				<Td ALIGN="center">'. $moy2.'</Td>
				<Td ALIGN="center">'.$rang2.'</Td> 
				<Td ALIGN="center">'.$nbreleve2.'</Td> 
				<Td ALIGN="center">'.$moys2.'</Td> 
				<Td ALIGN="center">'.$rangs2.'</Td> 
				<Td ALIGN="center">'.$nbreleves2.'</Td>
			</tr>
		</table>
	</Td>';
//$t_print.='</Tr>';
}
$t_print.='
</table>';
break;
 //}
echo $t_print;
}

  require_once(dirname(__FILE__).'/../../html2pdf.class.php');
    Try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', True, 'UTF-8', 3);
		$html2pdf->pdf->IncludeJS("print(True);");
		 $html2pdf->pdf->SeTdisplayMode('fullpage');
		//for($i=0;$i<5;$i++){
        $html2pdf->writeHTML($t_print	);
//		}
        $html2pdf->Output('notes.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
  
	}