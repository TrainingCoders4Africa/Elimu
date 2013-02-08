<?php
/*
<?php
  header('Location:index.php');
  exit();
?>

<?php
 echo 'Vous allez être redirigé dans 5 secondes';
 sleep(5);
 header('Location: http://www.monsite.com/page.php';
 ?>
 
 <?php
 header("Refresh: 3; URL=redirection.php");
 ?>
*/
// récupération du  lien des fichiers
function lien(){
 $url = $_SERVER['REQUEST_URI'];
    if (substr($url, 0, 7)!=='http://') {
        $url = 'http://'.$_SERVER['HTTP_HOST'];
        if (ISSET($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!=80) $url.= ':'.$_SERVER['SERVER_PORT'];
        $url.= $_SERVER['REQUEST_URI'];
    }
	return $url;
}
// fonction de conversion des accents 
function accents($valeur){ 
$val=str_replace(utf8_encode('Ç'), '&Ccedil;', $valeur);
$val=str_replace(utf8_encode('É'), '&Eacute;', $val);
$val=str_replace(utf8_encode('À'), '&Agrave;', $val);
$val=str_replace(utf8_encode('Â'), '&Acirc;', $val);
$val=str_replace(utf8_encode('Î'), '&Icirc;', $val);
$val=str_replace(utf8_encode('È'), '&Egrave;', $val);
$val=str_replace(utf8_encode('Ê'), '&Ecirc;', $val);
$val=str_replace(utf8_encode('Ô'), '&Ocirc;', $val);
$val=str_replace(utf8_encode('Û'), '&Ucirc;', $val);
$val=str_replace(utf8_encode('Ù'), '&Ugrave', $val);
$val=str_replace(utf8_encode('Ï'), '&Iuml;', $val);

$val=str_replace(utf8_encode('ç'), '&ccedil;', $valeur);
$val=str_replace(utf8_encode('é'), '&eacute;', $val);
$val=str_replace(utf8_encode('à'), '&agrave;', $val);
$val=str_replace(utf8_encode('â'), '&acirc;', $val);
$val=str_replace(utf8_encode('î'), '&icirc;', $val);
$val=str_replace(utf8_encode('è'), '&egrave;', $val);
$val=str_replace(utf8_encode('ê'), '&Ecirc;', $val);
$val=str_replace(utf8_encode('ô'), '&ocirc;', $val);
$val=str_replace(utf8_encode('û'), '&ucirc;', $val);
$val=str_replace(utf8_encode('ù'), '&ugrave', $val);
$val=str_replace(utf8_encode('ï'), '&iuml;', $val);
$val=str_replace("'", '\'', $val);
return $val;
}
//Déterminer l'année académique en cours 
function annee_academique(){
 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
		return $aca;
}
// Déterminer l'année académique précédente
function preannee_academique(){
 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")-1;
		if( $mois>=10){
		 $aca=$annee1 .'/'. $annee;
		}
		else{
		 $aca=date("Y")-2 .'/'.$annee1;
		}
		return $aca;
}
function findByAll($table){

	$sql_selection = "select * from ".$table." ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//compter le nombre de données
function findByNbreValue($table,$condition){

$sql_selection = "select count(*) from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection du libellé
function findBylib($table,$libelle){

	$sql_selection = "select distinct $libelle from ".$table." order by $libelle ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
 // select disitinct $libelle 	avec condition <>
 function findNBylib($table,$libelle,$champ,$condition){
	$sql_selection =  "select distinct $libelle from ".$table." where ".$champ." <> '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
 // select disitinct $libelle 	avec condition =
 function findCBylib($table,$libelle,$champ,$condition){

	$sql_selection =  "select distinct $libelle from ".$table." where ".$champ." = '".$condition."' ;";
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection libelle avec plusieurs conditions
function findByNValuelib($table,$libelle,$condition){
$sql_selection = "select  distinct $libelle from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//selection *  avec un seul parametre
function findByValue($table,$champ,$condition){

	$sql_selection = "select * from ".$table." where ".$champ." = '".$condition."' ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//select avec plusieurs parametres
function findByNValue($table,$condition){
$sql_selection = "select * from ".$table." where ".$condition." ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
function findNByValue($table,$champ,$condition){

	$sql_selection = "select * from ".$table." where ".$champ." <> '".$condition."' ;";
	//echo"requete : ".$sql_selection;
 	$selection = mysql_query($sql_selection) or die(mysql_error());

   	return $selection;
}
//fonction de cotrole des données récupérées
function securite_bdd($string)	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}
//fonction de connection des utilisateurs
function user_connect($login,$profil){
$executer=findByNValue("user","login1='$login' and profile5='$profil' and cdeetud in (select distinct matricule from personnels where enable8='1')");
$ligne=mysql_fetch_array($executer);
	$pas= $ligne['motdepasse7'];
	$matricule= $ligne['cdeetud'];
$perso=$pas.'*'.$matricule;
return $perso;
}
//connaitre le dernier jour de mise a jour des infos de l'utilisateur
function user_miseinfo($matricule,$profil){
$affichec="select max(date_connect) dc from connecter where personnel='$matricule' and profile='$profil' ";
$executerc=mysql_query($affichec);
$n=mysql_num_rows($executerc);
$lignec=mysql_fetch_array($executerc);
	$date_c= $lignec['dc'];
$a=substr($date_c,0,4);
$m=substr($date_c,5,2);
$j=substr($date_c,8);
$today = mktime(0,0,0, $m,$j,$a);
$today += (3600 * 24 * 7 );
// 1h * 24 = 1 jour
$ladate = date("Y-m-d ", $today);
$info_con=$ladate.'/'.$n;
return $info_con;
}
//metre la 1er lettre en Majuscule
function UcFirstAndToLower($str){     
return ucfirst(strtolower(trim($str)));}	
//libelle semestre
function libelle_semestre($semestre){
	$reqse=findByNValue("semestres","id='$semestre'");
	$lignese=mysql_fetch_array($reqse);
	$lisemestre=$lignese['libelle'];
	return $lisemestre;
}
//libelle classe
function libclasse($classe){
$t_classe = findByValue('classes','idclasse',$classe);
	$ch_classe = mysql_fetch_array($t_classe);
	$liclasse=$ch_classe['libelle'];
	return $liclasse;
}
// information du personnel
function infoperso($matricule){
$t_perso = findByValue('personnels','matricule',$matricule);
	$ch_perso = mysql_fetch_array($t_perso);
	// connaitre le titre
	$etag = findByValue('titre5','id',$ch_perso['titre8']);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
	$personne=$titre.' '.$ch_perso['prenom'].' '.$ch_perso['nom'];
	return $personne;
}
//connaitre le cycle de la classe de lélève
function lcycle($classe){
	$sqletude=findByNValuelib("etudes","cycle","idetude=(select etude from classes where idclasse='$classe')");
	$lig=mysql_fetch_array($sqletude);
	$cycle=$lig['cycle'];
	return $cycle;
	}
// connaitre le niveau étude de la classe
function niveauE($classe){
	$sqletude=findByNValuelib("classes","etude","idclasse='$classe'");
	$lig=mysql_fetch_array($sqletude);
	$etude=$lig['etude'];
	return $etude;
	}
//vérifier sil ya note de conduite findByNbreValue
function Econduite($cycle){
	$exess1=findByNValue("conduite","cycle='$cycle'");
	$val=mysql_num_rows($exess1);	
	return $val;
	}
//nbre absence pour le semestre choisi
function absenceeleve($eleve,$annee,$semestre){
	$reqseab=findByNbreValue("cahier_absence","eleve='$eleve' and annee='$annee' and semestre='$semestre'");
	$absence_el = mysql_fetch_row($reqseab);
	$absence=$absence_el[0];
	return $absence;
	}
//nombre retard pour le semestre choisi
function retardeleve($eleve,$annee,$semestre){
	$reqseabr=findByNbreValue("cahier_retard","eleve='$eleve' and annee='$annee' and semestre='$semestre'");
	$retard_el = mysql_fetch_row($reqseabr);
	$retard=$retard_el[0];
	return $retard;
	}
//Effectif de la clase pour l'année en cours
function Effectifclasse($classe,$annee){
	$sqlefclasse=findByNbreValue("inscription","classe='$classe' and annee='$annee' ");
	$ef_classe = mysql_fetch_row($sqlefclasse);
	$nombreel=$ef_classe[0];
	return $nombreel;
	}
//moyenne Semestrielle
function moyennesem($eleve,$annee,$semestre){
	$ss1="select moyenne FROM moyennes WHERE eleve='$eleve' and annee='$annee'and semestre='$semestre'";
	$rs1=mysql_query($ss1);
	$ls1=mysql_fetch_array($rs1);
	$moy=$ls1['moyenne'];
	return $moy;
	}
//vérifier si l'élève est un redoublant de la classe 
function redoublant($eleve,$classe,$annee){
	$sql1="SELECT redoublant FROM inscription WHERE eleve='$eleve' and classe='$classe' and annee='$annee'";
	$req1=mysql_query($sql1);
	$ligne1=mysql_fetch_array($req1);
	$redouble=$ligne1['redoublant'];	
	return $redouble;
}	
	//vérifier sil a des notes de composition pour le premier semestre
function verifNcomposotion($eleve,$annee,$classe,$semestre){	
	$reqelesem1=findByNValue("moyennes","moyennes.eleve='$eleve' and semestre='$semestre' and annee='$annee'");
	$nb=mysql_num_rows($reqelesem1);
	return $nb;
	}
//moyenne des controles continus
function moyennecontrole($se,$discipline,$eleve,$classe,$annee){
$s="SELECT count(discipline) dv,sum(note) nt,round(sum(note)/count(discipline),3) md FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='DEVOIR' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$r=mysql_query($s);
$l=mysql_fetch_array($r);
$dv=$l['dv'];
$nt=$l['nt'];
$md=$l['md'];
return $md;
}
//note composition
function notecomposition($classe,$annee,$se,$discipline,$eleve){
$sc="SELECT note FROM evaluations,notes WHERE evaluations.id=notes.evaluation and evaluations.classe='$classe' and evaluations.annee='$annee'and
 evaluations.type='COMPOSITION' and evaluations.semestre='$se' and evaluations.discipline='$discipline' and notes.eleve='$eleve'";
$rc=mysql_query($sc);
$lc=mysql_fetch_array($rc);
$nc=$lc['note'];
return $nc;
}
// moyenne semestrielle suivant une matiére donnée de l'éléve
function moyenneuveleve($moyennedevoir,$notecompo){
$ms=($moyennedevoir+$notecompo)/2;
return $ms;
}
//coordonnées  tuteur suivant la classe	
function coordonneetuteurclasse($classe,$annee){
$sql_selection="SELECT tel_tuteur8,email_tuteur8 FROM eleves WHERE matricule in(select eleve from inscription where classe='$classe' and annee='$annee')";
 	$selection = mysql_query($sql_selection) or die(mysql_error());
 	return $selection;
}
//coordonnées  tuteur suivant l'annee en cours	
function coordonneetuteur($annee){
$sql_selection="SELECT tel_tuteur8,email_tuteur8 FROM eleves WHERE matricule in(select eleve from inscription where  annee='$annee')";
 	$selection = mysql_query($sql_selection) or die(mysql_error());
 	return $selection;
}
//rang 
function rangeleveDiscipline($annee,$semestre,$moyenne,$discipline){
$sqserang ="select count(eleve) nbre from moyennediscipline where  annee='$annee' and semestre='$semestre' and note>'$moyenne' and discipline='$discipline'  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$rg=$rang['nbre']+1;
return $rg;
}
//connaitre le nombré composé à une matiére donnée
function nombreeleveDiscipline($annee,$semestre,$classe,$discipline){
$sqserang ="select count(eleve) nbre from moyennediscipline where  annee='$annee' and semestre='$semestre'  and discipline='$discipline'and eleve
 in(select eleve from inscription where classe='$classe' and annee='$annee') and note<> 0  ";
$reqserang=mysql_query($sqserang);
$rang=mysql_fetch_array($reqserang);
$nbre=$rang['nbre'];
return $nbre;
}
//connaitre la discipline suivant l'id du crédit horaire
function disciplinecredit($idch){
$selection =  findByNValue('disciplines',"iddis =(select discipline from credit_horaire where idch='$idch')");
			$ro=mysql_fetch_row($selection);
				$discipline=accents($ro[1]);
				return $discipline;
}
//effectif de la classe pour l'année en cours
function effectif_classe($classe,$annee){
//$annee=annee_academique();
$selection =findByNbreValue("inscription","classe='$classe' and annee='$annee'");
$el = mysql_fetch_row($selection);
$nbre_eleve=$el[0];
return $nbre_eleve;
}
//conversion de dates
function dateUS2FR($date)
{
  $date = explode('-', $date);
  $date = array_reverse($date);
  $date = implode('/', $date);
  return $date;
}
?>
