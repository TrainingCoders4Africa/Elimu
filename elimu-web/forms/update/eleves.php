<?php
$eleve=securite_bdd($_GET['eleve']);
$sclasse=securite_bdd($_GET['num']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
//$matricule=$_SESSION["matricule"];
// vérifier s'il ya des uv pour le lv1
$reqlv1=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
				 and nature=(select idnature from nature where nature='Langue vivante I')");
					$lv1=mysql_num_rows($reqlv1);
					// vérifier s'il ya des uv pour le lv2
$reqlv2=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
				 and nature=(select idnature from nature where nature='Langue vivante II')");
					$lv2=mysql_num_rows($reqlv2);
					// vérifier s'il ya des uv pour les langues classique
$reqlvc=findByNValue("credit_horaire","credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
				 and nature=(select idnature from nature where nature='Langue classique')");
					$lvc=mysql_num_rows($reqlvc);
$etagiaire = findByNValue('eleves',"matricule in (select eleve from inscription where annee='$annee' and classe='$sclasse')");
						$row = mysql_fetch_row($etagiaire);
                       //$matricule=$row[0];
                           $matricule=$row[0];
					      $prenom=$row[1];
					      $nom=$row[2];
					      $sexe=$row[3];
					      $date_nais=$row[4];
					      $lieu_nais=$row[5];
					      $tuteur=$row[6];
					      $email_tuteur=$row[7];
					      $tel_tuteur=$row[8];
					      $tel_eleve=$row[9];
					      $email_eleve=$row[10];
						  $adresse=$row[11];	
						  $photo=$row[12];	
						  $enable=$row[13];	
						 $age=$datejour-$date_nais;
						//sexe en cours
						 $se = findByValue('sexe5','id',$sexe);
						$sex = mysql_fetch_row($se);
						$sx=$sex[1];
						//Insformaion sur son choix lv1,lv2,lc et sil é redoublant ou pas
						
						 $incription = findByNValue('inscription',"eleve='$eleve' and annee='$annee' and classe='$sclasse'");
						$incript = mysql_fetch_row($incription);
						$transport=$incript[2];
						$lgv1=$incript[6];
						$lgv2=$incript[7];
						$lgc=$incript[8];
// avoir la liste des autres uv de lv1
$selectionlv1 =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
		 and nature=(select idnature from nature where nature='Langue vivante I') and idch <>'$lgv1'");
 //avoir les autre lv2
$selectionlv2 =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
				 and nature=(select idnature from nature where nature='Langue vivante II') and idch <>'$lgv2'");
// lister les autre uv de langue classique
$selectionlc =  findByNValue('credit_horaire',"credit_horaire.etude in (select etude from classes where idclasse='$sclasse') 
				 and nature=(select idnature from nature where nature='Langue classique') and idch <>'$lgc'");						  
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
<form name="inscription_form" action="<?php echo lien();?> "method="post"onsubmit='return (conform(this));' enctype="multipart/form-data">
<input name="action" value="submit" type="hidden">
<div class="formbox">

	<table border="0" cellpadding="3" cellspacing="0" width="100%" align=letf >
		<tbody>
<tr><td rowspan="19">
<?php
if($photo<>"")
echo'<img src="photos/'.$photo.'" align=center width="250" height="400">';
?>
</b></B><INPUT TYPE="file"  NAME="photo">
</td> 
<td><B>&nbsp;Matricule :&nbsp;&nbsp;&nbsp;</B><?php echo $matricule;?>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Eléve Redoublant :*</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<SELECT NAME="redoublant">
<OPTION SELECTED><?php echo $transport;?></OPTION>
<?php
if ($transport=="OUI"){

	echo "<OPTION>NON</OPTION>";
	}
elseif ($transport=="NON"){

echo "<OPTION>OUI</OPTION>";
	}
?>


</SELECT></TD>
</TD></td> 
  
<tr><td><B>&nbsp;Prénom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT type="text" SIZE=30 MAXLENGTH="50" NAME="prenom" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $prenom;?>" required>
</td></tr>
<tr><td><B>&nbsp;Nom :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="nom"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $nom?>" required></td>    </tr>
<tr><td><B>&nbsp;Date Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT type="date" SIZE=10 MAXLENGTH="20" NAME="date_nais"  required value="<?php echo $date_nais;?>"> <b>&nbsp;&nbsp;&nbsp;Age :&nbsp;&nbsp;&nbsp;<?php echo $age.' ans';?></b></td></tr>
<tr><td>
<B>&nbsp;Lieu Naissance :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="lieu_nais"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $lieu_nais;?>" required>
</td></tr>
<tr><td><B>&nbsp;Sexe :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<SELECT NAME="sexe" id="Sexe" required><OPTION value="<?php echo $sexe?>"><?php echo $sx?></OPTION>
<?php
$table = 'sexe5';
				 $selection = findNByValue('sexe5','id',$sexe);
				while($ro=mysql_fetch_row($selection)){
                            echo"<option value='".$ro[0]."'>".$ro[1]."</option>";
    			}
				?>			
					</select></td></tr>
				<tr><td>
<B>&nbspTuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=30 MAXLENGTH="50" NAME="tuteur"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $tuteur?>" required>
</td></tr>
<tr><td><B>&nbsp;Teléphone Tuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT TYPE="text" SIZE=12 MAXLENGTH="12" NAME="tel_tuteur" id="téléphone" value="<?php echo $tel_tuteur?>" required>
</td></tr>

<tr><td>
<B>&nbsp;Email-Tuteur :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="email" SIZE=30 MAXLENGTH="50" NAME="email_tuteur"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $email_tuteur?>" required>
</td></tr>
<tr><td>
<B>&nbsp;Téléphone Eléve :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT  type="text" SIZE=12 MAXLENGTH="12" NAME="tel_eleve"  ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $tel_eleve?>" >
</td></tr>
<tr><td><B>&nbsp;Email-Eléve :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<INPUT TYPE="email" SIZE=30 MAXLENGTH="50" NAME="email_eleve" id="email_eleve" value="<?php echo $email_eleve;?>"></td>    </tr>
<tr><td></td>    </tr>
<tr><td><B>&nbsp;Adresse :*&nbsp;</B>
<INPUT TYPE="text" SIZE=60 MAXLENGTH="100" NAME="adresse" id="adresse" ONCHANGE="this.value=this.value.toUpperCase()" required value="<?php echo $adresse?>"></td>    </tr>
</td></tr>
<?php
if($lv1<>0){
?>
<tr><td>
<B>&nbsp;Langue Vivante I :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<SELECT NAME="lgv1" id="Sexe" required><OPTION value="<?php echo $lgv1 ;?>"><?php echo disciplinecredit($lgv1) ;?></OPTION>
<?php

		while($rolv1=mysql_fetch_row($selectionlv1))
			{
				//libelle discipline
					$t_discipline = findByValue('disciplines','iddis',$rolv1[1]);
					$champ = mysql_fetch_row($t_discipline);
					$discipline=accents($champ[1]);
					echo"<option value='".$rolv1[0]."'>".accents($discipline)."</option>";
    		}
				?>			
					</select>
</td></tr>
</td></tr>
<?php
}
if($lv2<>0){
?>
<tr><td>
<B>&nbsp;Langue Vivante II :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<SELECT NAME="lgv2" id="Sexe" ><OPTION value="<?php echo $lgv2 ;?>"><?php echo disciplinecredit($lgv2) ;?></OPTION>
<?php
	
				while($rolv2=mysql_fetch_row($selectionlv2)){
				//libelle discipline
						$t_discipline2 = findByValue('disciplines','iddis',$rolv2[1]);
						$champ2 = mysql_fetch_row($t_discipline2);
						$discipline2=accents($champ2[1]);
				
                            echo"<option value='".$rolv2[0]."'>".accents($discipline2)."</option>";
    			}
				?>			
					</select>
</td></tr>
</td></tr>
<?php
}
if($lvc<>0){
?>
<tr><td>
<B>&nbsp;Langue Classique :*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B>
<SELECT NAME="lgc" id="Sexe" ><OPTION value="<?php echo $lgc?>"><?php echo disciplinecredit($lgc)?></OPTION>
<?php

				while($rolc=mysql_fetch_row($selectionlc)){
				//libelle discipline
						$t_discipline = findByValue('disciplines','iddis',$rolc[1]);
						$champ = mysql_fetch_row($t_discipline);
						$discipline=accents($champ[1]);
				
                            echo"<option value='".$rolc[0]."'>".accents($discipline)."</option>";
    			}
				?>			
					</select>
</td></tr>
<?php
}
?>
<tr><td><input type="hidden" name="eleve" value="<?php echo $eleve;?>"></td>
<td><input type="hidden" name="classe" value="<?php echo $sclasse;?>"></td>
<td><input type="hidden" name="lien" value="<?php echo $photo;?>"></td>
<TD class=petit>&nbsp;<input type=hidden name="lv1" value="<?php echo $lv1;?>"></TD>
<TD class=petit>&nbsp;<input type=hidden name="lv2" value="<?php echo $lv2;?>"></TD>
<TD class=petit>&nbsp;<input type=hidden name="lvc" value="<?php echo $lvc;?>"></TD>
	</tbody>
<TR><TD class=petit>&nbsp;</TD></TR>
	<tr><td><BUTTON TITLE="Confirmer la Modification de vos Données" TYPE="submit" id="flashit" name="modif">Modifier</BUTTON>
	</table>
</div>

</form>
<?php
if (isset($_POST["modif"]) and isset($_POST["eleve"]) ) {
update_eleve();
}
?>