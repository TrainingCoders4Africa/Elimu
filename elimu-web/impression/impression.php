<?php    session_start();
	//$pseudo=$_SESSION['pseudo'];
	$pseudo="<html><head><title>Impression</title></head></html>";
	//$zone=($_SESSION['zone']);
	$classe=$_GET["id"];
	$annee=$_GET["dates"];// ANNEE ACADEMIQUE
	$eleve=@$_GET["eleve"];
  $page=$_GET["page"];

if (empty($pseudo))
 {     }

require('fpdf.php');

class PDF extends FPDF
{
//Chargement des données
function LoadData($file)
{
	//Lecture des lignes du fichier
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

//Tableau simple
function BasicTable($header,$data)
{
	//En-tête
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	//Données
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

//Tableau amélioré
function ImprovedTable($header,$data)
{
	//Largeurs des colonnes
	$w=array(40,75,45,40);
	//En-tête
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	//Données
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'C');
		$this->Cell($w[1],6,$row[1],'C');
		$this->Cell($w[2],6,number_format($row[2],0,',',' '),'C',0,'C');
		$this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R');
		$this->Ln();
	}
	//Trait de terminaison
	$this->Cell(array_sum($w),0,'','T');
}

//Tableau coloré
function FancyTable($header,$data,$taille)
{
	//Couleurs, épaisseur du trait et police grasse	$this->SetFillColor(200,220,255);
	if($taille=="moyen")
	$this->SetFillColor(221,0,0);
	ELSE
	$this->SetFillColor(0,204,204);
	$this->SetTextColor(255);
	$this->SetDrawColor(128,0,0);
	$this->SetLineWidth(.2);
	$this->SetFont('courier','B',8);
	//En-tête
	$tab=$header;
	$nb=count($tab);
	//echo sizeof($tab);
	$nbt=0;
	 for ($i=0; $i<$nb; $i++) {
      //echo"<br>".$tab[$i]." taille ".strlen($tab[$i]) ;
      $nbt+=strlen($tab[$i]);
     }
    if($taille=="moyen")
	$part=130/$nbt;
	ELSE
	$part=200/$nbt;
	$w=array();
   // echo "<br>nb element".$nb;
    for ($i=0; $i<$nb; $i++) {
    //  echo"<br>".$tab[$i]." taille ".strlen($tab[$i]) ;
         array_push($w ,intval(strlen($tab[$i])*$part));

    }
    //echo "<br>part : $part et tab :$tabl";
	//$w=array(strlen($tab[0])*$part,strlen($tab[1])*$part,strlen($tab[2])*$part,strlen($tab[3])*$part,strlen($tab[4])*$part);
	//$w=array(012,45,45,45,20);
	//echo $w;
	for($j=0;$j<$nb;$j++)
		$this->Cell($w[$j],7,$tab[$j],1,0,'C',1);
	$this->Ln();
	//Restauration des couleurs et de la police

	$this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
	$l=2;
	//Données
	$fill=0;
     //echo "<br>". $nb;
	foreach($data as $row)
	{
	   if(isset($row[1])){
	   $l++;
         for ($i=0; $i<$nb; $i++)
			$this->Cell($w[$i],5,$row[$i],'LR',0,'C',$fill);
	  /*	$this->Cell($w[1],5,$row[1],'LR',0,'C',$fill);
		$this->Cell($w[2],5,$row[2],'LR',0,'C',$fill);
		//$this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'C',$fill);
		$this->Cell($w[3],5,$row[3],'LR',0,'C',$fill);
		$this->Cell($w[4],5,$row[4],'LR',0,'C',$fill);
		$this->Cell($w[5],5,$row[5],'LR',0,'C',$fill);
		$this->Cell($w[6],5,$row[6],'LR',0,'C',$fill);
		$this->Cell($w[7],5,$row[7],'LR',0,'C',$fill);
		$this->Cell($w[8],5,$row[8],'LR',0,'C',$fill);
		$this->Cell($w[9],5,$row[9],'LR',0,'C',$fill);
		$this->Cell($w[10],5,$row[10],'LR',0,'C',$fill);
		$this->Cell($w[11],5,$row[11],'LR',0,'C',$fill);
		$this->Cell($w[12],5,$row[12],'LR',0,'C',$fill);
		$this->Cell($w[13],5,$row[13],'LR',0,'C',$fill); */
		$this->Ln();

		$fill=!$fill;
	  }
	}

	$this->Cell(array_sum($w),0,'','T');
	$this->Ln();
	$this->Ln();
	$this->setY(65+$l*5);
	//return $row;
}
}
$pdf=new PDF();
 $pdf->AddPage();
 $pdf->SetFont('courier','',10);
 
 include"../dao/connection.php";
   $sqlstmel="SELECT prenom8,nom8,date_format(date_nais8,'%d/%m/%Y') dtn,lieu_nais8 FROM eleves WHERE matricule='$eleve'";
$reqel=mysql_query($sqlstmel);
$ligneel=mysql_fetch_array($reqel);
$prenom=$ligneel['prenom8'];
$nom=$ligneel['nom8'];
$date_n=$ligneel['dtn'];
$lieu=$ligneel['lieu_nais8'];
//effectif de la classe
		$sqe="select count(eleve) nbrel from inscription where classe='".htmlentities($classe)."' and annee='$annee'  ";
$ree=mysql_query($sqe);
$lige=mysql_fetch_array($ree);
	$nombreel=$lige['nbrel'];
	//redoublement
	$sql1="SELECT redoublant FROM inscription WHERE eleve='$eleve' and classe='".htmlentities($classe)."' and annee='$annee'";
$req1=mysql_query($sql1);
$ligne1=mysql_fetch_array($req1);
$redoublant=$ligne1['redoublant'];

 $req=mysql_query("select * from etablissements") or die (mysql_error());
 $row=mysql_fetch_row($req);
 $ia=$row[0];
 $iden=$row[1];
 $ecole=$row[2]; $logo=$row[3]; $slogan=$row[4]; $date_ouvte=$row[5];
 $adresse=$row[6];
 $tel=$row[7];
 $bp=$row[8]; $site=$row[9]; $faxe=$row[10];
 $mail=$row[11];
 if($logo<>''){
 $ss="../parametrage/logos/".$logo;
$pdf->Image($ss,10,5,20,20);
}
 $pdf->SetFont('courier','',10);
  $pdf->setXY(0,0);
$pdf->Cell(210,5,"IA :".$ia,0,1,'R');
 $pdf->SetFont('courier','B',8);
  $pdf->setXY(0,5);
$pdf->Cell(210,3,"IEF :". $iden,0,1,'R');
$pdf->setXY(0,8);
$pdf->Cell(210,3,"ETABLISSEMENT :". $ecole,0,1,'R');
  $pdf->setXY(0,11);
$pdf->Cell(210,3,"Email :".$mail,0,1,'R');
  $pdf->setXY(0,14);
$pdf->Cell(210,3,"Téléphone :".$tel,0,1,'R');
  $pdf->setXY(0,17);
$pdf->Cell(210,3,"BP :".$bp,0,1,'R');
  $pdf->setXY(0,21);
$pdf->Cell(210,3,"Site web :".$site,0,1,'R');
/*
$pdf->SetFont('courier','',10);

$pdf->setXY(0,30);
$pdf->Cell(210,5,"$ecole,le ".date("d m Y"),0,1,'l');*/
//
//$pdf->SetFont('Arial','',14);
//      affichage Phtot Membre
 $supp=0;
 //LISTE DES ELEVES
 if($page=='ELEVE'){
 //$tab=$_GET["tab"];
 	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="Liste Alphabétique des éléves de la ".$classe;
 $pdf->Cell(210,10,$kc,0,1,'C');

   $header=array(" Prénom "," Nom ","Date et Lieu de naissance");
   
   }
   //imprimer emploi du temps
   elseif($page=='EMPLOIS'){
 //$tab=$_GET["tab"];
 	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="Liste Alphabétique des éléves de la ".$classe;
 $pdf->Cell(210,10,$kc,0,1,'C');

   $header=array("Horaire","Lundi "," Mardi ","Mercredi","Jeudi","Vendredi","Samedi");
   
   }
elseif($page=='CARNET'){
 //$tab=$_GET["tab"];
 	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="CARNET DE NOTES DE L'ELEVE ".$prenom." ".$nom." DE LA ".$classe;
 $pdf->Cell(210,10,$kc,0,1,'C');

   $header=array("Evaluation"," Discipline "," Type ","Notes","   Période   ");
   
   }
elseif($page=='BULLETINS1'){
//nbre absence
	$sqseab="select count(eleve) nbre from cahier_absence where eleve='$eleve' and annee='$annee' and semestre='S1'";
$reqseab=mysql_query($sqseab);
while($ligneseab=mysql_fetch_array($reqseab))
{
	$absence=$ligneseab['nbre'];
	}
	//nombre retard
		$sqseabr="select count(eleve) nbre from cahier_retard where eleve='$eleve' and annee='$annee' and semestre='S1'  ";
$reqseabr=mysql_query($sqseabr);
while($ligneseabr=mysql_fetch_array($reqseabr))
{
	$retard=$ligneseabr['nbre'];
	}
 	$pdf->SetFont('courier','BU',13);
 $pdf->setXY(0,35);
 $kc="BULLETIN DE NOTES DU PREMIER SEMESTRE DE L'ANNEE ACADEMIQUE ".$annee; 
 $pdf->Cell(210,10,$kc,0,1,'L');
  $pdf->SetFont('Arial','',13);
$pdf->setXY(0,45);
$pdf->Cell(0,5,"Prénom :".$prenom."																	  Nom :".$nom." ",0,1,'L');
$pdf->setXY(0,55);
$pdf->Cell(0,5,"Date & Lieu de Naissance : ".$date_n." à ".$lieu."			Classe: ".$classe." 					 Effectif : ".$nombreel	,0,1,'L');
$pdf->setXY(0,65);
$pdf->Cell(0,5,"Nbre Absence : ".$absence." 										 Nbre Retard : ".$retard." 					 Redoublant :".$redoublant,0,1,'L');
  $pdf->ln();
   $header=array("Discipline"," Devoir "," Compo ","M:S","Coef","Total Points","Appréciations");
   
   }
//$pdf->Cell(210,10,$kc,0,1,'C');
//
//

/*if ($_GET["id"]==2) {
$reqf=mysql_query("select * from ventes where numfact='".$_GET['numfact']."' group by numfact") or die(mysql_error());
$rw=mysql_fetch_row($reqf);
$nom=$rw[2];
     $header=array("Code_Article"," Désignation Article"," Quantités ","Prix de Vente"," Prix total");
 $pdf->setXY(0,40);
 $pdf->Cell(200,6,"A ".$rw[2],0,1,'R');

 $pdf->setXY(0,50);
 $kc=" Facture N°".$_GET['numfact'];
$pdf->Cell(210,10,$kc,0,1,'C');
$supp=1;
$header1=array("  Montant Avancé  ","Montant Restant");


/*}

elseif ($_GET["id"]==1) {	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="Situation Actuelle du Dépôt";
 $pdf->Cell(210,10,$kc,0,1,'C');
  // $pdf->ln();
   $header=array("Code_Article","Désignation","Quantités","CUMP","Montant Stock Total");

}
elseif ($_GET["id"]==3) {
	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="Bilan du ".$_GET["datedeb"]." au ".$_GET["datef"] ;
 $pdf->Cell(210,10,$kc,0,1,'C');
  // $pdf->ln();
   $header=array("   Date   ","    Réf    ","    Désignation   ","Quantités","Prix Unitaire"," Recette "," Dépenses ","  Solde  ");
   $header1=array("Chiffre d'Affaires du Jour","Dépenses du Jour","Disponibilité en Caisse");
   $supp=1;
}
elseif ($_GET["id"]==4) {
	$pdf->SetFont('courier','BU',15);
 $pdf->setXY(0,35);
 $kc="Situation Bancaire du ".$_GET["datedeb"]." au ".$_GET["datef"] ;
 $pdf->Cell(210,10,$kc,0,1,'C');
  // $pdf->ln();
   $header=array("   Date   ","    Banque    "," N° Bordoreau V   ","Montant"," N° Chèque",".   Destinataire   . "," Montant  ","  Solde  ");
   $header1=array("Chiffre d'Affaires Periode","Dépenses du Periode","Disponibilité en Banque");
   $supp=1;
}
*/


 $data=$pdf->LoadData("impression.txt");

 $pdf->FancyTable($header,$data,"");
 if($supp==1){ 	//$pdf->setX(50);

  $data1=$pdf->LoadData("suppl.txt");

  $pdf->FancyTable($header1,$data1,"moyen");
 }
 //$pdf->FancyTable($header,$data);
  /**/
 $pdf->Output();
/*
$pdf->FPDF('L','mm','A4');
//Titres des colonnes
$header=array("Police","Compteur ","Index"," Compteur Dépose","Index","Caracteristique","Date","Cable 2x16","Cable 4x16","PA","CPB1CT70","CPB2CT70"
 ,"CPB1CT25","Observations");
//Chargement des données
$dd=date("d/m/Y");

$kc="AGENCE BOURGUIBA";
$kc1="Unité Technique";
$kc2="Equipe Branchement";
$kc3="";
$kc5="Période : $mois $an ";
$kc6= "Date Tirage : $dd";
$kc7= "M. Alie Fall Chef Unité Technique ";
//$my="impr_perte_cons_remb";
//$pays=$my.".txt";


$contents = file_get_contents("recuptitre.txt");
//$tabb=array();
$tab=explode(",",$contents);
//$tab=array_unique($tabb);
$nbre = sizeof($tab);


*/

?>
