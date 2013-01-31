<?php
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$sql1="select distinct id,libelle from semestres where semestres.id  in
(select  semestre from evaluations where evaluations.id in( select evaluation from notes where  notes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee')) and annee='$annee' and type='COMPOSITION')
 order by libelle";
?>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">
<script language="Javascript">
//Fonction nécessaire : ne rien modifier ici...
function getXhr(){
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
function go(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('notes').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","deliberer.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	sel1 = document.getElementById('classe');
		classe = sel1.value;
		sel = document.getElementById('semestre');
		semestre = sel.options[sel.selectedIndex].value;
		xhr.send("SEM_ID="+semestre+"&CLASSE_ID="+classe);
}
function go1(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('elevenote').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","elevenote.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	sel1 = document.getElementById('classe');
		sel = document.getElementById('semestre');
		semestre = sel.options[sel.selectedIndex].value;
		sel3 = document.getElementById('eleve');
		eleve = sel3.options[sel3.selectedIndex].value;
		classe = sel1.value;
		xhr.send("SEM_ID="+semestre+"&ELEVE_ID="+eleve+"&CLASSE_ID="+classe);
}

</script>

<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
				<TR>
<B>&nbsp;Liste des Semestres &nbsp;*&nbsp;</B><SELECT NAME="semestre" id="semestre" required onchange="go()">
<OPTION value=""></OPTION>
 <?php

$req1=mysql_query($sql1);
while($ligne1=mysql_fetch_array($req1))
{
$id=$ligne1['id'];
$libsemestre=$ligne1['libelle'];
?>
  <OPTION value="<?php echo $id;?>"><?php echo $libsemestre;?>
  <?php
}
 echo" <input name='classe'  id='classe' type=hidden value='$sclasse'>";
?>
 </OPTION></SELECT></TD></TR>
 <tr colspan=2 bgcolore="red" id="notes" align="left">

			</tr>

<tr><Td ALIGN="left" ROWSPAN="1" NOWRAP>&nbsp;&nbsp;</Td></tr>
<table border="1" cellspacing="0" bordercolor="black" cellpadding="2" id="elevenote" width="100" ALIGN="center">		
</tbody></table></div></form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["semestre"]) ) {
$semestre = addslashes($_POST['semestre']);
$eleve = addslashes($_POST['eleve']);
$annee = addslashes($_POST['annee']);
$moyenne = addslashes($_POST['moyenne']);
$nbart=addslashes($_POST['nbart']);
$sql="insert into moyennes values('$eleve','$moyenne','$semestre','$annee')";
		           
		            $exe=mysql_query($sql) or die(mysql_error());
		            if (@$exe) {
					for ($i=1; $i<=$nbart; $i++) {
	   $discipline= addslashes($_POST['disci'.$i.'']);
	   $moydis= addslashes($_POST['moydis'.$i.'']);
	   $sqldis="insert into moyennediscipline values('$eleve','$discipline','$moydis','$semestre','$annee')";
	$dis=mysql_query($sqldis) or die(mysql_error());
					}
		             	echo'<script Language="JavaScript">
							{
							alert ("Semestre Délibéré");
							}
</SCRIPT>';
						}
 else {
		               echo'<script Language="JavaScript">
							{
							alert ("Veuillez reprendre");
							}</SCRIPT>';
}
}


?>