<?php
//UPDATE UV
function update_uv(){
if(isset($_POST["id"])){
	$id=addslashes($_POST['id']);
	$discipline = addslashes($_POST['discipline']);
	$credit = addslashes($_POST['credit']);
	$lesson=addslashes($_POST['lesson']);
	$etude=addslashes($_POST['etude']);
	$type=addslashes($_POST['type']);
$uv=addslashes($_POST['uv']);
$mise="update credit_horaire set credit_horaire='$credit',nbre_lesson='$lesson',nature='$type' where  idch='$id'";
	$req2=mysql_query($mise);
if($req2){
echo"<div align=center class=imp>Modification Enregistrée!</div>";
}
	else
	{
echo"<div align=center class=imp>Echec!Veuillez reprendre!</div>";
	}
	
}
}
// update filiére
function update_filiere(){
if(isset($_POST["sigle1"])){

	$libelle = addslashes($_POST['libelle']);
	$sigle=addslashes($_POST['sigle1']);
	//$fin=addslashes($_POST['fin']);
$mise="update filieres set libelle1='$libelle' where  sigle1='$sigle'";
	$req2=mysql_query($mise);
if($req2){
echo"<div align=center class=imp>Modification Enregistrée!</div>";
}
	else
	{
echo"<div align=center class=imp>Echec!Veuillez reprendre!</div>";
	}
	
}
}
//update classes
function update_classe(){
if(isset($_POST["code"])){

	$scode = addslashes($_POST['code']);
	$libelle=addslashes($_POST['libelle']);
	$montant=addslashes($_POST['montant']);
	//$motdepasse=addslashes($_POST['motpasse']);
//$profile=addslashes($_POST['profil']);
		$mise="update classes set libelle1='$libelle',cout3='$montant' where code='$scode'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Classe  modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="modif_classe.php?num='.$scode.'"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="modif_classe.php?num='.$scode.'"
</SCRIPT>';
	}
}
}
//update user
function update_user1(){
if(isset($_POST["code"])){

	$scode = addslashes($_POST['code']);
	$login=addslashes($_POST['libelle']);
	$cycle=addslashes($_POST['cycle']);
	$motdepasse=addslashes($_POST['motpasse']);
//$profile=addslashes($_POST['profil']);
		$mise="update users set Mot_de_Passe7='$motdepasse',cycle='$cycle',Login1='$login' where id='$scode'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Utilisateur a été modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="user.php"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="user.php"
</SCRIPT>';
	}
}
}
//update éléve
function update_eleve(){
if(isset($_POST["eleve"])){

	$matricule = addslashes($_POST['eleve']);
	$sclasse = addslashes($_POST['classe']);
	$annee=annee_academique();
	$sprenom = addslashes($_POST['prenom']);
	$snom = addslashes($_POST['nom']);
	$sadresse = addslashes($_POST['adresse']);
	$ssexe = addslashes($_POST['sexe']);
	$d_nais = addslashes($_POST['date_nais']);
	$lieu = addslashes($_POST['lieu_nais']);
	$tel_tuteur = addslashes($_POST['tel_tuteur']);
	$tuteur = addslashes($_POST['tuteur']);
	$redoublant = addslashes($_POST['redoublant']);
	$lien = addslashes($_POST['lien']);
	$email_tuteur = addslashes($_POST['email_tuteur']);
	$email_eleve = addslashes($_POST['email_eleve']);
	$tel_eleve = addslashes($_POST['tel_eleve']);
	$redoublant = addslashes($_POST['redoublant']);
	$lv1= addslashes($_POST['lv1']);
	$lv2= addslashes($_POST['lv2']);
	$lc= addslashes($_POST['lvc']);
	$lgv1="";
	$lgv2="";
	$lgc="";
	if($lv1<> 0)
	$lgv1= addslashes($_POST['lgv1']);
	if($lv2 <> 0)
	$lgv2= addslashes($_POST['lgv2']);
	if($lc <> 0)
	$lgc= addslashes($_POST['lgc']);
	
	if($_FILES['photo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['photo']['name'];
$extension_upload = strtolower(  substr(  strrchr($photo, '.')  ,1)  );
//if ( in_array($extension_upload,$extensions_valides) ){
     //echo "Extension correcte";
      $tab=explode(".",$photo);
      $nb=0;
      for($i=0;$i<strlen($photo);$i++){
		  	if(isset($tab[$i])){
		        $nb+=1;
		  	}

	   }
	$stock=getcwd();
	$dir=$stock."/photos/";
	$mynb=$nb-1;
	$p=str_replace('/', '-', $matricule);
	$logo ="eleve". $p.".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	elseif($lien<>"")
	$chemin=$lien;
	else
	$chemin="";
	
	$mise="update eleves set prenom8='$sprenom',nom8='$snom',sexe8='$ssexe',date_nais8='$d_nais',lieu_nais8='$lieu',tuteur8='$tuteur',email_tuteur8='$email_tuteur',email_eleve8='$email_eleve',tel_tuteur8='$tel_tuteur',tel_eleve8='$tel_eleve',adresse8='$sadresse',photo8='$chemin' where matricule='$matricule'";

	$req2=mysql_query($mise);
if($req2){
$sql1_ajout="update inscription set  redoublant='$redoublant',lv1='$lgv1',lv2='$lgv2',lc='$lgc' where eleve='$matricule' and annee='$annee' and classe='".htmlentities($sclasse)."'";
              $query_ajoutad=mysql_query($sql1_ajout) ;

echo'<div align=center class=imp>Données modifiées</div>';
	
}
	else
	{

		echo'<div align=center class=imp>Echec!Veuillez reprendre</div>';
		
	}
}
}
//update note eleve
function update_note(){
if(isset($_POST["eva"])){

	$evaluation = addslashes($_POST['eva']);
	$matricule=addslashes($_POST['matricule']);
	$note=addslashes($_POST['note']);
	$classe=addslashes($_POST['classe']);
$annee=addslashes($_POST['annee']);
		$mise="update notes set note='$note' where evaluation='$evaluation' and eleve='$matricule'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("note modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="el_notes.php?matricule='.$matricule.'&num='.$classe.'&annee='.$annee.'"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="el_notes.php?matricule='.$matricule.'&num='.$classe.'&annee='.$annee.'"
</SCRIPT>';
	}
}
}
//update coef
function update_coef(){
if(isset($_POST["id"])){

	$id = addslashes($_POST['id']);
	//$discipline=addslashes($_POST['discipline']);
	$coef=addslashes($_POST['coef']);
//	$motdepasse=addslashes($_POST['motpasse']);
//$profile=addslashes($_POST['profil']);
	$mise="update coefficients set coef='$coef' where idcoef='$id'";
	$req2=mysql_query($mise);
if($req2){

echo"<div align=center class=imp>Modification Coéffient Enregistrée!</div>";
	
}
	else
	{
echo"<div align=center class=imp>Echec!Veuillez reprendre!</div>";
	}
}
}
//update honneur
function update_honneur(){
if(isset($_POST["id"])){

	$id = addslashes($_POST['id']);
	$debut=addslashes($_POST['mini']);
	$fin=addslashes($_POST['maxi']);
		$mise="update honneurs set mini='$debut',maxi='$fin' where  id='$id'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("honneur a été modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="honneurs.php?vis=1"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="honneurs.php?vis=1"
</SCRIPT>';
	}
}
}
//update remarques
function update_remarque(){
if(isset($_POST["id"])){

	$id = addslashes($_POST['id']);
	$debut=addslashes($_POST['mini']);
	$fin=addslashes($_POST['maxi']);
		$mise="update remarques set mini='$debut',maxi='$fin' where  id='$id'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Remarque a été modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="remarques.php?mod=1"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="remarques.php?mod=1"
</SCRIPT>';
	}
	
}
}
// update appreciation
function update_appreciation(){
if(isset($_POST["libelle"])){

	$libelle = addslashes($_POST['libelle']);
	$debut=addslashes($_POST['debut']);
	$fin=addslashes($_POST['fin']);
		$mise="update apreciations set mini='$debut',maxi='$fin' where  libelle='$libelle'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Appréciation a été modifiée");
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

//update décision conseil
function update_decision(){
if(isset($_POST["id"])){

	$id = addslashes($_POST['id']);
	$debut=addslashes($_POST['mini']);
	$fin=addslashes($_POST['mini']);
	$etude=addslashes($_POST['etude']);
	$mise="update decisions set mini='$debut',maxi='$fin' where  id='$id'";
	$req2=mysql_query($mise);
if($req2){

echo'<script Language="JavaScript">
 {alert ("Décision a été modifiée");
 }';
	echo'
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php?mod=1"
</SCRIPT>';
}
	else
	{

		echo'<script Language="JavaScript">
 {alert ("Echec!Veuillez reprendre");
 }';
		echo'<SCRIPT LANGUAGE="JavaScript">
location.href="decision.php?mod=1"
</SCRIPT>';
	}
	
}
}
// update personnel
function update_personnel(){
	if(isset($_POST["matricule"])){
	$matricule = addslashes($_POST['matricule']);
	$titre = addslashes($_POST['titre']);
	$nom = addslashes($_POST['nom']);
	$prenom = addslashes($_POST['prenom']);
	$sexe = addslashes($_POST['sexe']);
	$tel = addslashes($_POST['tel']);
	$adresse = addslashes($_POST['adresse']);	
	$matrimonial = addslashes($_POST['matrimonial']);
	$enable=addslashes($_POST['enable']);
	$lienphoto=addslashes($_POST['lien']);
	$mail = addslashes($_POST['mail']);
	$corps = addslashes($_POST['corps']);
	$echelon = addslashes($_POST['echelon']);
	$grade = addslashes($_POST['grade']);
	$date_c = addslashes($_POST['date_c']);
	$date_nais = addslashes($_POST['date_nais']);
	$lieu_nais = addslashes($_POST['lieu_nais']);
	$profile = addslashes($_POST['classe']);
			$choix=@$_POST["choix"];
if($profile=='AUTRES'){
	$login ="";
	$password ="";
	}
	else{
	$login = addslashes($_POST['pseudo']);
	$password = addslashes($_POST['passe']);
	}
$ctrl=sizeof($choix);
if($ctrl==0 ){
echo"Attention vous n'avez pas cochez aucun cycle !!";
//exit;
}
else{
	if($_FILES['photo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['photo']['name'];
$extension_upload = strtolower(  substr(  strrchr($photo, '.')  ,1)  );
//if ( in_array($extension_upload,$extensions_valides) ){
     //echo "Extension correcte";
      $tab=explode(".",$photo);
      $nb=0;
      for($i=0;$i<strlen($photo);$i++){
		  	if(isset($tab[$i])){
		        $nb+=1;
		  	}

	   }
	$stock=getcwd();
	$dir=$stock."/photos/";
	$mynb=$nb-1;
	$p=str_replace('/', '-', $matricule);
	$logo ="perso". $p.".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	elseif($lienphoto<>"")
	$chemin=$lienphoto;
	else
	$chemin="";
	
$sql_ajout="update personnels  set titre8='$titre',prenom='$prenom',nom='$nom',matrimonial8='$matrimonial',sexe8='$sexe',tel='$tel',adresse='$adresse',photo8='$chemin',enable8='$enable',date_nais8='$date_nais',lieu_nais8='$lieu_nais'
,email8='$mail',corps5='$corps',grades5='$grade',echelons5='$echelon',date_entre8='$date_c' where matricule='$matricule'";

			$query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			$mise="delete from fonction where personnel='$matricule' and profile= '$profile'";
	$req2=mysql_query($mise);
			  while ($monchoix = array_shift($choix)) 
{
	   $exereqa=mysql_query("select * from fonction where personnel='$matricule' and profile= '$profile' and cycle='$monchoix' ");
     if(mysql_num_rows($exereqa)==0){
 	$sql_ajouta="INSERT INTO fonction VALUES ( '$matricule','$profile','$monchoix')";
   $query_ajouta=mysql_query($sql_ajouta) ;
			  }
			  else{
    	echo "<br>Existe déja";
     }
			  }
			    if($profile<>'AUTRES')
			{
			$miseu="delete from user where cdeetud='$matricule' and profile5='$profile'";
	$req2u=mysql_query($miseu);
				$sql1_ajout="INSERT INTO user VALUES ('$matricule','$login', '$password', '$profile')";
              $query_ajoutad=mysql_query($sql1_ajout) ;	
			}	
		echo"<div align=center class=imp>Modifications validées!</div>";

				
			}
			else
			{
			echo'<script Language="JavaScript">
				{alert ("Echec! Veuillez reprendre SVP!!!");
				}
</SCRIPT>';
				
			}	
 
     }
    }
}
// update perso
// update depense journaliére
function update_perso(){
	if(isset($_POST["matricule"])){
	$matricule = addslashes($_POST['matricule']);
	$titre = addslashes($_POST['titre']);
	$nom = addslashes($_POST['nom']);
	$prenom = addslashes($_POST['prenom']);
	$sexe = addslashes($_POST['sexe']);
	$tel = addslashes($_POST['tel']);
	$adresse = addslashes($_POST['adresse']);	
	$matrimonial = addslashes($_POST['matrimonial']);
	$lienphoto=addslashes($_POST['lien']);
	$mail = addslashes($_POST['mail']);
	$corps = addslashes($_POST['corps']);
	$echelon = addslashes($_POST['echelon']);
	$grade = addslashes($_POST['grade']);
	$date_c = addslashes($_POST['date_c']);
	$date_nais = addslashes($_POST['date_nais']);
	$lieu_nais = addslashes($_POST['lieu_nais']);
	$profile = addslashes($_POST['profile']);
	$login = addslashes($_POST['pseudo']);
	$password = addslashes($_POST['passe']);
	$datejour=date("Y")."-".date("m")."-".date("d");
	if($_FILES['photo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['photo']['name'];
$extension_upload = strtolower(  substr(  strrchr($photo, '.')  ,1)  );
//if ( in_array($extension_upload,$extensions_valides) ){
     //echo "Extension correcte";
      $tab=explode(".",$photo);
      $nb=0;
      for($i=0;$i<strlen($photo);$i++){
		  	if(isset($tab[$i])){
		        $nb+=1;
		  	}

	   }
	$stock=getcwd();
	$dir=$stock."/photos/";
	$mynb=$nb-1;
	$p=str_replace('/', '-', $matricule);
	$logo ="perso". $p.".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	elseif($lienphoto<>"")
	$chemin=$lienphoto;
	else
	$chemin="";
	
$sql_ajout="update personnels  set titre8='$titre',prenom='$prenom',nom='$nom',matrimonial8='$matrimonial',sexe8='$sexe',tel='$tel',adresse='$adresse',photo8='$chemin',date_nais8='$date_nais',lieu_nais8='$lieu_nais'
,email8='$mail',corps5='$corps',grades5='$grade',echelons5='$echelon',date_entre8='$date_c' where matricule='$matricule'";

			$query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
					$mise="update user set motdepasse7='$password',login1='$login' where cdeetud='$matricule' and profile5='$profile'";
	$req2=mysql_query($mise);
			
			$exereq=mysql_query("select * from connecter where personnel='$matricule' and date_connect='$datejour' and profile='$profile'");
		if(mysql_num_rows($exereq)==0){ 
			$sql_ajout1="INSERT INTO connecter  values('$matricule','$datejour','$profile')";
			$query_ajoutadc=mysql_query($sql_ajout1) ;
			
			echo'<script Language="JavaScript">
				{alert ("Modifications validées");
				}
</SCRIPT>';
				echo'<SCRIPT LANGUAGE="JavaScript">
location.href="accueil.php"
</SCRIPT>';
			
				
			} }
			else{
			echo'<script Language="JavaScript">
				{alert ("Echec! Veuillez reprendre SVP!!!");
				}
</SCRIPT>';
				
			}	
 
    }
    
}

function update_depense(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="update depenses set montant='$smontant',libelle='$libelle' where codejournee='$snumero' and datejour='$sdatejour' and agent='$personnel'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Dépense Modifiée");
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
//update dépense mensuelle
function update_depensem(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	//$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	//$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="update depenses set montant='$smontant',libelle='$libelle' where codejournee='$snumero' and annee='$annee'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Dépense Modifiée");
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
// update avance salaire
function update_avancesal(){
if(isset($_POST["code"])){

	$snumero = addslashes($_POST['code']);
	$smontant=addslashes($_POST['montant']);
	//$sdatejour=addslashes($_POST['datejour']);
	$libelle=addslashes($_POST['libelle']);
	//$personnel=addslashes($_POST['agent']);
$annee=addslashes($_POST['annee']);
	$mise="update depenses set montant='$smontant' where codejournee='$snumero' and annee='$annee'";
	$req2=mysql_query($mise);
if($req2){

	echo'<script Language="JavaScript">
							{
							alert ("Avance sur Salaire  Modifiée");
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



?>
