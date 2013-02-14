<?php
include '/../../dao/connection.php';
include '/../../dao/select.php';
$classe=securite_bdd($_GET["classe"]);
$annee=annee_academique();
$preanne=preannee_academique();
$cycle=lcycle($classe);
//afficher Etat civil de lélève
	$sqlstmel="SELECT matricule,prenom8,nom8,date_format(date_nais8,'%d/%m/%Y') dtn,lieu_nais8,adresse8 FROM eleves 
	WHERE matricule in (select matricule from inscription where classe='$classe' and annee='$annee') order by nom8 asc";
	$reqel=mysql_query($sqlstmel);
	

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
	$logo=$ligne9['logo'];

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
	
	// le carnet de note de l'éleve
$t_print.='
	<table border="1" cellspacing="0"  cellpadding="2" width="100" ALIGN="center">';
	/*if($logo<>''){
	$t_print.='<Tr><Td>
	<img src="parametrage/logos/logo.gif">
	</Td></Tr>';
	}*/
	$t_print.='<Tr>
	<Td align="center" colspan="4" NOWRAP  ><B>&nbsp; Liste des '.utf8_encode("Eléves ").' de la '.libclasse($classe).'</B></Td>
	</tr>
	<Tr>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT ><B>&nbsp;Matricule&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT ><B>&nbsp;'.utf8_encode("Eléve").'&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT><B>&nbsp;Date et Lieu de Naissance&nbsp;</B></FONT></TH>
	<TH align="center" ROWSPAN="1" NOWRAP><FONT><B>&nbsp;Adresse&nbsp;</B></FONT></TH>
	</Tr>';//$t_print.
	while($ligneel=mysql_fetch_array($reqel))
	{
	$t_print.='<tr>';
	$matricule=$ligneel['matricule'];	
	$prenom=$ligneel['prenom8'];
	$nom=$ligneel['nom8'];
	$date_n=$ligneel['dtn'];
	$lieu=$ligneel['lieu_nais8'];
	$adresse=$ligneel['adresse8'];
	
		$t_print.='<Td ALIGN="left" ROWSPAN="1" NOWRAP>'. $matricule.'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'. $prenom.' '.$nom.'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'.$date_n.utf8_encode(" à ").utf8_encode($lieu).'</Td>
		<Td ALIGN="left" ROWSPAN="1" NOWRAP>'. $adresse.'</Td>
		</Tr>';
	}
	$t_print.='</table>';

//echo $t_print;

  require_once(dirname(__FILE__).'/../../html2pdf.class.php');
    Try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', True, 'UTF-8', 3);
		$html2pdf->pdf->IncludeJS("print(True);");
		 $html2pdf->pdf->SeTdisplayMode('fullpage');
		//for($i=0;$i<5;$i++){
        $html2pdf->writeHTML($t_print	);
//		}
        $html2pdf->Output("notes.pdf");
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
  
	}