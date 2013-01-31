<?php
$sqs="select count(*)nb from etablissements where status ='PRIVE'";
$rs=mysql_query($sqs);
$ls=mysql_fetch_array($rs);
$ns=$ls['nb'];
		$profile=$_SESSION["profil"];
			 $lib = 'cycle';
				$table = 'disciplines';
				if($profile=="Administrateur"){
 $selection = findBylib($table,$lib);
}
else{
	$selection = findByNValuelib($table,$lib," $table.cycle in(select cycle from fonction where profile='$profile')");
}
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
<form name="inscription_form" action="<?php echo lien();?>" method="post"onsubmit='return (conform(this));' >
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
			document.getElementById('dis').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","coef1.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('cycle');
		cycle = sel.options[sel.selectedIndex].value;
		xhr.send("CYCLE_ID="+cycle);
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
			document.getElementById('eleve').innerHTML = leselect;
		}
	}

	// On poste la requête ajax vers le fichier de traitement
	xhr.open("POST","coef.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
		sel = document.getElementById('discipline');
		discipline = sel.options[sel.selectedIndex].value;
		xhr.send("DISCIPLINE_ID="+discipline);
}

</script>
	<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
		<TR><TD class=petit>&nbsp;</TD></TR>
<TR>
<TR><TD ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Liste des cycles *</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="cycle" id="cycle" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
			
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[0]."</option>";
    			}?>
					</select></TD>
</TR>
			<tr>
			<td  colspan=2 bgcolore="red" id="dis" align="left">

			</td>
			</tr>
 			<tr>
			<td  colspan=2 bgcolore="red" id="eleve" align="left">

			</td>
			</tr>
</tbody>
</table>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["discipline"]) ) {
$nbart=addslashes($_POST['nbart']);
$nbsd=@addslashes($_POST['nbsd']);//nombre de sous discipline
if($nbsd<>0){
$choix=@$_POST["choix"];
$ctrl=sizeof($choix);
if($ctrl==0){
echo"Attention vous n'avez pas cochez aucun sous discipline !!";
//exit;
}
else{
if($nbart==0){
echo'insertion impossible car données déja enregistrées';
}
else{
	 while ($sdis = array_shift($choix)) 
{
$discipli=addslashes($_POST['discipline']);
$uv=$discipli.'D'.$sdis;
for ($i=1; $i<=$nbart; $i++) {
	   $niveau= addslashes($_POST['niveau'.$i.'']);
	   $nbr= addslashes($_POST['nbre_classe'.$i.'']);
	   if($nbr>0){
	   $exereq=mysql_query("select * from coefficients where etude= '$niveau' and discipline='$uv'  ");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO coefficients VALUES ( '','$nbr','$uv','$niveau')";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo"<div align=center class=imp>Données enregistrées !</div>";
			}
			else
			{
			echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  
      }
	  
     else{
    	echo "<br>coefficient déja enregistré";
     }
}
}
}
}
}
}

//sil ya pas de sous matiére
else{
if($nbart==0){
echo'insertion impossible car données déja enregistrées';
}
else{
	 
$discipli=addslashes($_POST['discipline']);
$uv=$discipli.'D';
for ($i=1; $i<=$nbart; $i++) {
	   $niveau= addslashes($_POST['niveau'.$i.'']);
	   $nbr= addslashes($_POST['nbre_classe'.$i.'']);
	   if($nbr>0){
	   $exereq=mysql_query("select * from coefficients where etude= '$niveau' and discipline='$uv'  ");
     if(mysql_num_rows($exereq)==0){
  	$sql_ajout="INSERT INTO coefficients VALUES ( '','$nbr','$uv','$niveau')";

   $query_ajout=mysql_query($sql_ajout);
			if($query_ajout){
			echo'<script Language="JavaScript">
							{
							alert ("Données Enregistrées");
							}
						</SCRIPT>';
			}
			else
			{
			echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";
     		}  
      }
	  
     else{
    	echo "<br>coefficient déja enregistré";
     }
}
}

}
}
}