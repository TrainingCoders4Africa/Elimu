<?php
$_SESSION['classe']=securite_bdd($_GET['num']);
$classe=securite_bdd($_GET['num']);
$personnel=securite_bdd($_SESSION['matricule']);
$annee=annee_academique();

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
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","emplois.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le fin
		sel = document.getElementById('fin');
			sel1 = document.getElementById('Jour');
				sel2 = document.getElementById('debut');
				sel3 = document.getElementById('semestre');
				sel4 = document.getElementById('classe');
		//On sélectionne la value de la fin (cad : CLASSE_ID)
			fin = sel.options[sel.selectedIndex].value;
			jour = sel1.options[sel1.selectedIndex].value;
			debut = sel2.options[sel2.selectedIndex].value;
			semestre = sel3.options[sel3.selectedIndex].value;
			classe = sel4.value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("FIN_ID="+fin+"&JOUR_ID="+jour+"&DEBUT_ID="+debut+"&SEMESTRE_ID="+semestre+"&CLASSE_ID="+classe);
}
//liste des disciplines dynamique
function go1(){
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
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
			sel1 = document.getElementById('classe');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		classe = sel1.value;
		//sel = document.getElementById('discipline');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		//discipline = sel.options[sel.selectedIndex].value;		
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+classe);
}


</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TD><B>&nbsp;Semestre :*</B>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="semestre" id="semestre" required>
 <OPTION  value=""></OPTION>
 <?php
$sqa="SELECT id,libelle FROM semestres where annee='$annee'";
$rea=mysql_query($sqa);
while($ligna=mysql_fetch_array($rea))
{
$ids=$ligna['id'];
$slib=$ligna['libelle'];

?>
  <OPTION value="<?php echo $ids;?>"><?php echo $slib;?>
  <?php
}
?>
 </OPTION></SELECT>&nbsp;&nbsp;

<B>&nbsp;Jour :*</B>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="jour" id="Jour" required>
 <OPTION  value=""></OPTION>
 <?php
$sq="SELECT id,libelle FROM jours";
$re=mysql_query($sq);
while($lign=mysql_fetch_array($re))
{
$ids=$lign['id'];
$slib=accents($lign['libelle']);

?>
  <OPTION value="<?php echo $ids;?>"><?php echo $slib;?>
  <?php
}
?>
 </OPTION></SELECT>&nbsp;&nbsp;
<B>&nbsp;Début Cours :*</FONT></B>&nbsp;&nbsp;
<SELECT NAME="debut" id="debut" required>
<OPTION  value=""></OPTION>
<OPTION value="08:00" >8H00</OPTION>
<OPTION value="08:30">8H30</OPTION>
<OPTION value="09:00" >9H00</OPTION>
<OPTION value="9:30">9H30</OPTION>
<OPTION value="10:00" >10H00</OPTION>
<OPTION value="10:30">10H30</OPTION>
<OPTION value="11:00" >11H00</OPTION>
<OPTION value="11:30">11H30</OPTION>
<OPTION value="12:00" >12H00</OPTION>
<OPTION value="12:30">12H30</OPTION>
<OPTION value="13:00" >13H00</OPTION>
<OPTION value="13:30">13H30</OPTION>
<OPTION value="14:00" >14H00</OPTION>
<OPTION value="14:30">14H30</OPTION>
<OPTION value="15:00" >15H00</OPTION>
<OPTION value="15:30">15H30</OPTION>
<OPTION value="16:00" >16H00</OPTION>
<OPTION value="16:30">16H30</OPTION>
<OPTION value="17:00" >17H00</OPTION>
<OPTION value="17:30">17H30</OPTION>
<OPTION value="18:00" >18H00</OPTION>
<OPTION value="18:30">18H30</OPTION>
</SELECT >&nbsp;&nbsp;
<B>&nbsp;Fin Cours :*</B>&nbsp;&nbsp;
<SELECT NAME="fin" id="fin" required onchange="go()"  >

<OPTION  value=""></OPTION>
<OPTION value="09:00" >9H00</OPTION>
<OPTION value="09:30">9H30</OPTION>
<OPTION value="10:00" >10H00</OPTION>
<OPTION value="10:30">10H30</OPTION>
<OPTION value="11:00" >11H00</OPTION>
<OPTION value="11:30">11H30</OPTION>
<OPTION value="12:00" >12H00</OPTION>
<OPTION value="12:30">12H30</OPTION>
<OPTION value="13:00" >13H00</OPTION>
<OPTION value="13:30">13H30</OPTION>
<OPTION value="14:00" >14H00</OPTION>
<OPTION value="14:30">14H30</OPTION>
<OPTION value="15:00" >15H00</OPTION>
<OPTION value="15:30">15H30</OPTION>
<OPTION value="16:00" >16H00</OPTION>
<OPTION value="16:30">16H30</OPTION>
<OPTION value="17:00" >17H00</OPTION>
<OPTION value="17:30">17H30</OPTION>
<OPTION value="18:00" >18H00</OPTION>
<OPTION value="18:30">18H30</OPTION>
<OPTION value="19:00" >19H00</OPTION>
<OPTION value="19:30">19H30</OPTION>
<OPTION value="20:00" >20H00</OPTION>
<OPTION value="21:00">21H10</OPTION>
</TR>
<TR><TD class=petit>&nbsp;</TD>
<td><input type="hidden" name="classe" value="<?php echo $classe;?>" id="classe"></td>
<td><input type="hidden" name="annee" value="<?php echo $annee;?>" id="annee"></td>
</TR>

<tr>
<td id="eleve" align=left>

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>

<TR><TD class=petit>&nbsp;</TD></TR><TR><TD class=petit>&nbsp;</TD></TR>
<TR><TD id="bouton">

	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["classe"]) ) {
save_emploi();
}
?>