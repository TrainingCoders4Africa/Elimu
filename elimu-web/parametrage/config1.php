<html>

<head>
  <title>GS >> Configuration Partie 1</title>
</head>

<?php

   include "style.php";
   //include"connect.php";
   INCLUDE"../dao/connection.php";
 $requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
   $b=mysql_fetch_object($resultat);
$a=$b->logo;
//echo '<center> Université '.$_SESSION['denomination'].' </center>';
//echo" <img src='logos/". $a."' align='left'>";
//echo '<br />';
   $query = "SELECT * FROM etablissements";
   $result = mysql_query ($query)or die (mysql_error());
   $ligne=mysql_fetch_row($result);
  
    $titre="GES: Gestion Scolaire >> Configuration Partie 1";
?>
<body>   <form name="" action="" method="post" onsubmit='return (conform(this));'enctype="multipart/form-data">

<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">

		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="50">
                   <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=center height="90"><big>Configuration</big> </td>
		              <?php
                    	if($a <>""){
                    	?>
					  <td> <img <?php echo" <img src='logos/". $a."' align='right'  height='100%' width='30%' >";?></td>
					  <?php
					}
					
					?>
		            </tr>
		</table>
			
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
		              <td align="right" height="30"><?phpecho $titre;?></td>
		            </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		 	 <tr>
		              <td width=110>IA *</td>
		              <td><input name="ia" type="text" id="IA"size="35" value="<?php echo $ligne[0];?>"ONCHANGE="this.value=this.value.toUpperCase()"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
</tr>
<TR><TD class=petit>&nbsp;</TD></TR>

<tr>
<td width=110>IDEN *</td>
		              <td><input name="iden" type="text" id="IDEN"size="35" value="<?php echo $ligne[1];?>" ONCHANGE="this.value=this.value.toUpperCase()"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>

		            </tr>
		            <TR><TD class=petit>&nbsp;</TD></TR>
	 <tr>
		              <td width=110>Etablissement *</td>
		              <td><input name="libelle" type="text" size="70" value="<?php echo $ligne[2];?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
<TD ALIGN=LEFT ROWSPAN=1 NOWRAP>&nbsp;Status: *<TD ALIGN=LEFT ROWSPAN=1 NOWRAP>
<SELECT NAME="status"><OPTION SELECTED><?php echo $ligne[12];?></OPTION>
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
</td>
		            </tr>
					<tr><td><TD class=petit>&nbsp; </td></tr>
					<tr>
					 <td>Logo </td>	
					    <td><input name="chemin" type="text" value="<?php echo $ligne[3];?>" readonly><input name="logo"  onclick="form" type="file" size="1"><?php?></td>
		           
					 </td>
					  </tr>
		</table>
         <table border=0 cellpadding=0 cellspacing=0 width=100% height="90">
		             <tr>
		              <td>Slogan<BR>
	                   <input name="slogan" type="text" size="70" value="<?php echo $ligne[4];?>" ></td>
		              <td>Date Ouverture *<BR><input name="ouverture" id="Date Ouverture" type="date" size="20"  value="<?php echo $ligne[5];?>"lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:date;erreur:champ Obligatoire'></td>
		            </tr>
		            <tr>
		              <td colspan=2>Adresse*<br><input name="adresse" type="text" size="50"  value="<?php echo $ligne[6];?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
		            </tr>
         </table>
         <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>

		  		     <td width=25%>Téléphone*<br> <input name="tel" type="text" size="20"  value="<?php echo $ligne[7];?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
					              <td width=25%>BP*<br> <input name="bp" type="text" size="20"  value="<?php echo $ligne[8];?>" ></td>
 <td width=25%>Fax*<br> <input name="fax" type="text" size="20" value="<?php echo $ligne[9];?>"  ></td>
		             
		            </tr>
		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
					<td width=25%>Site<br> <input name="site" type="text" size="40" value="<?php echo $ligne[10];?>"></td>
		              <td width=25%>Email*<br> <input name="email" id="email" type="text" size="40"  value="<?php echo $ligne[11];?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:mail;'></td>

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
          <table border=0 cellpadding=0 cellspacing=0 width=100%  height="20">
		             <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	    <img src="../images/logo.jpg"" alt="" title=""/> 
	  
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