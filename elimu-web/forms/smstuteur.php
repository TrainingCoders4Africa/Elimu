<?php
$matricule=$_SESSION['matricule'];
$classe=securite_bdd($_GET['classe']);
$eleve=securite_bdd($_GET['eleve']);
$tel=securite_bdd($_GET['tel']);
$annee=annee_academique();
$datejour=date("Y")."-".date("m")."-".date("d");
?>
<script language="javascript" type="text/javascript">
function calculeLongueur(){
   var iLongueur, iLongueurRestante;
   iLongueur = document.getElementById('monchamp').value.length;
   if (iLongueur>160) {
      document.getElementById('monchamp').value = document.getElementById('monchamp').value.substring(0,160);
      iLongueurRestante = 0;
   }
   else {
      iLongueurRestante = 160 - iLongueur;
   }
   if (iLongueurRestante <= 1)
      document.getElementById('indic').innerHTML = iLongueurRestante + "&nbsp;caract&egrave;re&nbsp;disponible";
   else
      document.getElementById('indic').innerHTML = iLongueurRestante + "&nbsp;caract&egrave;res&nbsp;disponibles";
}
</script>

<form name="inscription_form" action="<?php echo lien();?>" method="post"  enctype="multipart/form-data" >
<input name="action" value="submit" type="hidden">
<div class="formbox">
<table border="0" cellpadding="3" cellspacing="0" width="100%" >
		<tbody><tr>
   <td ALIGN=center ROWSPAN=1 NOWRAP id="indic">160 caractères disponibles</td></tr>
   <tr><TD ALIGN=LEFT ROWSPAN=1 NOWRAP><b>Message :</b><input onblur="calculeLongueur();" size=100 onfocus="calculeLongueur();" 
   onkeydown="calculeLongueur();" onkeyup="calculeLongueur();" name="monchamp" id="monchamp" value="" autofocus required />
   </td></tr>
</form>
  </tbody>

<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>
<tr><TD class=petit>&nbsp;<input type=hidden name="classe" value="<?php echo $classe;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="tel" value="<?php echo $tel;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="annee" value="<?php echo $annee;?>"></TD></tr>
<tr><TD class=petit>&nbsp;<input type=hidden name="eleve" value="<?php echo $eleve;?>"></TD></tr>
</table>
<?php
if (isset($_POST["enregistrer"]) and isset($_POST["eleve"]) ) {

$CONFIG_KANNEL_HOST="localhost";
$CONFIG_KANNEL_PORT="8011";
$in_phoneNumber =addslashes($_POST['tel']);
$in_msg =addslashes($_POST['monchamp']);	
function sendSmsMessage($in_phoneNumber, $in_msg)
 {
   $url = '/send/sms/'.urlencode(utf8_encode($in_phoneNumber)).'/'.urlencode(utf8_encode($in_msg));
   $results = file('http://localhost:8011'.$url);
 }
 sendSmsMessage($in_phoneNumber, $in_msg);
//echo  'message:<br>'.urlencode(utf8_encode($in_msg).'<br> Envoyé à : '.urlencode(utf8_encode($in_phoneNumber));

}
?>