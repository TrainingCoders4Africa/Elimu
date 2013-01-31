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
	xhr.open("POST","ajenseignant.php",true);
	
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
<TR><TD>
<B>&nbsp;Liste des Enseignants *</B><select name="classe" id="classe" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
				 $table = 'personnels';
				 $lib = 'libelle';
				 $selection =  findByNValue($table,"enable8='1' and matricule in(select personnel from fonction where profile='ENSEIGNANT')");
				while($ro=mysql_fetch_row($selection)){
				$etag = findByValue('titre5','id',$ro[1]);
						$cha = mysql_fetch_row($etag);
						$titre=$cha[1];
                            echo"<option value='".$ro[0]."'>".$titre." ".$ro[2]." ".$ro[3]."</option>";
    			}?>
					</select></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
			<td  colspan=2 bgcolore="red" id="eleve" align="left">

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD>

</TR>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["classe"]) ) {
save_enseignant();
}
?>