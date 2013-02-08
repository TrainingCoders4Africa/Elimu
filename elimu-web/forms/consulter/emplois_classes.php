<?php
$classe=securite_bdd($_GET['num']);
$personnel=securite_bdd($_SESSION['matricule']);
$annee=annee_academique();

?>
<form name="inscription_form" action="<?php echo lien() ;?>" method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
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
	xhr.open("POST","affemp.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne le prof
		sel3 = document.getElementById('semestre');
			sel1 = document.getElementById('classe');
		//On sélectionne la value de la prof (cad : CLASSE_ID)		
		semestre = sel3.options[sel3.selectedIndex].value;
		classe = sel1.value;
		//sel = document.getElementById('discipline');
		//On sélectionne la value de la prof (cad : CLASSE_ID)
		//discipline = sel.options[sel.selectedIndex].value;		
		//On met la sélection dans la variable que l'on va poster
		xhr.send("PROF_ID="+classe+"&SEMESTRE_ID="+semestre);
}
</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
<TR><TD><B>&nbsp;Semestre :*</B>&nbsp;&nbsp;&nbsp;&nbsp;<SELECT NAME="semestre" id="semestre" required onchange="go1()" >
 <OPTION  value=""></OPTION>
 <?php
 $sqa="SELECT id,libelle FROM semestres where annee='$annee' and id in(select semestre from emploi_temps where classe='$classe' and annee='$annee')";
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
 </OPTION></SELECT>
 </TD></TR>
 <TR><TD class=petit>&nbsp;</TD></TR>
 	</tbody>
<td><input type="hidden" name="classe" value="<?php echo $classe;?>" id="classe"></td>
</TR>
<TR><TD id="bouton"></TD></TR>

</div>
	</table>
</div>

</form>
