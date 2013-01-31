<?php
//delete uv
function delete_uv(){
if(isset($_POST["id"])){
	$id=addslashes($_POST['id']);
	$discipline = addslashes($_POST['discipline']);
	$credit = addslashes($_POST['credit']);
	$etude=addslashes($_POST['etude']);
$uv=addslashes($_POST['uv']);
$mise="delete from disciplines  where  iddis='$id'";
	$req2=mysql_query($mise);
if($req2){


echo"<div align=center class=imp>Données Supprimées!</div>";
}
	else
	{
echo"<div align=center class=imp>Echec!Veuillez reprendre!</div>";
	}
	
}
}

//delete coef
function delete_coef(){
if(isset($_POST["niveau"])){

	$niveau = addslashes($_POST['niveau']);
	$discipline=addslashes($_POST['discipline']);
	$coef=addslashes($_POST['coef']);
//	$motdepasse=addslashes($_POST['motpasse']);
//$profile=addslashes($_POST['profil']);
		$mise="delete from coefficients where discipline='$discipline' and etude='$niveau'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Données Supprimées");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="coefs.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="coefs.php"
</SCRIPT>';
	}
}
}
function delete_emploi(){
if(isset($_POST["classe"])){


	$classe = addslashes($_POST['classe']);
	$annee=addslashes($_POST['annee']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$jour=addslashes($_POST['jour']);	
	$se=addslashes($_POST['sem']);
	
  $del1="delete from emploi_temps where jour='$jour' and debut='$debut' and fin='$fin' and annee='$annee' and semestre='$se' and classe='".htmlentities($classe)."'";
$req1=mysql_query($del1);
echo'
<script Language="JavaScript">
 {alert ("suppression Enregistrée");
 }
</SCRIPT>';
echo'

<SCRIPT LANGUAGE="JavaScript">
location.href="emplois_classes.php?ajout=1&num='.$classe.'"
</SCRIPT>';	
}
}
// delete evaluation
function delete_evaluation(){
if(isset($_POST["code"])){

		$status=$_SESSION["profil"];
$code = addslashes($_POST['code']);

	$classe = addslashes($_POST['classe']);
	$annee=addslashes($_POST['annee']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$jour=addslashes($_POST['jour']);	
	$se=addslashes($_POST['sem']);
		$sqlstm1="select count(*) nbre from notes where evaluation='$code'";
$req1=mysql_query($sqlstm1);
$ligne=mysql_fetch_array($req1);
$nb=$ligne['nbre'];
if($nb==0)
{
  $del1="delete from evaluations where date_prevue='$jour' and heure_debut='$debut' and heure_fin='$fin' and annee='$annee' and semestre='$se' and classe='$classe'";
$req1=mysql_query($del1);
echo'
<script Language="JavaScript">
 {alert ("Annulation Enregistrée");
 }
</SCRIPT>';
if($status=='SURVEILLANT')
{
echo'

<SCRIPT LANGUAGE="JavaScript">
location.href="sevaluations.php?num='.$classe.'&annee='.$annee.'"
</SCRIPT>';	
}
elseif($status=='PROFESSEUR')
{
echo'

<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php"
</SCRIPT>';	
}
}
else{
echo'
<script Language="JavaScript">
 {alert ("suppression Impossible car ya des éléves qui ont déja une note a 7 évaluation");
 }
</SCRIPT>';
if($status=='SURVEILLANT')
{
echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="sevaluations.php?num='.$classe.'&annee='.$annee.'"
</SCRIPT>';	
}
elseif($status=='PROFESSEUR')
{
echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="evaluationprof.php"
</SCRIPT>';	
}
}
}
}
//delete depense journaliere
function delete_depense(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="delete from depenses where  codejournee='$snumero' and datejour='$sdatejour' and agent='$personnel'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Dépense Supprimée");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepenses.php"

</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepenses.php"
</SCRIPT>';

	}
}
}
// delete depense mensuelle
function delete_depensem(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	//$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	//$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="delete from depenses where  codejournee='$snumero' and annee='$annee'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Dépense Supprimée");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepens_mensuel.php"

</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="lidepens_mensuel.php"
</SCRIPT>';

	}
}
}
//delete avance sur salaire
function delete_avancesal(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	//$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	//$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="delete from depenses where  codejournee='$snumero' and annee='$annee'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Avance sur salaire  Annulée");
							}
</SCRIPT>';

							echo'<SCRIPT LANGUAGE="JavaScript">
location.href="avanace_salaire.php"

</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="avanace_salaire.php"
</SCRIPT>';

	}
}
}
//delete honneur
function delete_honneur(){
if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$mise="delete from honneurs where  libelle='$libelle'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("honneur a été modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="honneurs.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="honneurs.php"
</SCRIPT>';
	}
}
}
//delete remarques
function delete_remarque(){
if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$mise="delete from remarques  where  libelle='$libelle'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Remarque Modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="remarques.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="remarques.php"
</SCRIPT>';
	}
	
}
}
// delete appreciation
function delete_appreciation(){
if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$mise="delete from apreciations  where  libelle='$libelle'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Appréciation Supprimée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="appreciations.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="appreciations.php"
</SCRIPT>';
	}
	
}
}

//delete décision conseil
function delete_decision(){
if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
	$etude=addslashes($_POST['etude']);
	$mise="delete from decisions  where  libelle='$libelle' and etude='$etude'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Décision Annulée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php"
</SCRIPT>';
	}
	
}
}





?>