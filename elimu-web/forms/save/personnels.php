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


	<table border="0" cellpadding="3" cellspacing="0"  align=letf >
		<tbody>
		
<TD  ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Matricule *</B>
 <INPUT TYPE="text" SIZE=13 MAXLENGTH="13" NAME="matricule" ONCHANGE="this.value=this.value.toUpperCase()" required></td>
<TD  ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Titre *</B>
  <SELECT NAME="titre" required autofocus />
<OPTION  value=""></OPTION>
<?php
				 $table = 'titre5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>
</SELECT ></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Prénom *&nbsp;</B><INPUT type="text" SIZE=20 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" required></TD>

<TR></TR>
<TR><TD class=petit>&nbsp;</TD></TR>

<tr>
<TD  ALIGN=LEFT ROWSPAN=1 NOWRAP colspan="0"><B>&nbsp;Nom *</B><INPUT  type="text" SIZE=20 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" required></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Date Naissance *&nbsp;</B><INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Lieu Naissance *</B><INPUT  type="text" SIZE=20 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" required></TD>
</TR>

<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>

<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Photo</B><INPUT TYPE="file"  NAME="photo"></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Sexe *</B><SELECT NAME="sexe" id="Sexe" required>
<OPTION value=""></OPTION>
<?php

				 $table = 'sexe5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".($ro[1])."</option>";
    			}
				?>			
					</select></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Situation Matrimoniale *:&nbsp;</B><SELECT NAME="matrimonial" id="Situation Matrimoniale" required>
<OPTION value=""></OPTION>
			<?php

				 $table = 'matrimonial5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
			
					</select></TD>
</TR>

<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>

<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Teléphone *&nbsp;</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel" id="téléphone" required></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Adresse *</B><INPUT TYPE="text" SIZE=30 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required></td>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;E-mail&nbsp;*</B><INPUT TYPE="email" SIZE=25 MAXLENGTH="55" NAME="mail" id="mail" required></TD>
</TR>

<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>

<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Corps *</B><SELECT NAME="corps" id="corps" required>
<OPTION value=""></OPTION>
<?php

				 $table = 'corps5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
</select></td><td>
<B>&nbsp;Grade *</B><SELECT NAME="grade" id="grade" required>
<OPTION value=""></OPTION>
<?php
				 $table = 'grades5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
					</select></td><td  ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Echelon *</B><SELECT NAME="echelon" id="echelon" required>
<OPTION value=""></OPTION>
<?php
				 $table = 'echelons5';
				 $selection = findByAll($table);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
					</select></td></tr>

<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>

<TR>
<td  ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Date Commencement&nbsp;*</B><INPUT TYPE="date" SIZE=12 MAXLENGTH="12" NAME="date_c" id="date" required></TD>
<TD  ALIGN=LEFT ROWSPAN=1 NOWRAP>
<B>&nbsp;Profile *</B><select name="classe" id="classe" onchange="go()" required>
<OPTION value=""></OPTION>
<?php
				 $table = 'profiles';
				 $lib = 'libelle';
				 $selection = findBylib($table,$lib);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[0]."</option>";
    			}?>
					</select></TD>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
			<td  colspan=2 bgcolore="red" id="eleve">

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><input class=kc1 type="submit" value="Valider"  />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" />
	</table>
</div>

</form>
<?php
save_personnel();
?>