<html lang="fr">
<head>
<script>
function ChangeTitle(title, step){
	if(step==undefined || step > title.length)step=0;
	document.title=title.substr(step) + title.substr(0, step);
	step++;
	setTimeout('ChangeTitle("' + title + '", ' + step + ');', 100);
}

// C'est ici que ça se passe. Ecrivez le titre que vous voulez
ChangeTitle("ELIMU: GESTION SCOLAIRE & COLLABOTION PARENTS ET ADMINISTRATION VIA SYSTEME SMS ");
</script>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

</head>
<?php
include"../dao/connection.php";
 include "style.php";
   $titre="ELIMU >> Paramétrage Partie I";
$query = "SELECT * FROM etablissements";
   $result = mysql_query ($query)or die (mysql_error());
   $ligne=mysql_fetch_row($result);
?>
<body>   <form name="" action="recupconfig.php"  method="post" onsubmit='return (conform(this));' enctype="multipart/form-data" >

<table border=10 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">

		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="50">
                   <tr class="titr">
		              <td COLSPAN=2 align=center height="90"><b><big>Configuration</big><b> </td>
		              <?php
                    	if($ligne[3] <>""){
                    	?>
					  <td> <img <?php echo" <img src='logos/". $ligne[3]."' align='right'  height='100%' width='30%' >";?></td>
					  <?php
					}
					
					?>
		            </tr>
		</table>
			
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
		              <td align="right" height="30"><b><?php echo $titre;?></td>
		            </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		 	 <tr>
		              <td ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;<b>IA :*&nbsp;<b><input name="ia" type="text" id="Inspection Académique"size="30" value="<?php echo @$ligne[0];?>" ONCHANGE="this.value=this.value.toUpperCase()" placeholder="Inspecton Académique" required >
					  </td>  <td ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;<b>IEF :*&nbsp;</b><input name="iden" type="text" id="Inspection de l'Education et de la Formation"size="40" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $ligne[1];?>" placeholder="IEF de Pikine par exemple" required></td>
</tr>
<TR><TD class=petit>&nbsp;</TD></TR>
	 <tr>
<td ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;<b>Etablissement :*&nbsp;</b><input name="libelle" type="text" id="Etablissement"size="50" ONCHANGE="this.value=this.value.toUpperCase()" value="<?php echo $ligne[2];?>" placeholder="Nom Etablissement"required></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>&nbsp;<b>Statut :*&nbsp;</b><SELECT NAME="status" required><OPTION><?php echo $ligne[12];?></OPTION>
<?php
if ($ligne[12]=="PUBLIC"){

	echo "<OPTION>PRIVE</OPTION>";
	}
elseif ($ligne[12]=="PRIVE"){

echo "<OPTION>PUBLIC</OPTION>";
	}
	
else{

	echo "<OPTION>PUBLIC</OPTION>";
	echo "<OPTION>PRIVE</OPTION>";
}
?>
</td> </tr>
					<tr><td><TD class=petit>&nbsp; </td></tr>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Logo :&nbsp;</b>
					<?php if( $ligne[3]==""){?>
<input name="logo" id="logo"type="file" >
<?php
}
else{
?>
<input name="chemin" type="text" value="<?php echo $ligne[3];?>" readonly>
<input name="logo" id="logo"type="file" >
<?php
}
?></td>
   <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Date Ouverture :*&nbsp;</b></BR><input name="ouverture" id="Date Ouverture" type="date" size="20"  value="<?php echo @$ligne[5];?>" placeholder="<?php echo date("Y")."-".date("m")."-".date("d");?>" required lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:date;erreur:champ Obligatoire'></td>
    </tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
		        <tr>
		              <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Slogan :&nbsp;</b><input name="slogan" type="text" size="40" value="<?php echo $ligne[4];?>" placeholder="Travail,Discipline, Reussite" ></td>
		           
		              <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Adresse :*&nbsp;</b><input name="adresse" id="Adresse" type="text" size="50" value="<?php echo $ligne[6];?>" placeholder="Adresse Etablissement"  required></td>
		            </tr>
					<TR><TD class=petit>&nbsp;</TD></TR>
         <tr>

		  		     <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Téléphone :*&nbsp;</b> <input name="tel" id="t&eacute;l&eacute;phone Etablissement" type="text" size="20" value="<?php echo $ligne[7];?>" placeholder="Numéro Téléphone" required></td>
					    <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;BP :&nbsp; </b> <input name="bp" id="Boite Postale" type="text" size="20"  value="<?php echo $ligne[8];?>" placeholder="Boite Postale" ></td>
 <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Fax :&nbsp;</b><br> <input name="fax" type="text" size="20" value="<?php echo $ligne[10];?>"  ></td>
		             
		            </tr>
					<TR><TD class=petit>&nbsp;</TD></TR>
		 <tr>
					<td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Site :&nbsp;</b> <input name="site" type="text" size="50" value="<?php echo $ligne[9];?>" placeholder="http://www.coders4africa.org" ></td>
		              <td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>&nbsp;Email :*&nbsp;</b> <input name="email" id="email" type="email" size="40"  value="<?php echo @$ligne[11];?>" required  placeholder="votre@dresse.fr"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:mail;'></td>

		             </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		             <tr>
		              <td width=100>&nbsp;</td>
		              <td align=right>
		              <?php
		              
                          echo'<input type="image" src="img/suiv.jpg" >';
		               

		              ?>
		              </td>
		            </tr>
		 </table>
		 <table>
<tr><td><big><b><U>NB:</td></tr>
<tr>
<td><b> * </b>: Champs Obligatoite</td>
</tr>
<tr>
<td><b> IA </b>: Inspection Académique</td>
</tr>
<tr>
<td><b> IEF </b>: Inspection de l'Education et de la Formation, remplace IDEN</td>
</tr>
</table>
          <table border=0 cellpadding=0 cellspacing=0 width=100%  height="20">
		             <tr>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	     <img src="images/c4a.jpg"" alt="" title=""/> 
	  
					  </td>
		            </tr>
		 </table>

		   </td>
		 </tr>
		 </table>
	  </td>
	</tr>
		 </table>


</form>


</body>

</html>