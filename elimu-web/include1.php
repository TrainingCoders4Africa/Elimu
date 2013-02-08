<?php
//header('Content-Type: text/html; charset=UTF-8');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ELIMU</title>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" /> !-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
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
	if($libelle<>'' and $_SESSION["profil"]<>'Administrateur')
	$affi= "Nous Sommes au <B>".@$libelle." </B>  qui s'étale du  ".$debut." au " .$fin;
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
 
  
<!--The following section is an HTML table which reassembles the sliced image in a browser.-->
<!--Copy the table section including the opening and closing table tags, and paste the data where-->
<!--you want the reassembled image to appear in the destination document. -->
<!--======================== BEGIN COPYING THE HTML HERE ==========================-->
<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="1150" valign=top>
<!-- fwtable fwsrc="maquette4.png" fwpage="page" fwbase="include.jpg" fwstyle="Dreamweaver" fwdocid = "1044080142" fwnested="0" -->
  <tr>
<!-- Shim row, height 1. -->
   <td><img src="images/spacer.gif" width="350" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="694" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="106" height="1" border="0" alt="" /></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
  </tr>

  <tr><!-- row 1 -->
   <td colspan="2" background="images/include_r1_c1.jpg" width="1044" height="141" border="0" id="include_r1_c1" alt="" style="background-repeat:no-repeat" valign='top'/>  
   
   </td>
   <td>
   <?php
                    	if($a <>""){
						 echo" <img src='parametrage/logos/". $a."' width='106' height='141' border='0' title=".'Etablissement'.$c." >";
						 }
						 else{
                    	?>
   <img name="include_r1_c3" src="images/include_r1_c3.jpg" width="106" height="141" border="0" id="include_r1_c3" alt="" / style="background-repeat:no-repeat" valign='top'>
   <?php
   }
   ?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="141" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 2 -->
   <td colspan="3" background="images/include_r2_c1.jpg" width="1150" height="43" border="0" id="include_r2_c1" alt="" style="background-repeat:no-repeat" valign='top' align="left"/>
     Bienvenue : <?php echo'<b>'.@$_SESSION["login1"].' Dans l\'espace '.@$_SESSION["profil"].'<b/>'?> - <a href="accueil.php?id=deconx">Sortir</a></br>
	 <marquee><?phpphp echo @$affi;?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="43" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 3 -->
   <td colspan="3" background="images/include_r3_c1.jpg" width="1150" height="42" border="0" id="include_r3_c1" alt="" style="background-repeat:no-repeat" valign='top'align='right'/>
    <?php echo smenu($p,$bvis,$bajout,$bmod,$bsup,$brech,$bimp) ;?>
   </td>
   <td><img src="images/spacer.gif" width="1" height="42" border="0" alt="" /></td>
  </tr>
  <tr><!-- row 4 -->
   <td background="images/include_r4_c1.jpg" width="350" height="524" border="0" id="include_r4_c1" alt=""  style="background-repeat:no-repeat" valign='top'/>
   <?php
                     if(@$menu<>'')
                       include"menu/".$_SESSION["menu"];
                       ?>
   </td>
   <td colspan="2" background="images/include_r4_c2.jpg" width="800" height="524" border="0" id="include_r4_c2" alt="" style="background-repeat:no-repeat" valign='top' />
      <SPAN style="border:solid 1px black; background:lightsteelblue;padding-left:10px; width:100%; display:block;">  
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
                          include $pageint;
						// echo @$menupage;
						
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
