<?php
$matricule=$_SESSION['matricule'];
if($matricule==""){
  header('Location:index.php');
  exit();}
  else{

$classe=securite_bdd($_GET['num']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$nbre_eleve=effectif_classe($classe,$annee);
?>
 <script src="ckeditor/ckeditor.js"></script>
<script>
  function limiteur()
    {
    maximum = 200;
    champ = document.inscription_form.texte;
    indic = document.inscription_form.indicateur;

    if (champ.value.length > maximum)
      champ.value = champ.value.substring(0, maximum);
    else
      indic.value = maximum - champ.value.length;
    }
</script>

<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data" >
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
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","informerclasse.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('outil');
		sel1 = document.getElementById('matricule');
		outil = sel.options[sel.selectedIndex].value;
		matricule = sel1.value;
		xhr.send("OUTIL_ID="+outil+ "&MAT=" +matricule);
}

</script>
	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD>
		<TD class=petit>&nbsp;<input type=hidden name="matricule" id="matricule" value="<?php echo $matricule;?>"></TD>
		</TR>
<?php
if($nbre_eleve==0)
echo'pas d\'inscrit dans cette classe pour l\'année académique '.$annee;
else{
?>
<TR>
<TR><TD>
<B>&nbsp;Outils Information*</B><select name="outil" id="outil" onchange="go()" required>
<OPTION value=""></OPTION>
<OPTION value="SMS">SMS</OPTION>
<OPTION value="MAIL">E-MAIL</OPTION>
</select></TD>
</TR><TR><TD class=petit>&nbsp;</TD></tr>
 <tr >
 <td id="eleve" align="left">

			</tr>
			<TR><TD class=petit>&nbsp;</TD></tr>
			<TR><TD class=petit>&nbsp;</TD></tr>
			<tr>
<td id="etude" align="left">

			</tr>
</tbody>
<tr><TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $classe;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="annee" value="<?php echo $annee;?>"></TD></tr>

</table>
<?php
if (isset($_POST["enregistrer"])){
informer();
}
}
}
?>

