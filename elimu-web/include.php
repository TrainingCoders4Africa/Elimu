<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ELIMU</title>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">td img {display: block;}</style>
Fireworks CS3 Dreamweaver CS3 target.  Created Thu Dec 20 13:56:04 GMT+0000 (Maroc) 2012-->
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" /> 
<script src="modernizr.js"></script>
	<!-- Webforms2 -->
	<script src="webforms2/webforms2-p.js"></script>	
	<!-- jQuery  -->
	<script src="js/jquery-1.4.3.min.js"></script>
	<script src="js/jquery-ui-1.8.5.min.js"></script>
	<!-- Feuille de style -->
	<link rel="stylesheet" href="styleFormulaire.css">
		<script src="spinner.js"></script>  
	<script src="html5forms.js"></script>
	<script src="html5forms.fallback.js"></script>	
	 <script type="text/javascript" src="css/conform.js"></script>
  <script type='text/javascript'>
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
<?php
include("fckeditor.php") ;
require_once 'all_function.php';
$requete=("select libelle,logo,slogan from etablissements ");
$resultat=mysql_query($requete);
$ligne=mysql_fetch_array($resultat);
   $b=mysql_fetch_object($resultat);
   $c=$ligne['libelle'];
$a=$ligne['logo'];
$d=$ligne['slogan'];
$aca=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
$sqlstm1="SELECT libelle,date_format(date_debut,'%d/%m/%Y') debut,date_format(date_fin,'%d/%m/%Y') fin FROM semestres WHERE annee ='$aca' and date_debut<='$datejour' and date_fin>='$datejour'";
$req1=mysql_query($sqlstm1);
while($ligne=mysql_fetch_array($req1))
{
	//$code=$ligne['code'];
	$libelle=$ligne['libelle'];
	$debut=$ligne['debut'];
	$fin=$ligne['fin'];
	}
	if(@$libelle<>'' and @$_SESSION["profil"]<>'Administrateur')
	$affi= "Nous Sommes au <B>".@$libelle." </B>  qui s'étale du  ".@$debut." au " .@$fin;
?>
<center>
<body bgcolor="#ffffff" OnLoad="Chargement();">
  <!-- Script DATE  -->
	<script>
	var initDatepicker = function() {  
    $('input[type=date]').each(function() {  
        var $input = $(this);  
        $input.datepicker({  
            minDate: $input.attr('min'),  
            maxDate: $input.attr('max'),  
            dateFormat: 'yy-mm-dd'  
        });  
    });  
};  
  
if(!Modernizr.inputtypes.date){  
    $(document).ready(initDatepicker);  
};  
  </script>
   <!-- Script COLOR  -->
  <script>
  var initColorpicker = function() {  
    $('input[type=color]').each(function() {  
        var $input = $(this);  
        $input.ColorPicker({  
            onSubmit: function(hsb, hex, rgb, el) {  
                $(el).val(hex);  
                $(el).ColorPickerHide();  
            }  
        });  
    });  
};  
  
if(!Modernizr.inputtypes.color){  
    $(document).ready(initColorpicker);  
};  
  </script> 
<!-- Script Slider -->
<script>
var initSlider = function() {  
    $('input[type=range]').each(function() {  
        var $input = $(this);  
        var $slider = $('<div id="' + $input.attr('id') + '" class="' + $input.attr('class') + '"></div>');  
        var step = $input.attr('step');  
  
        $input.after($slider).hide();  
  
        $slider.slider({  
            min: $input.attr('min'),  
            max: $input.attr('max'),  
            step: $input.attr('step'),  
            change: function(e, ui) {  
                $(this).val(ui.value);  
            }  
        });  
    });  
};
</script>
 
<table border="0" cellpadding="0" cellspacing="0" width="1350">
<!-- fwtable fwsrc="maquette4.png" fwpage="page" fwbase="include.jpg" fwstyle="Dreamweaver" fwdocid = "1044080142" fwnested="0" -->
  <tr>
   <td><img src="images/spacer.gif" width="350" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="891" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="109" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr>
   <td colspan="2"  background="images/include_r1_c1.jpg" width="1241" height="108" border="0" id="include_r1_c1" alt="" style="background-repeat:no-repeat" valign='top'/></td>
   <td>
   <?php
                    	if($a <>""){
						 echo" <img src='parametrage/logos/". $a."' width='109' height='108' border='0' title=".'Etablissement'.$c." >";
						 }
						 else{
                    	?>
   
   <img name="include_r1_c3" src="images/include_r1_c3.jpg" width="109" height="108" border="0" id="include_r1_c3" alt="" style="background-repeat:no-repeat" valign='top'  />
    <?php
   }
   ?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="108" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="3" background="images/include_r2_c1.jpg" width="1350" height="42" border="0" id="include_r2_c1" alt="" style="background-repeat:no-repeat" valign='top' align="left"  />
    Bienvenue : <?php echo'<b>'.@$_SESSION["login1"].' Dans l\'espace '.@$_SESSION["profil"].'<b/>'?> - <a href="accueil.php?id=deconx">Sortir</a></br>
	 <marquee><?php echo @$affi;?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="42" border="0" alt="" /></td>
  </tr>
  <tr>
   <td colspan="3" background="images/include_r3_c1.jpg" width="1350" height="42" border="0" id="include_r3_c1" alt=""  valign='top' align="right" />
   <?php echo smenu($bvis,$bajout,$bmod,$bsup,$brech,$bimp,$titreaj,$titrevis,$titremod,$titrerech,$titreimp,$titresup) ;?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="42" border="0" alt="" /></td>
  </tr>
  <tr>
   <td background="images/include_r4_c1.jpg" width="350" height="558" border="0" id="include_r4_c1" alt="" style="background-repeat:no-repeat" valign='top'/>
    <?php
                     if(@$menu<>'')
                       include"menu/".$_SESSION["menu"];
                       ?>
   </td>
   <td colspan="2" background="images/include_r4_c2.jpg" width="1000" height="558" border="0" id="include_r4_c2" alt="" style="background-repeat:no-repeat" valign='top'/>
      <SPAN style="border:solid 1px black; background:lightsteelblue;padding-left:10px; width:99%; display:block;">  
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
                          include @$pageint;
						// echo @$menupage;
						
                         ?>
						     </SPAN>
   
   
   </td>
   <td><img src="images/spacer.gif" width="1" height="558" border="0" alt="" /></td>
  </tr>
</table>
</body>
</center>
</html>
