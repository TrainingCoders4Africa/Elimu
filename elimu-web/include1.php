<?php
include"all_function.php";
//include"parametrage/style.php";
 //include"dao/connection.php";

	$requete=("select libelle,logo,slogan from etablissements ");
$resultat=mysql_query($requete);
$ligne=mysql_fetch_array($resultat);
   $b=mysql_fetch_object($resultat);
   $c=$ligne['libelle'];
$a=$ligne['logo'];
$d=$ligne['slogan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ELIMU</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-18"  />
<meta name="description" content="FW 8 DW 8 XHTML" />
<style type="text/css">td img {display: block;}</style>
<!--Fireworks CS5 Dreamweaver CS5 target.  Created Mon Oct 29 19:06:10 GMT+0000 (Maroc) 2012-->
 <script type="text/javascript" src="css/conform.js"></script>
 <SCRIPT language="javascript">
   function ouvre_popup(page) {
       window.open(page,"LECTEUR","menubar=no, status=no, scrollbars=no, menubar=no, width=800, height=600");
   }
   function ouvre_popupv(page) {
       window.open(page,"LECTEUR","menubar=no, status=no, scrollbars=no, menubar=no, width=400, height=400");
   }
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
var nava = (document.layers);
var dom = (document.getElementById);
var iex = (document.all);
if (nava)
{
  chg = document.chargement
}
else if (dom)
{
  chg = document.getElementById("chargement").style
}
else if (iex)
{
  chg = chargement.style
}
top.moveTo(0,0)
top.resizeTo(window.screen.availWidth,window.screen.availHeight);
largeur = screen.width;
chg.left = Math.round((largeur/2)-200);
chg.visibility = "visible";
function Chargement()
{
  chg.visibility = "hidden";
}
function fullwin(){
window.open("page a afficher","","fullscreen,scrollbars");
window.opener=self;
self.close();
}

</SCRIPT>
<SCRIPT LANGUAGE="javascript">
<!--
//PLF-http://www.jejavascript.net/
var plecran
function pleinecran() {
ie4 = ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4 ))
ns4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 4 ))
if (ie4)
plecran=window.open("pleinecran3.htm", "plecran", "fullscreen=yes");
else
plecran=window.open("pleinecran3.htm", "plecran", "height="+window.screen.availHeight+", width="+(window.screen.availWidth-10)+", top=0, left=0, toolbar=no, status=no, scrollbars=no, location=no, menubar=no, directories=no, resizable=no");
}
//-->
</SCRIPT>
</head>
<body bgcolor="#ffffff" OnLoad="Chargement();">
<!--The following section is an HTML table which reassembles the sliced image in a browser.-->
<!--Copy the table section including the opening and closing table tags, and paste the data where-->
<!--you want the reassembled image to appear in the destination document. -->
<!--======================== BEGIN COPYING THE HTML HERE ==========================-->

<CENTER>

<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="1150">
<!-- fwtable fwsrc="maquette4.png" fwpage="page" fwbase="include.jpg" fwstyle="Dreamweaver" fwdocid = "1044080142" fwnested="0" -->
  <tr>
<!-- Shim row, height 1. -->
   <td><img src="images/spacer.gif" width="229" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="815" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="106" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr><!-- row 1 -->
   <td rowspan="2" colspan="2" background="images/include_r1_c1.jpg" width="1044" height="141" border="0" id="include_r1_c1" alt="" style="background-repeat:no-repeat" /></td>
    <td > 
	   <?php
                    	if($a <>""){
						 echo" <img src='parametrage/logos/". $a."' width='106' height='132' border='0' title=".'Etablissement'.$c." >";
						 }
						 else{
                    	?>
   <img name="include_r1_c3" src="images/include_r1_c3.jpg" width="106" height="132" border="0" id="include_r1_c3" alt="" style="background-repeat:no-repeat" />
   <?php
   }
   ?>
	
</td>
  
   <td><img src="images/spacer.gif" width="1" height="132" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 2 -->
   <td background="images/include_r2_c3.jpg" width="106" height="9" border="0" id="include_r2_c3" alt="" style="background-repeat:no-repeat" /></td>
   <td><img src="images/spacer.gif" width="1" height="9" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 3 -->
   <td colspan="3" background="images/include_r3_c1.jpg" width="1150" height="43" border="0" id="include_r3_c1" alt="" style="background-repeat:no-repeat" />
    Bienvenue : <?php echo'<b>'.@$_SESSION["login1"].' Dans l\'espace '.@$_SESSION["agence"].'<b/>'?> - <a href="accueil.php?id=deconx">D�connexion</a>
  
   </td>
   <td><img src="images/spacer.gif" width="1" height="43" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 4 -->
   <td colspan="3" background="images/include_r4_c1.jpg" width="1150" height="42" border="0" id="include_r4_c1" alt="" style="background-repeat:no-repeat" valign='top' align='right' />
      <?php echo smenu($p,$uno,$dos,$trois,$quatre,$cinq,$six) ;?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="42" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 5 -->
   <td background="images/include_r5_c1.jpg" width="229" height="524" border="0" id="include_r5_c1" alt="" style="background-repeat:no-repeat" valign='top' />
  <?php
                     if(@$menu<>'')
                       include"menu/".$_SESSION["menu"];
                       ?>
   </td>
   <td colspan="2" background="images/include_r5_c2.jpg" width="921" height="524" border="0" id="include_r5_c2" alt="" style="background-repeat:no-repeat" valign='top' />
   <SPAN style="border:solid 1px black; background:lightsteelblue;padding-left:10px; width:95%; display:block;">  
  <?php
 echo '<div align="left" class="good">'.@$titre.'</div>';
                          if(isset($sss)){
                          	 if($sss=="ajout"){

	                             form_insert($table,$titre,$j);
	                             insert_table($table);
                             }
                          	 elseif($sss=="action"){

                             	form_action($table,$titre);

                          	 }

                          }
                          elseif(isset($pageint))
                          include "forms/$pageint";
						// echo $menupage;
						
                         ?>
						     </SPAN>
   </td>
   <td><img src="images/spacer.gif" width="1" height="524" border="0" alt="" /></td>
  </tr>
<!--   This table was automatically created with Adobe Fireworks   -->
<!--   http://www.adobe.com   -->
</table>
<!--========================= STOP COPYING THE HTML HERE =========================-->
</body>
</html>
