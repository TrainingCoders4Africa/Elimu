<html>

<head>
  <title>GS >> Configuration Partie 2</title>
</head>

<?php
   include "style.php";

    include"../dao/connection.php";
	$requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
   $b=mysql_fetch_object($resultat);
$a=$b->logo;
$d=date("Y")-1;
//base("archivesenabib");
   $query = "SELECT * FROM categories";
   $result = mysql_query ($query)
     or die ("Query failed");
   $ligne=mysql_fetch_row($result);
    $titre="GESTION SCOLAIRE >> Configuration Partie 2";

?>
<body>
<form name="form" action="recupdesign1.php" method="POST" enctype="multipart/form-data" onsubmit='return (conform(this));'>

<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
                   <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=center height="50"><big>Configuration  </big></td>
					  <td> <img <?php echo" <img src='logos/". $a."' align='right'  height='100%' width='30%' >";?></td>
		            </tr>

         </table>
         <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr>
		              <td align="right" height="30"> <?phpecho $titre;?></td>
		            </tr>

		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
		      
 <tr>
		            <TD>&nbsp;Série : *
&nbsp;&nbsp;&nbsp;&nbsp;</TD>

					<td>
<INPUT type="checkbox" name="choix[]" value="S" checked> S
<INPUT type="checkbox" name="choix[]" value="L" checked> L
<INPUT type="checkbox" name="choix[]" value="T"> T
<INPUT type="checkbox" name="choix[]" value="G"> G
<INPUT type="checkbox" name="choix[]" value="S1"> S1
<INPUT type="checkbox" name="choix[]" value="S2"> S2
<INPUT type="checkbox" name="choix[]" value="S3"> S3
<INPUT type="checkbox" name="choix[]" value="L1"> L1
<INPUT type="checkbox" name="choix[]" value="L'2"> L2
</td>
					</tr>
		 </table>
  		 <table border=0 cellpadding=0 cellspacing=0 width=100% height=100>			 <tr>
		              <td>&nbsp;</td>
		              <td align=right valign="bottom" bgcolore="red"><br><a href="design.php"><img src="img/prec.jpg" alt="" border="0"></a>&nbsp;&nbsp;<input type="image" src="img/suiv.jpg"> </td>
		            </tr>
          <table border=0 cellpadding=0 cellspacing=0 width=100% height="30">
		             <tr>
		             <tr bgcolor=#DD0000>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	    <img src="../images/logo.jpg"" alt="" title=""/> </td>
		            </tr>
		 </table>

		   </td>
		 </tr>
		 </table>

		 </table>


</form>


</body>

</html>