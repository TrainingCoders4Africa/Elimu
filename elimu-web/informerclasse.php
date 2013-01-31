<script type="text/javascript">
//trouvé sur: www.portugal-tchat.com//
var ns6=document.getElementById&&!document.all

function restrictinput(maxlength,e,placeholder){
if (window.event&&event.srcElement.value.length>=maxlength)
return false
else if (e.target&&e.target==eval(placeholder)&&e.target.value.length>=maxlength){
var pressedkey=/[a-zA-Z0-9\.\,\/]/ 
if (pressedkey.test(String.fromCharCode(e.which)))
e.stopPropagation()
}
}

function countlimit(maxlength,e,placeholder){
var theform=eval(placeholder)
var lengthleft=maxlength-theform.value.length
var placeholderobj=document.all? document.all[placeholder] : document.getElementById(placeholder)
if (window.event||e.target&&e.target==eval(placeholder)){
if (lengthleft<0)
theform.value=theform.value.substring(0,maxlength)
placeholderobj.innerHTML=lengthleft
}
}
//trouvé sur: www.portugal-tchat.com//

function displaylimit(thename, theid, thelimit){
var theform=theid!=""? document.getElementById(theid) : thename
var limit_text='<b><span id="'+theform.toString()+'">'+thelimit+'</span></b> characteres Maximum.'
if (document.all||ns6)
document.write(limit_text)
if (document.all){
eval(theform).onkeypress=function(){ return restrictinput(thelimit,event,theform)}
eval(theform).onkeyup=function(){ countlimit(thelimit,event,theform)}
}
else if (ns6){
document.body.addEventListener('keypress', function(event) { restrictinput(thelimit,event,theform) }, true); 
document.body.addEventListener('keyup', function(event) { countlimit(thelimit,event,theform) }, true); 
}
}

</script>
<?php
include 'all_function.php';
if(isset($_POST['OUTIL_ID']) and isset($_POST['MAT']))
{
$matricule=securite_bdd($_POST['MAT']);
$outil =securite_bdd($_POST['OUTIL_ID']);
//$annee=annee_academique();
if($outil<>""){
if($outil=='MAIL'){
echo' <table>
    <tr><td><B>Object</B> : </td><td><input type="text" name="objet" size="45" maxlength="100"  required/></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
    <tr><td><B>Message </B>: </td><td><textarea id="textar" name="message" cols="50" rows="10" required ></textarea></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
	<TR>
<TD ><B>&nbsp;'.utf8_encode("Piéce").' </B></TD><TD><INPUT TYPE="file" name="fichier"></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
        </table>';
}
elseif($outil=='SMS'){
echo' <table>
    <tr><td><B>Message </B>: </td><td><textarea id="textar" name="message" cols="50" rows="10"  required></textarea></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
        </table>';
}
echo'
<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>';
}	
}
?>