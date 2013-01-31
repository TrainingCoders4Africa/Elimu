<?php
$sclasse=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
$annee=annee_academique();
$sql1="select distinct id,libelle from semestres where semestres.id  in
(select  semestre from evaluations where evaluations.id in( select evaluation from notes where  notes.eleve in(select eleve from inscription where classe='$sclasse' and annee='$annee')) and annee='$annee' and type='COMPOSITION')
 order by libelle";
$datejour=date("Y")."-".date("m")."-".date("d");
?>
	<script language="Javascript">
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9/.]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
if(champ.value.charAt(x) == "."){points++;}  /*Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>

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
	xhr.open("POST","conduitenote.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	sel1 = document.getElementById('classe');
		classe = sel1.value;
			sel2 = document.getElementById('matricule');
		personnel = sel2.value;
		sel = document.getElementById('semestre');
		semestre = sel.options[sel.selectedIndex].value;
		xhr.send("SEM_ID="+semestre+"&CLASSE_ID="+classe+"&PERSO_ID="+personnel);
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
 echo" <input name='classe'  id='classe' type=hidden value='$sclasse'>
  <input name='matricule'  id='matricule' type=hidden value='$personnel'>";
?>
 </OPTION></SELECT></TD></TR>

<tr>
  <td style="padding-left:30px;" ALIGN=center>
  <table cellpadding=2 cellspacing=1 border=2 id="notes">
  </table></td></tr>
</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["semestre"]) ) {
	if(isset($_POST["classe"])){
$classe=addslashes($_POST['classe']);
$annee=addslashes($_POST['an']);
$matricule=addslashes($_POST['matricule']);
$semestre=addslashes($_POST['semestre']);
$nbart=addslashes($_POST['nbart']);

   		for ($i=1; $i<=$nbart; $i++) {
	   $code= addslashes($_POST['code'.$i.'']);
	   $note= addslashes($_POST['note'.$i.'']);
if($note>=0 and $note<=20){
 $exereq=mysql_query("select * from note_conduite where eleve='$code' and semestre='$semestre' and annee='$annee' and personnel='$matricule' ");
    if(mysql_num_rows($exereq)==0){
		   $sql="insert into note_conduite values('$code','$note','$semestre','$annee','','$matricule')";
		           
		            $exe=mysql_query($sql) or die(mysql_error());
		            if (@$exe) {
		             	echo'<script Language="JavaScript">
							{
							alert ("Notes de conduite Enregistrées");
							}
</SCRIPT>';
		echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
					
					}
		            else {
		               echo'<script Language="JavaScript">
							{
							alert ("Veuillez reprendre");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
			
		            }
		  		 }
				  else {
		               echo'<script Language="JavaScript">
							{
							alert ("Déja enregistrée");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
			
		            }
	      }
	      else{
		  echo'<script Language="JavaScript">
							{
							alert ("la note doit être comprise entre 0 et 20");
							}
</SCRIPT>';
			echo'
<SCRIPT LANGUAGE="JavaScript">
location.href="notes_conduite.php?ajout=1&num='.$classe.'"
</SCRIPT>';
		  }


 	}
	}
}
//}

?>