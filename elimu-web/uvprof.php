<head>
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
include 'all_function.php';
if(isset($_POST['CLASSE_ID']) and isset($_POST['MAT']))
{
$matricule=securite_bdd($_POST['MAT']);
$discipline =securite_bdd($_POST['CLASSE_ID']);
$annee=annee_academique();
if($discipline<>""){
$reqsd=findByNValue("sous_matiere","discipline='$discipline'");
$nbsd=mysql_num_rows($reqsd);
if($nbsd <>0)	{
echo'<tr><TD ALIGN=LEFT>
 <B>&nbsp;A Composer*</B><select name="sousmat" id="sousmat" >';    
								while($ligne2d=mysql_fetch_row($reqsd)){
				   $slib2d=$ligne2d['1'];
$cl=$ligne2d['0'];
						   
                            echo"<option value='".$cl[0]."'>".$slib2d."</option>";
    			}
				}
				
ECHO'</SELECT >

</td><td> <input name=nbsd type=hidden value="'.$nbsd.'"></td></tr>
<TR><TD class=petit>&nbsp;</TD></TR>';
$selection =findByNValuelib('enseigner','classe',"personnel='$matricule' and discipline='$discipline' and annee='$annee'");

echo'<tr><TD ALIGN=LEFT ROWSPAN=1 NOWRAP>
 <B>&nbsp;Classes *</B><select name="classe" id="classe"  required >
<OPTION value=""></OPTION>';    
								 while($ro=mysql_fetch_row($selection)){
				    $t_classe = findByValue('classes','idclasse',$ro[0]);
						$champs_classe = mysql_fetch_row($t_classe);
						$l_classe=$champs_classe[3];
						   
                            echo"<option value='".$ro[0]."'>".$l_classe."</option>";
    			}
				
ECHO'</SELECT ></td><TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>Date Pr&eacute;vue:</B></td>
<td><input type="date" name="date_p" size="10" MAXLENGTH="20" id="date_p" required>//('. date("Y-m-d").')</td>';

echo'<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;D&eacute;but </B><SELECT NAME="debut" id="debut" required>
 <OPTION value=""></OPTION>
<OPTION value="08:00" >8H00</OPTION>
<OPTION value="08:30">8H30</OPTION>
<OPTION value="09:00" >9H00</OPTION>
<OPTION value="9:30">9H30</OPTION>
<OPTION value="10:00" >10H00</OPTION>
<OPTION value="10:30">10H30</OPTION>
<OPTION value="11:00" >11H00</OPTION>
<OPTION value="11:30">11H30</OPTION>
<OPTION value="12:00" >12H00</OPTION>
<OPTION value="12:30">12H30</OPTION>
<OPTION value="13:00" >13H00</OPTION>
<OPTION value="13:30">13H30</OPTION>
<OPTION value="14:00" >14H00</OPTION>
<OPTION value="14:30">14H30</OPTION>
<OPTION value="15:00" >15H00</OPTION>
<OPTION value="15:30">15H30</OPTION>
<OPTION value="16:00" >16H00</OPTION>
<OPTION value="16:30">16H30</OPTION>
<OPTION value="17:00" >17H00</OPTION>
</SELECT ></TD>';
echo'<TD ALIGN=LEFT ROWSPAN=1 NOWRAP><B>&nbsp;Dur&eacute;e </FONT></B><SELECT NAME="duree" id="duree"  required onchange="go1()" >
<OPTION  value=""></OPTION>
<OPTION value="01:00" >1H00</OPTION>
<OPTION value="02:00" >2H00</OPTION>
<OPTION value="03:00" >3H00</OPTION>
<OPTION value="04:00" >4H00</OPTION>
</OPTION></SELECT></td>
</tr>';
}
}
?>