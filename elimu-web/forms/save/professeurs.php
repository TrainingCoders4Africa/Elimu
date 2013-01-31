<?php
	$profile=$_SESSION["profil"];
		 $table = 'fonction';
				 $lib = 'cycle';
				$champ='profile';
				if($profile=="Administrateur"){
				
				 $selection =  findCBylib($table,$lib,$champ,"PROFESSEUR");
				
}
else{
 $selection =  findCBylib($table,$lib,$champ,$profile);
}
?>
<script language="Javascript">
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
//Fonction de liste dynamique pour les professeus du cycle choisi
function go3(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('lprof').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","prof.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
		sel = document.getElementById('cycle');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		cycle = sel.options[sel.selectedIndex].value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("CYCLE_ID="+cycle);
}
//liste des disciplines dynamique pour les classes

//Fonction de liste dynamique pour disciplines du prof choisi
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
	xhr.open("POST","ajprof.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
		sel = document.getElementById('prof');
		sel1 = document.getElementById('cycle');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		prof = sel.options[sel.selectedIndex].value;
		cycle = sel1.options[sel1.selectedIndex].value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+prof+ "&CYCLE_ID=" +cycle);
}
//liste des disciplines dynamique pour les classes

function go1(){
	var xhr = getXhr();
			
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function()
	{
		// On ne fait quelque chose que si on a tout reçu et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste des élèves
			document.getElementById('uv').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","ajuv.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
			sel1 = document.getElementById('prof');
			sel2 = document.getElementById('cycle');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		prof = sel1.options[sel1.selectedIndex].value;
		sel = document.getElementById('discipline');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		discipline = sel.options[sel.selectedIndex].value;	
cycle = sel2.options[sel2.selectedIndex].value;			
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+prof+ "&MAT=" +discipline+ "&CYCLE_ID=" +cycle);
}


</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody>
<TR><TD align='left'>
<B>&nbsp;Liste des Cycles *</B><select name="cycle" id="cycle" onchange="go3()" required>
<OPTION value=""></OPTION>
<?php
				while($ro=mysql_fetch_row($selection)){
				
                            echo"<option value='".$ro[0]."'> ".$ro[0]." </option>";
    			}?>
					</select></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>

			<tr>
			
			<td  colspan=2 bgcolore="red" id="lprof" align="left">

			</td>
			<TR><TD class=petit>&nbsp;</TD></TR>

			</tr>
			<tr>
			
			<td  colspan=2 bgcolore="red" id="eleve" align="left">

			</td>
			</tr>
			<TR><TD class=petit>&nbsp;</TD></TR>

			<tr>
			<td  colspan=2 bgcolore="red" id="uv" align="left">

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD>

</TR>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["prof"]) ) {
save_prof();
}
?>