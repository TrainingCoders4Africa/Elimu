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
   $titre="ELIMU >> Paramétrage Partie III";
		$requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
 $ligne=mysql_fetch_array($resultat);
$a=$ligne['logo'];
$d=date("Y")-1;
// vérifier si l'Etablissement a un cycle moyen
 $exess1=mysql_query("select count(*)nb from categories where cycle='MOYEN'");
                 while ($roi1=mysql_fetch_array($exess1)) {
				 $nb=$roi1["nb"];
				 }
$query=mysql_query("select * from formules");
 //$result = mysql_query ($query)or die ("Query failed");
$rw=mysql_fetch_row($query);
?>
<body>   <form name="form" action="recupprofile.php" method="POST" enctype="multipart/form-data" onsubmit='return (conform(this));'>
<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">
	    <table border=1 cellpadding=0 cellspacing=0 width=50% height="300">
                   <tr>
		              <td valign="top"  style="padding-left:5px;padding-right:5px;padding-bottom:5px;padding-top:5px;">
		<table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
                   <tr  class="titr">  
				   <td COLSPAN=2 align=center height="50"><b><big>Configuration  </big></b></td>
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
		            <tr class="legend">
		              <td align="right" height="30"  ><b> <?phpecho $titre;?></b></td>
		            </tr>

		 </table>
		 		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
		      
 <tr>

<td><b>Formule Moyenne Annuelle *:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<SELECT NAME="formule" id="Formule Moyenne Annuelle" required autofocus>
<?php
	echo "<OPTION></OPTION>";

	echo "<OPTION>(MoySem1 + MoySem2*2)/3</OPTION>";
	echo "<OPTION>(MoySem1 + MoySem2)/2</OPTION>";

?>
</SELECT>
</td></tr>
				   <?php
				  
				   if($nb <> 0) {
				   ?>
				   
<tr><td><b>Note Conduite Pour le cycle Moyen *:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<SELECT NAME="conduite" id="Note conduite" required>
<?php
	echo "<OPTION></OPTION>";
	echo "<OPTION>OUI</OPTION>";
	echo "<OPTION>NON</OPTION>";
?>
</SELECT>
</td></tr>
<?php
					}
					?>


		    </table>
		              
					   <table border=0 cellpadding=0 cellspacing=0 width=100% height=100>
					   <tr>      <td>&nbsp;</td><td align=right>
					  <br><a href="design.php"><img src="img/prec.jpg" alt="" border="0"></a>
		              &nbsp;&nbsp;<input type="image" src="img/suiv.jpg">
					   </td>
         
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="20">
		             <tr>
		              <td COLSPAN=2 align=right height="25">&reg;&trade;
					  
	    <img src="images/c4a.jpg"" alt="" title=""/> 
					  </td>
		            </tr>
		 </table>

		  

</form>


</body>

</html>

		  

</form>


</body>

</html>


</form>


</body>

</html>