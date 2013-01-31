
<html>

<head>
  <title>GS >> Configuration Partie 3</title>
</head>

<?php

   include "style.php";
    $titre="GESTION SCOLAIRE >> Configuration Partie 3";
    include"../dao/connection.php";
		$requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
   $b=mysql_fetch_object($resultat);
$a=$b->logo;
$d=date("Y")-1;
//base("gescosen");
$query=mysql_query("select code,libelle,date_format(date_debut,'%d/%m/%Y'),date_format(date_fin,'%d/%m/%Y') from semestres");
 //$result = mysql_query ($query)or die ("Query failed");
//$rw=mysql_fetch_row($query);
//$req1=mysql_query($query);

while($ligne=mysql_fetch_array($query))
{
	$code=$ligne['code'];
		$libelle=$ligne['libelle'];

   $debut=$ligne["date_format(date_debut,'%d/%m/%Y')"];
	$fin=$ligne["date_format(date_fin,'%d/%m/%Y')"];

}
?>
<body>
<form name="" action="recupadmin.php" method="POST" enctype="multipart/form-data"  onsubmit='return (conform(this));'>

<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top">
		<table border=0 cellpadding=0 cellspacing=5 width=100% >
                   <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=center height="90"><big>Configuration</big></td>
					   <td> <img <?php echo" <img src='logos/". $a."' align='right'  height='100%' width='30%' >";?></td>
		            </tr>

         </table>
         <table border=0 cellpadding=0 cellspacing=5 width=100%>
		            <tr>
		              <td align="right" height="50"> GESNOTES >> Semestres</td>
		            </tr>

		 </table>
		 <table border=0 cellpadding=0 cellspacing=5 width=100%>
		 			<tr>
		              <td >Code</td>
		              <td><input name="code" type="text" value="<?php echo $code;?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
		            </tr>
		            <tr>
		              <td >Libelle</td>
		              <td><input name="libelle" type="text" value="<?php echo $libelle;?>"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
		            </tr>
		            <tr>
		              <td>Date Début</td>
		              <td><input name="date_d" type="text" value="<?php echo $debut;?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
		            </tr>
      <tr>
		              <td >Date Fin</td>
		              <td><input name="date_f" type="text" value="<?php echo $fin;?>"  lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></td>
		            </tr>
		            <tr>
		              <td>Année Académique</td>
					 			  <TD><input type="text" name="annee_a" value="<?php echo $d."/".date("Y");?>" lang='bonfond:#FFFFFF;bontexte:#400040;erreurfond:#FF0000;bontexte:#0000FF; type:obligatoire;erreur:champ Obligatoire'></TD>
		             		            </tr>
		 </table>
  		 <table border=0 cellpadding=0 cellspacing=5 width=100% height=100>
  		 <tr>
		              <td>&nbsp;</td>
		              <td align=right valign="bottom" bgcolore="red"><br><a href="design1.php"><img src="img/prec.jpg" alt="" border="0"></a>&nbsp;&nbsp;
		              <input type="image" src="img/suiv.jpg"></td>
		            </tr>
          <table border=0 cellpadding=0 cellspacing=5 width=100% height="28">
		             <tr>
		             <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	    <img src="../images/logo.jpg"" alt="" title=""/> </td>
		            </tr>
		 </table>


		 </table>

</table>


</form>


</body>

</html>