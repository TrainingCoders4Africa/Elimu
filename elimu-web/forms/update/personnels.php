<?php
//modification des infos du personnel
$matricule=securite_bdd($_GET['upd']);
$etagiaire = findByValue('personnels','matricule',$matricule);
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $titre=$row[1];
					      $prenom=$row[2];
					      $nom=$row[3];
					      $matrimonial=$row[4];
					      $sexe=$row[5];
					      $date_nais=$row[6];
					      $lieu_nais=$row[7];
					      $tel=$row[8];
					      $adresse=$row[9];
					      $email=$row[10];
					      $photo=$row[11];
						  $enable=$row[12];	
						  $corps=$row[13];	
						  $grade=$row[14];	
						  $echelon=$row[15];	
						  $date_c=$row[16];
						   //enable en cours
						  $naturee = findByValue('enable5','id',$enable);
						$entitee = mysql_fetch_row($naturee);
						$profilee=$entitee[1];
	if($enable==1)
	$etat='En Activité';
	else
	$etat=$profilee;
						  //profile en cours
						  $nature = findByValue('fonction','personnel',$matricule);
						$entite = mysql_fetch_row($nature);
						$profile=$entite[1];
						  //titre en cours
						   $titres = findByValue('titre5','id',$titre);
						$tit = mysql_fetch_row($titres);
						$tre=$tit[1];
						//sexe en cours
						 $se = findByValue('sexe5','id',$sexe);
						$sex = mysql_fetch_row($se);
						$sx=$sex[1];
						//matrimonial en cours
						   $matri = findByValue('matrimonial5','id',$matrimonial);
						$mat = mysql_fetch_row($matri);
						$ma=$mat[1];
						//grades en cours
						 $seg = findByValue('grades5','id',$grade);
						$sexg = mysql_fetch_row($seg);
						$gr=$sexg[1];
						//echelons en cours
						   $titrese = findByValue('echelons5','id',$echelon);
						$titec = mysql_fetch_row($titrese);
						$echel=$titec[1];
						//corps en cours
						 $seco = findByValue('corps5','id',$corps);
						$sexco = mysql_fetch_row($seco);
						$co=$sexco[1];
						  
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
<form name="inscription_form" action=<?php echo lien();?> method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
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
	xhr.open("POST","ajax1.php",true);
	
	// ne pas oublier ça pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			
	// ne pas oublier de poster les arguments
		//On sélectionne la classe
		sel = document.getElementById('classe');
		inp = document.getElementById('matricule');
		//On sélectionne la value de la classe (cad : CLASSE_ID)
		classe = sel.options[sel.selectedIndex].value;
		matricul=inp.value;
		//On met la sélection dans la variable que l'on va poster
		xhr.send("CLASSE_ID="+classe+ "&MAT=" +matricul);
}
</script>


	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
		<TR>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Matricule *</B><INPUT TYPE="text" SIZE=13 MAXLENGTH="13" NAME="matricule" value="<?php echo $matricule?>" id="matricule" readonly>
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Titre *</B><SELECT NAME="titre" required autofocus />
<OPTION  value="<?php echo $titre?>"><?php echo $tre?></OPTION>
<?php
				 $selection = findNByValue('titre5','id',$titre);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>
</SELECT ></td>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Prénom *&nbsp;</B><INPUT type="text" SIZE=25 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo accents($prenom);?>" required></TD>

</TR>
<TR><TD class=petit>&nbsp;</TD></TR>

<tr>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Nom *</B><INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $nom ;?>" required>
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Date Naissance *&nbsp;</B><INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required value="<?php echo $date_nais ;?>">
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Lieu Naissance *</B><INPUT  type="text" SIZE=20 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $lieu_nais ;?>" required></TD>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<?php
if($photo<>"")
echo'<img src="photos/'.$photo.'" align=center width="100" height="100">'
?>
</b><B>&nbsp;Photo</B><INPUT TYPE="file"  NAME="photo">
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Sexe *</B><SELECT NAME="sexe" id="Sexe" required>
<OPTION value="<?php echo $sexe?>"><?php echo accents($sx)?></OPTION>
<?php

				 $table = 'sexe5';
				 $selection = findNByValue('sexe5','id',$sexe);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}
				?>			
					</select></td><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
					<B>&nbsp;Situation Matrimoniale *:&nbsp;</B><SELECT NAME="matrimonial" id="Situation Matrimoniale" required>
<OPTION value="<?php echo $matrimonial?>"><?php echo accents($ma)?></OPTION>
			<?php
				 $selection = findNByValue('matrimonial5','id',$matrimonial);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
			
					</select></TD>
					</td>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Teléphone *&nbsp;</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel" id="téléphone" value="<?php echo $tel?>" required>
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;Adresse *</B><INPUT TYPE="text" SIZE=30 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required value="<?php echo $adresse?>">
</td><td ROWSPAN=1  ALIGN=LEFT NOWRAP><B>&nbsp;E-mail&nbsp;*</B><INPUT TYPE="email" SIZE=25 MAXLENGTH="55" NAME="mail" id="mail" required value="<?php echo $email?>"></TD>
</TR>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Corps *</B><SELECT NAME="corps" id="corps" required>
<OPTION value="<?php echo $corps?>"><?php echo $co?></OPTION>
<?php
				 $selection = findNByValue('corps5','id',$corps);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
</select></td><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Grade *</B><SELECT NAME="grade" id="grade" required>
<OPTION value="<?php echo $grade?>"><?php echo $gr?></OPTION>
<?php
				 $table = 'grades5';
				 $selection = findNByValue('grades5','id',$grade);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
					</select></td><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Echelon *</B><SELECT NAME="echelon" id="echelon" required>
<OPTION value="<?php echo $echelon?>"><?php echo $echel?></OPTION>
<?php
				 $table = 'echelons5';
				 $selection = findNByValue('echelons5','id',$echelon);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
					</select></td></tr>
<TR><TD ROWSPAN=1 COLSPAN=4><HR width=100%></TD></TR>
<TR>
					<td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Date Commencement&nbsp;*</B><INPUT TYPE="date" SIZE=12 MAXLENGTH="12" NAME="date_c" id="date" value="<?php echo $date_c;?>"required></TD>


<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Etat *:&nbsp;</B><SELECT NAME="enable" id="Sexe" ONCHANGE="this.value=this.value.toUpperCase()">
<OPTION value="<?php echo $enable;?>"><?php echo $etat;?></OPTION>
<?php
				 $table = 'enable5';
				 $selection = findNByValue('enable5','id',$enable);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
					</select></td><td ROWSPAN=1  ALIGN=LEFT NOWRAP>
<B>&nbsp;Profile *</B><select name="classe" id="classe" onchange="go()" required>
<option></option>
<OPTION value="<?php echo $profile?>"><?php echo $profile?></OPTION>
<?php
				 $table = 'profiles';
				 $lib = 'libelle';
				 $selection = findNBylib($table,$lib,$lib,$profile);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[0]."</option>";
    			}?>
					</select></TD>
						<td><input type="hidden" name="lien" value="<?php echo $photo;?>"></td>
</TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr>
			<td  colspan=2 bgcolore="red" id="eleve">

			</td>
			</tr>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><input class=kc1 type="submit" name="modif" value="Modifer" />
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["matricule"]) ) {
update_personnel();
}
?>