<?php
//$_SESSION['classe']=;
$classe=securite_bdd($_GET['num']);
$personnel=$_SESSION['matricule'];
// vérifier s'il ya des uv pour le lv1
$reqlv1=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$classe') 
				 and nature=(select idnature from nature where nature='Langue vivante I')");
					$lv1=mysql_num_rows($reqlv1);
					// vérifier s'il ya des uv pour le lv2
$reqlv2=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$classe') 
				 and nature=(select idnature from nature where nature='Langue vivante II')");
					$lv2=mysql_num_rows($reqlv2);
					// vérifier s'il ya des uv pour les langues classique
$reqlvc=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$classe') 
				 and nature=(select idnature from nature where nature='Langue classique')");
					$lvc=mysql_num_rows($reqlvc);
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
		<TR><TD width="21%" class=petit>&nbsp;</TD>
		</TR>
		<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Matricule &nbsp;*</B><INPUT TYPE="text" SIZE=13 MAXLENGTH="13" NAME="matricule" ONCHANGE="this.value=this.value.toUpperCase()" autofocus required>
</TD><td width="21%" ROWSPAN=1 ALIGN=LEFT NOWRAP>
<B> &nbsp;Prénom *&nbsp;</B>
<INPUT type="text" SIZE=25 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" required></td><td width="16%" ROWSPAN=1 ALIGN=LEFT NOWRAP>
<B>&nbsp;Nom *&nbsp;</B>
<INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" required></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Date Naissance &nbsp;*&nbsp;</B><INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required></TD>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Lieu Naissance &nbsp;*&nbsp;</B><INPUT  type="text" SIZE=20 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" required></td>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp; Sexe &nbsp;*&nbsp;</B>
<SELECT NAME="sexe" id="Sexe" required>
<OPTION value=""></OPTION>
<?php

				 $table = 'sexe5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}
				?>			
					</select>

</TD>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Photo</B><INPUT TYPE="file"  NAME="photo"></TD><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Teléphone &nbsp;</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel_eleve" id="téléphone" ></td><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;E-mail&nbsp;</B><INPUT TYPE="email" SIZE=30 MAXLENGTH="55" NAME="email_eleve" id="mail" >
</TD>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Tuteur &nbsp;*&nbsp;</B><INPUT type="text" SIZE=40 MAXLENGTH="100" NAME="tuteur" ONCHANGE="this.value=this.value.toUpperCase()" required></TD>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Adresse *</B><INPUT TYPE="text" SIZE=40 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required></TD>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<tr>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Téléphone Tuteur &nbsp;*</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel_tuteur" id="téléphone" required></td><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;E-mail Tuteur&nbsp;</B><INPUT TYPE="email" SIZE=30 MAXLENGTH="55" NAME="email_tuteur" id="mail_tuteur" ></td><td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Eléve Redoublant &nbsp;*&nbsp;</B><SELECT NAME="redoublant" id="redoublant?" required>
<OPTION value=""></OPTION>
<OPTION value="OUI">OUI</OPTION>
<OPTION value="NON">NON</OPTION>		
					</select>

</TD>

</TR>
</td></tr>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TR>
<?php 
if($lv1<>0){
?>

<td ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp; Langue Vivante I &nbsp;*&nbsp;</B>
<SELECT NAME="lgv1" id="LV1" required>
<?php

		 $selection =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$classe') 
		 and nature=(select idnature from nature where nature='Langue vivante I')");
		while($ro=mysql_fetch_row($selection))
			{
				//libelle discipline
					$t_discipline = findByValue('disciplines','iddis',$ro[1]);
					$champ = mysql_fetch_row($t_discipline);
					$discipline=accents($champ[1]);
					echo"<option value='".$ro[0]."'>".accents($discipline)."</option>";
    		}
				?>			
</select>

</TD>
<?php
}
if($lv2<>0){
?>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp; Langue Vivante II &nbsp;*&nbsp;</B>
<SELECT NAME="lgv2" id="Sexe">

<?php

				 $selection =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$classe') 
				 and nature=(select idnature from nature where nature='Langue vivante II')");
				while($ro=mysql_fetch_row($selection)){
				//libelle discipline
						$t_discipline = findByValue('disciplines','iddis',$ro[1]);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
				
                            echo"<option value='".$ro[0]."'>".accents($discipline)."</option>";
    			}
				?>			
					</select>

</TD>
<?php
}
if($lvc<>0){
?>
<td ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp; Langue Classique &nbsp;*&nbsp;</B>
<SELECT NAME="lgc" id="Sexe">

<?php

				 $selection =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$classe') 
				 and nature=(select idnature from nature where nature='Langue classique')");
				while($ro=mysql_fetch_row($selection)){
				//libelle discipline
						$t_discipline = findByValue('disciplines','iddis',$ro[1]);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
				
                            echo"<option value='".$ro[0]."'>".accents($discipline)."</option>";
    			}
				?>			
					</select>

</TD>
<?php
}
?>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
	</tbody>

<TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $classe;?>"></TD>

<TD class=petit>&nbsp;<input type=hidden name="agent" value="<?php echo $personnel;?>"></TD>
<TD class=petit>&nbsp;<input type=hidden name="lv1" value="<?php echo $lv1;?>"></TD>
<TD class=petit>&nbsp;<input type=hidden name="lv2" value="<?php echo $lv2;?>"></TD>
<TD class=petit>&nbsp;<input type=hidden name="lvc" value="<?php echo $lvc;?>"></TD>
</TR>
	<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Inscrire</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD>
	</table>
</div>

</form>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["classe"]) ) {
save_eleve();
}
?>