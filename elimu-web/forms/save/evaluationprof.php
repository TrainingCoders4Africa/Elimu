<?php
$matricule=$_SESSION['matricule'];
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
?>
<script>
function verif_nombre(champ)
{
var chiffres = new RegExp("[0-9]"); /* Modifier pour : var chiffres = new RegExp("[0-9]"); */
var verif;
var points = 0; /* Supprimer cette ligne */

for(x = 0; x < champ.value.length; x++)
{
verif = chiffres.test(champ.value.charAt(x));
/*if(champ.value.charAt(x) == "."){points++;}  Supprimer cette ligne */
if(points > 1){verif = false; points = 1;} /* Supprimer cette ligne */
if(verif == false){champ.value = champ.value.substr(0,x) + champ.value.substr(x+1,champ.value.length-x+1); x--;}
}

}
</script>
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data" >
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
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","uvprof.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('discipline');
		sel1 = document.getElementById('matricule');
		discipline = sel.options[sel.selectedIndex].value;
		matricule = sel1.value;
		xhr.send("CLASSE_ID="+discipline+ "&MAT=" +matricule);
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
			document.getElementById('etude').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","suiteprof.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
			sel1 = document.getElementById('classe');
			sel = document.getElementById('duree');
			sel2 = document.getElementById('date_p');
			sel3 = document.getElementById('debut');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		classe = sel1.options[sel1.selectedIndex].value;
		duree = sel.options[sel.selectedIndex].value;
	debut = sel3.options[sel3.selectedIndex].value;
		date_p = sel2.value;		
		//On met la sélection dans la variable que l'on va poster
		xhr.send("CL_ID="+classe+ "&DURE=" +duree+ "&DP=" +date_p+ "&DEBUT_ID=" +debut);
}
function go2(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('bouton').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","bouton.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('salle');
		salle = sel.options[sel.selectedIndex].value;
		
		xhr.send("PROF_ID="+salle);
}

</script>
	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD>
		<TD class=petit>&nbsp;<input type=hidden name="matricule" id="matricule" value="<?php echo $matricule;?>"></TD>
		</TR>
<TR>
<TR><TD>
<B>&nbsp;Liste des Spécialités*</B><select name="discipline" id="discipline" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
$sqlstm2d="select iddis,libelle from disciplines where iddis
 in(select discipline from specialites where professeur='$matricule')   ORDER BY libelle";
$req2d=mysql_query($sqlstm2d);

while($ligne2d=mysql_fetch_array($req2d))
{
$code_uv=$ligne2d['iddis'];
$slib2d=$ligne2d['libelle'];

echo' <OPTION value="'.$code_uv.'">'.$slib2d;
 }
 echo'</OPTION>';?>
					</select></TD>
 <tr ><td>
 <table id="eleve" align="left">

			</table></td></tr>
			<TR><TD class=petit>&nbsp;</TD></tr>
			<TR><TD class=petit>&nbsp;</TD></tr>
			<tr>
<td id="etude" align="left">

			</tr>
</tbody>
<TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD id="bouton"></td></tr>


</table>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["discipline"]) ) {
save_evaluation();
}