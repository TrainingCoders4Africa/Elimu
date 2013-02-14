<?php
include '/dao/connection.php';
include '/dao/select.php';
if(isset($_POST['ELEVE_ID']) and isset($_POST['SEM_ID']) and isset($_POST['CLASSE_ID']) )
{
$son=0;//somme total des totaux points
$soc=0;//totaux coefficient
$nombre=0;
$eleve =$_POST['ELEVE_ID'];
$se =$_POST['SEM_ID'];
$classe =$_POST['CLASSE_ID'];
$cycle=lcycle($classe);
$annee=annee_academique();
//afficher Etat civil de lélève
	$sqlstmel="SELECT prenom8,nom8,date_format(date_nais8,'%d/%m/%Y') dtn,lieu_nais8 FROM eleves WHERE matricule='$eleve'";
	$reqel=mysql_query($sqlstmel);
	$ligneel=mysql_fetch_array($reqel);
	$prenom=$ligneel['prenom8'];
	$nom=$ligneel['nom8'];
	$date_n=$ligneel['dtn'];
	$lieu=$ligneel['lieu_nais8'];
//vérifier si l'élève a fait une évaluation
	$reqelea=findByNValue("notes","notes.eleve='$eleve' and evaluation in(select id from evaluations where annee='$annee'and classe='$classe') and note<>'ABS'");
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
	if($eleve<>""){
	echo'
<Tr>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Discipline&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Devoir&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Comp&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;M : S&nbsp;</B></FONT></TH>
<TH align="center" ROWSPAN="1" NOWRAP><FONT COLOR="black"><B>&nbsp;Coef&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;Total Points&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="black"><B>&nbsp;'.utf8_encode("Appréciations").'&nbsp;</B></FONT></TH>
</Tr>';

$nc=0;
$div1=1;
//connaiTre  coef,uv suivant la classe de l'élève en question 
$sqlstmcoef="SELECT discipline,coef FROM coefficients WHERE coefficients.etude=(select etude from classes where idclasse='$classe' )";
$reqcoef=findByNValue("coefficients","coefficients.etude=(select etude from classes where idclasse='$classe' )");
$nb=mysql_num_rows($reqcoef);
                  $i=1;
              //   echo" <input name=nbart type=hidden value=$nb>";
//mysql_query($sqlstmcoef);
while($lignecoef=mysql_fetch_array($reqcoef))
{
echo'<Tr>';
$disci=$lignecoef['discipline'];//code discipline
$dis = explode("D", $disci);
			$iddis = $dis[0];
			$idsm=$dis[1];
					
							
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
$nombre=$nombre+1;
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
						

echo" <input name=disci$i type=hidden value='$disci'>";


echo'
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'. utf8_encode($disciples).'&nbsp;</Td>';

//total devoir + moyenne devoir
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$disci' and notes.eleve='$eleve' and note<>'ABS'";
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
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$disci' and notes.eleve='$eleve' ";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
if($nc<>'ABS' and $moyd<>'ABS')
$ms=($moyd+$nc)/2;
elseif($nc=='ABS' and $moyd<>'ABS')
$ms=$moyd;
elseif($nc<>'ABS' and $moyd=='ABS')
$ms=$nc;
echo" <input name=moydis$i type=hidden value='$ms'>";
$tp=$ms*$coef;
$son=$son+$tp;
//gestion remarque
$sqere="select libelle   from apreciation_prof where eleve='$eleve' and semestre='$se' and discipline='$disci'
and annee='$annee' ";
$reere=mysql_query($sqere);
$ligere=mysql_fetch_array($reere);
	$rem=$ligere['libelle'];
//gestion appréciation	
$sqeap="select libelle1   from apreciations where mini<='$ms' and maxi>'$ms' ";
$reeap=mysql_query($sqeap);
$ligeap=mysql_fetch_array($reeap);
	$apr=$ligeap['libelle1'];

echo'

<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$moyd.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $nc.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $ms.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'.$coef.'&nbsp;</Td>
<Td ALIGN=center ROWSPAN=1 NOWRAP>&nbsp;'. $tp.'&nbsp;</Td>
<Td ALIGN=left ROWSPAN=1 NOWRAP>&nbsp;'.utf8_encode($rem).'&nbsp;</Td> 
</Tr>';
  $i++;
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
echo" <input name=nbart type=hidden value=$nombre>";
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
</Tr>
</table>';
echo" <input name=moyenne type=hidden value='$fi'>";
				  echo'	</table><table>			  
 <div><input class=kc1 type="submit" name="enregistrer" value='.utf8_encode("Délibérer").' />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" /></div>
</table>';

}
}
?>