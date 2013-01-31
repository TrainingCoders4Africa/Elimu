<?php
$matricule=$_SESSION["matricule"];
$etagiaire = findByValue('personnels','matricule',$matricule);
						$row = mysql_fetch_row($etagiaire);

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
						 
						  //profile en cours
						  $nature = findByValue('fonction','personnel',$matricule);
						$entite = mysql_fetch_row($nature);
						$profile=$entite[1];
						//mot de passe
						 $table0 = 'user';
						$natures = findByNValue($table0,"profile5='$profile' and cdeetud='$matricule'");
						$entites = mysql_fetch_row($natures);
						$login=$entites[1];
						$passe=$entites[2];
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

	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
<tr><td rowspan="19">
<?php
if($photo<>"")
echo'<img src="photos/'.$photo.'" align=center width="250" height="400">';
else
echo'<img src="photos/personull.png" align=center width="250" height="400">';
?>
</b></B><INPUT TYPE="file"  NAME="photo">
</td>   <td><B>&nbsp;Matricule :&nbsp;&nbsp;&nbsp;</B><?php echo $matricule;?>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?php echo $profile;?>
</TD></td> 
<tr><td><B>&nbsp;Titre :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="titre" required autofocus />
<OPTION  value="<?php echo $titre?>"><?php echo $tre?></OPTION>
<?php
				 $selection = findNByValue('titre5','id',$titre);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>
</SELECT ></td>    </tr>  
<tr><td ><B>&nbsp;Prénom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT type="text" SIZE=30 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo accents($prenom) ;?>" required>
</td></tr>
<tr><td><B>&nbsp;Nom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo accents($nom);?>" required></td>    </tr>
<tr><td><B>&nbsp;Date Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required value="<?php echo $date_nais?>"></td>    </tr>
<tr><td>
<B>&nbsp;Lieu Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo accents($lieu_nais) ;?>" required></td>    </tr>
<tr><td><B>&nbsp;Sexe :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="sexe" id="Sexe" required>
<OPTION value="<?php echo $sexe?>"><?php echo accents($sx) ;?></OPTION>
<?php

				 $table = 'sexe5';
				 $selection = findNByValue('sexe5','id',$sexe);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}
				?>			
					</select></td></tr>
					<tr><td><B>&nbsp;Situation Matrimoniale :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="matrimonial" id="Situation Matrimoniale" required>
<OPTION value="<?php echo $matrimonial?>"><?php echo accents($ma) ;?></OPTION>
			<?php
				 $selection = findNByValue('matrimonial5','id',$matrimonial);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".accents($ro[1])."</option>";
    			}?>
			
					</select></td>    </tr>
<tr><td><B>&nbsp;Teléphone :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel" id="téléphone" value="<?php echo $tel?>" required>
</td></tr>

<tr><td><B>&nbsp;Corps :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="corps" id="corps" required>
<OPTION value="<?php echo $corps?>"><?php echo $co?></OPTION>
<?php
				 $selection = findNByValue('corps5','id',$corps);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
</select></td>    </tr>
<tr><td><B>&nbsp;Grade :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="grade" id="grade" required>
<OPTION value="<?php echo $grade?>"><?php echo $gr?></OPTION>
<?php
				 $table = 'grades5';
				 $selection = findNByValue('grades5','id',$grade);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
					</select></td>    </tr>
<tr><td><B>&nbsp;Echelon :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><SELECT NAME="echelon" id="echelon" required>
<OPTION value="<?php echo $echelon?>"><?php echo $echel?></OPTION>
<?php
				 $table = 'echelons5';
				 $selection = findNByValue('echelons5','id',$echelon);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}?>
					</select></td>    </tr>
<tr><td><B>&nbsp;Début Carriére:*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT TYPE="date" SIZE=12 MAXLENGTH="12" NAME="date_c" id="date" value="<?php echo $date_c;?>"required></td>    </tr>
<tr><td></td>    </tr>
<tr><td><B>&nbsp;Pseudo :* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>&nbsp;<input name="pseudo" type="text"  id="pseudo" value="<?php echo $login;?>" required></td>    </tr>
<tr><td><B>&nbsp;PassWord :*</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="passe" type="password" id="password"  value="<?php echo $passe;?>"required></td>    </tr>
<tr><td><B>&nbsp;Adresse :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</B><INPUT TYPE="text" SIZE=35 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required value="<?php echo $adresse?>"></td>    </tr>
<tr><td><B>&nbsp;E-mail :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT TYPE="email" SIZE=35 MAXLENGTH="100" NAME="mail" id="mail" required value="<?php echo $email?>"></td>    </tr>
<tr><td><input type="hidden" name="matricule" value="<?php echo $matricule;?>"></td>
<td><input type="hidden" name="profile" value="<?php echo $profile;?>"></td>
<td><input type="hidden" name="lien" value="<?php echo $photo;?>"></td>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><BUTTON TITLE="Confirmer la Modification de vos Données" TYPE="submit" id="flashit" name="modif">Modifier</BUTTON>
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["matricule"]) ) {
update_perso();
}
?>