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
   $titre="ELIMU >> Paramétrage Partie II";
	$requete=("select logo from etablissements ");
$resultat=mysql_query($requete);
 $ligne=mysql_fetch_array($resultat);
$a=$ligne['logo'];
$d=date("Y")-1;

?>
<body>   <form name="form" action="recupdesign.php" method="POST" enctype="multipart/form-data" onsubmit='return (conform(this));'>
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
					  <td> <img <?php echo" <img src='logos/". $a."' align='right'  height='100%' width='30%' >";?>
					  </td>
					  <?php
					}
					
					?>
		            </tr>

         </table>
         <table border=0 cellpadding=0 cellspacing=0 width=100%  height="30">
		            <tr class="legend">
		              <td align="right" height="30"  ><b> <?php echo $titre;?></b></td>
		            </tr>

		 </table>
		 <table border=0 cellpadding=0 cellspacing=0 width=100%  height="90">
		      
 <tr>

<td><b>	 CYCLES SCOLAIRES </b></td></tr><TR><TD class=petit>&nbsp;</TD></TR>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
<INPUT type="checkbox" name="choix[]" value="PRESCOLAIRE" checked >CYCLE PRESCOLAIRE
</b></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>Eléve agé de 2 ans à 5, 6 ans</TD>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
<INPUT type="checkbox" name="choix[]" value="ELEMENTAIRE"  > CYCLE ELEMENTAIRE</b></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>Eléve agé de 6,7 ans à 12, 14 ans</TD>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
</tr>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
<INPUT type="checkbox" name="choix[]" value="MOYEN"  > CYCLE MOYEN</b></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>Eléve ayant obtenu le Certificat de Fin d'Etude Elémentaire</TD>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
</tr>
<tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
<INPUT type="checkbox" name="choix[]" value="SECONDAIRE"  > CYCLE SECONDAIRE</b></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>Eléve ayant le BFEM</TD>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
<INPUT type="checkbox" name="choix[]" value="PROFESSIONNEL"  > CYCLE PROFESSIONNEL</b></td>
<TD ROWSPAN=1  ALIGN=LEFT NOWRAP>Eléve ayant le Bac ou le niveau du Bac</TD>
</tr><tr><td ROWSPAN=1  ALIGN=LEFT NOWRAP><b>
</tr>

</td></tr>
		 </table>
		              
					   <table border=0 cellpadding=0 cellspacing=0 width=100% height=100>
					   <tr>      <td>&nbsp;</td><td align=right>
					  <br><a href="config.php"><img src="img/prec.jpg" alt="" border="0"></a>
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