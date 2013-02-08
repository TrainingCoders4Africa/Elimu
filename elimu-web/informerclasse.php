<?php
include("fckeditor.php") ;
include 'all_function.php';
if(isset($_POST['OUTIL_ID']) and isset($_POST['MAT']))
{
$matricule=securite_bdd($_POST['MAT']);
$outil =securite_bdd($_POST['OUTIL_ID']);
//$annee=annee_academique();
if($outil<>""){
if($outil=='MAIL'){

if ($sock = @fsockopen('www.google.fr', 80, $num, $error, 5)) {

echo' <table >
    <tr><td><B>Object</B> : <input type="text" name="objet" size="45" maxlength="100"  required/></td></tr>
	<tr><td width="100%"><B>Message </B>: ';
				$sBasePath = $_SERVER['PHP_SELF'] ;
				$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

				$oFCKeditor = new FCKeditor('FCKeditor1') ;
				$oFCKeditor->BasePath	= $sBasePath ;
				//$oFCKeditor->Value		= 'This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.' ;
				$oFCKeditor->Create() ;
				
	echo'
	<TR><TD class=petit>&nbsp;</TD></TR>
	<TR>
<TD ><B>&nbsp;'.utf8_encode("Piéce").' </B><INPUT TYPE="file" name="fichier"></TD></TR>
<TR><TD class=petit>&nbsp;</TD></TR>
<tr><td></td><td></td></tr>
        </table>';echo'
<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>';

		
		}
		else{
echo 'Pas de connexion donc impossible d\'envoyer Des Emails';		
		}
}
elseif($outil=='SMS'){
echo' <table>
    <tr><td><B>Message </B>: </td><td><textarea id="textar" name="message" cols="50" rows="10"  required></textarea></td></tr>
	<TR><TD class=petit>&nbsp;</TD></TR>
        </table>';
		echo'
<TR><TD><BUTTON TITLE="Confirmer "name="enregistrer" TYPE="submit" id="flashit"><b>Informer</b></BUTTON>&nbsp;<BUTTON TITLE="Annuler " TYPE="reset"><b>&nbsp;Annuler&nbsp;</b></BUTTON></TD></TR>';

}
}	
}
?>