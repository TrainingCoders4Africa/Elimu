<?php
//$_SESSION['classe']=;
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$type='';
$hd='';
$hf='';
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1e="SELECT count(*) ns FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1e=mysql_query($sqlstm1e);
while($lignee=mysql_fetch_array($req1e))
{
	$ns=$lignee['ns'];
	}
$sqlstm1="SELECT id,libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$annee' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
	$codes=$ligne['id'];
	$libelle=$ligne['libelle'];
	$debut=$ligne['debut'];
	$fin=$ligne['fin'];
	}
	$sqlstm1pa = "select type,horaire_debut hd,horaire_fin hf from absence_personnel where annee='$annee' and personnel='$matricule' and date_debut<='$datejour' and date_fin>='$datejour'";
$RSU1=mysql_query($sqlstm1pa);
while($lignepa=mysql_fetch_array($RSU1))
{
$type=$lignepa['type'];
$hd=$lignepa['hd'];
$hf=$lignepa['hf'];
}
?>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<script language="Javascript">
//Fonction nécessaire : ne rien modifier ici...
function getXhr()
{
    var xhr = null; 
			
	if(window.XMLHttpRequest) // Firefox et autres
		xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject)
	{ // Internet Explorer 
		try 
		{
			xhr = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	else 
	{ // XMLHttpRequest non supporté par le navigateur 
		alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
		xhr = false; 
	} 
            
	return xhr;
}

//Fonction de liste dynamique
function go()
{
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","ajax.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne la classe
		sel = document.getElementById('classe');
		//On sélectionne la value de la classe (cad : CLASSE_ID)
		classe = sel.options[sel.selectedIndex].value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("CLASSE_ID="+classe);
}
</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
		<?php
		if($ns==0){
echo $datejour .' n\'est dans  aucun semestre donc impossible de faire un traitement  pour cette date';
}
else{
 $jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
				 $datefr = $jour[date("w")];
				 
				 if($type=='HORAIRE')
$sqlst="select id,debut,fin,discipline from emploi_temps where annee='$annee' and semestre='$codes'and classe='$sclasse' and professeur='$matricule'
 and jour=(select id from jours where libelle='$datefr') and id not in
 (select emploi from cours where annee='$annee' and cours.classe='$sclasse') and ((debut <'$hd' and fin<='$hf') or ( debut < '$hd' and fin< '$hf') or(debut >='$hf' and fin>='$hf') or ( debut < '$hd' and fin> '$hf')) ";
 else
$sqlst="select id,debut,fin,discipline from emploi_temps where annee='$annee' and semestre='$codes'and classe='$sclasse' and professeur='$matricule'
 and jour=(select id from jours where libelle='$datefr') and id not in
 (select emploi from cours where annee='$annee' and cours.classe='$sclasse')";
 if($type=='JOURNEE'){
ECHO'Impossible de remplir le cahier de texte car vous être absent aujourdhui';
}
else{
?>
		<TR>
<B>&nbsp;Cours &nbsp;*&nbsp;</B><SELECT NAME="cours" id="cours" required>
<OPTION value=""></OPTION>
 <?php
$req=mysql_query($sqlst);
while($lig=mysql_fetch_array($req))
{
$id=$lig['id'];
$datep=$lig['debut'];
$discipline=$lig['fin'];
$typep=$lig['discipline'];
$table = 'disciplines';
				 $selection = findByValue($table,'iddis',$typep);
				$ro=mysql_fetch_row($selection);
                            //echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			
?>
  <OPTION value="<?php echo $id;?>"><?php echo $ro[1].' de '.$datep.' à '.$discipline;?>
  <?php
}
?>
 </OPTION></SELECT></TD></TR>
<tr>
<td><B>Titre Leçon:</font></B><input name="titre" type="text" id="Titre Leçon" required lang="bonfond:#FFFFFF;bontexte:#400040; erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champs Obligatoire"></td></tr>

<tr><td VALIGN='top' width="70" ROWSPAN=1 ALIGN=LEFT NOWRAP SIZE="2"><B>Details Leçon </B></td></tr><tr>
<td>  <textarea name="lesson"  id="Grandes lignes du Cours"   class=kc1 cols='80' rows='5' ></textarea></td></tr>
</tr>
<TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=90%></TD></TR>


	</tbody>
<TR><TD class=petit>&nbsp;</TD>

<TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $sclasse;?>"></TD>
<td> <input type=hidden name="semestre"  value="<?php echo $codes;?>"></td>
<TD class=petit>&nbsp;<input type=hidden name="matricule" value="<?php echo $personnel;?>"></TD>
</TR>
	<TR><TD><BUTTON TITLE="Confirmer l'Emargement"name="enregistrer" TYPE="submit" id="flashit"><b>Emarger</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["classe"]) ) {
save_cahiertexte();
}
}
}
?>