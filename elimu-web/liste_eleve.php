<?php require("all_function.php");
$classe=$_GET['classe'];
$annee=$_GET['annee'];//journée fin

?>
<STYLE>
body
{
    color: #5773AD;
    font-family: Helvetica, Trebuchet MS, Arial;
    font-size: 10pt
}
th
{
    color: #000000;
    font-family: Helvetica, Trebuchet MS, Arial;
    font-size: 12pt
}
td
{
    color: #000000;
    font-family: Helvetica, Trebuchet MS, Arial;
    font-size: 12pt
}
td.petit
{
    color: #FF0000;
    font-family: Helvetica, Trebuchet MS, Arial;
    font-size: 1pt
}
BUTTON {color:white; background-color:#0000A0; font-size: 11pt}
H2.rouge {font-family:Brush; color:white; background-color:#0000A0; font-size: 16pt}
</STYLE>
<FONT COLOR="#000000" FACE="Verdana,Arial" SIZE=1>
<H4 class="rouge" ALIGN="center">Liste Alphabétique des éléves de la classe de <b> <?phpecho $classe;?></b></font></H4>
<table border="1" cellspacing="0" bordercolor="#AEBFE2" cellpadding="2" width=100 ALIGN=CENTER>
<TR>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Prénom&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Nom&nbsp;</B></FONT></TH>
<TH align=center ROWSPAN=1 NOWRAP><FONT COLOR="#5773AD"><B>&nbsp;Date et Lieu de Naissance&nbsp;</B></FONT></TH>
</TR>
<?php
$selection =  findByNValue("eleves","matricule in(select eleve from inscription where classe='".htmlentities($classe)."' and annee='$annee')");
              		while($ligne = mysql_fetch_row($selection))
{
$matricule=$ligne[0];
						$prenom=$ligne[1];
						$nom=$ligne[2];
						$date_nais=$ligne[4];
						$lieu=$ligne[5];
						$tuteur=$ligne[6];
						$email_t=$ligne[7];
						$tel_t=$ligne[8];
						$tel_e=$ligne[9];
						$adresse=$ligne[11];
?>


<TR>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP>&nbsp;<?phpecho $prenom;?>&nbsp;</A></TD>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP>&nbsp;<?phpecho $nom;?>&nbsp;</TD>
<TD ALIGN=MIDDLE ROWSPAN=1 NOWRAP>&nbsp;<?phpecho $date_nais.' à '.$lieu;?>&nbsp;</TD>
</TR>


<?php

}
?>
</table>
<input type="button" class="ecran" OnClick="javascript:window.print()" value="Imprimer">