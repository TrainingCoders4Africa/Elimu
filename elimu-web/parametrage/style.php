<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
body {
		top.moveTo(30,0);
        margin-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;

}
-->
</style>
<script language="javascript">
      function confirme(identifiant,page)
      {
        var confirmation = confirm( "Voulez vous vraiment Modifier cet enregistrement ?" ) ;
	if( confirmation )
	{
	  document.location.href = page+".php?idm="+identifiant;
	}
      }
    </script>
<script language="javascript">top.resizeTo(window.screen.availWidth,
      window.screen.availHeight);</script>
<script language="javascript">
      function confirme1(identifiant,page)
      {
        var confirmation = confirm( "Voulez vous vraiment supprimer cet enregistrement ?" ) ;
	if( confirmation )
	{
	  document.location.href = page+".php?ids="+identifiant;
	}
      }
    </script>
    <script type="text/javascript" src="../css/conform.js"></script>
 <STYLE>

  .input_text_rech
{
	background-color: red;
	padding: 0px 0px 0px 0px;
	margin:0px;
	border-top: 0px solid #d700a6;
	border-left: px solid #d700a6;
	border-right: px solid #d700a6;
	border-bottom: px solid #d700a6;
	font-size: 13px;
	font-family: Century Gothic,Verdana,Arial,Helvetica,sans-serif;
	font-weight: normal;
	color: red;
}
input{
	font-family:Century Gothic;font-size:13;color:black;border-style:solid;padding:0px;border-color:black; border-width: 1px;
}

select{
	font-family:Century Gothic;font-size:13;color:black;border-style: solid;padding:0px;border-color:black; border-width:1px;
}
legend{
	font-family:courier;font-size:15;color:#FF6600;font-weight: 700;padding:0px;border-color:black;
}
.white{font-family:Century Gothic;font-size:13;color:white;}
.bt{font-family:Century Gothic;font-size:13;font-weight: 700;color:black;}
.format{font-family:Century Gothic;font-size:11;font-weight: 700;color:green;}
.titr{font-family:Century Gothic;font-size:16;font-weight: 700;background-color:#CADBE6;}
.titr1{font-family:Courier;font-size:18;font-weight: 700;color:white;background-color:#CADBE6;}
.error  {font-family:Century Gothic;font-size:13;color:red;}
.good  {font-family:Century Gothic;font-size:16;font-weight: 700;color:#940000}
.tit{font-family:Century Gothic;font-size:16;font-weight: 700; color:#940000;}
td{font-family:Century Gothic;font-weight: 500;font-size:14;color:black;}
.myc{font-family:Century Gothic;font-size:13;color:#b0d0FF;}
th{font-family:Century Gothic;font-size:13;color:black;}
p.kc{font-family:Century Gothic;font-size:13;color:black; background-color:#CADBE6;}
.kk{font-family:Century Gothic;font-size:15;color:red;}
.kc1{font-family:Arial;font-size:15;color:black;}
.kc2{font-family:Century Gothic;font-size:11;color:black;}
.sl { font-family: Century Gothic ; font-weight: 700; font-size:16; color:#FF7900;text-decoration: none ; text-valign=top }
td.pwh {font-family:Century Gothic;font-size:13;color:white;}
<--!th{font-family:Century Gothic;font-size:13;color:black;}  -->
.text  {font-family:Century Gothic;font-size:13;color:black;}
.top   {font-family:Century Gothic;font-size:15;color:#F7235A;font-weight: 700;padding-left:5px;padding-right:5px;}
A   {font-family:Century Gothic;font-size:13;color:back;text-decoration: none;}
A.bg   {font-family:Century Gothic;font-size:13;color:back;text-decoration: none; background-color:#FFFFCC; ;height:20px;padding-left:5px;padding-right:5px;border-style: solid; border-width: 1px;border-color:black;}
.imp   {font-family:Century Gothic;font-size:13;color:back;text-decoration: none; background-color:#00FF00; ;height:20px;padding-left:5px;padding-right:5px;border-style: solid; border-width: 1px;border-color:black;}
.imp1   {font-family:Century Gothic;font-size:10;color:red;text-decoration: none; background-color:#00FF00; ;height:20px;padding-left:5px;padding-right:5px;border-style: solid; border-width: 1px;border-color:red;}
A.bot {font-family:Century Gothic;font-size:12;color:white;}
A:hover {color:RED;}
td.kb { font-family: Century Gothic ; font-weight: 700; font-size:16; color:#940000;text-decoration: none ; text-valign=top }
.kb1 { font-family: Century Gothic ; font-weight: 700; font-size:16; color:#940000;text-decoration: none ; text-valign=top }
div.titre{ font-family: Century Gothic ; font-weight: 700; font-size:12; color:#940000;text-decoration: none ; text-valign=top }
I.titre { font-family: Century Gothic ; font-weight: 700; font-size:19; color:#940000;text-decoration: none ; text-valign=top }
I.error { font-family: Century Gothic ;  font-size:10; color:red;text-decoration: none ; text-valign=top }
P { color: black; padding-left:10px;padding-top:10px;}

body {
scrollbar-face-color: black;
scrollbar-arrow-color: #FF9928;
scrollbar-track-color: white;
scrollbar-3dlight-color: black;
scrollbar-darkshadow-color: white;
scrollbar-shadow-colore : green;
scrollbar-highlight-colore: red;
}
body {
scrollbar-base-color: read;
}

</STYLE>
<script        type="text/javascript"
src="conform.js"></script>
 <script type="text/javascript"><!----------------
//~~~~~~~~~~~~~~~~~~~~~~~~~~ #        #                             #
function SUC(champ) //~~ initialisation ~~ Saisir Uniquement des Chiffres
//~~~~~~~~~~~~~~~~~~~~~~~~~~ #        #                             #
{
 this.champ=champ;
 var Lui=this;
 var ie = false; /*@cc_on ie = true; @*/
 if ( ie ) {
     this.champ.onkeypress = Lui.IE;
    }
 else  {
     this.champ.onkeyup = function(e)
      {
       Lui.FF(this, e);
      }
    }
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
SUC.prototype.IE=function() //~~ pour Internet Explorer ~~
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
{
 if ( event.keyCode<0x30 || event.keyCode>0x39 )
 {
  event.returnValue= false;
   alert("Ce champ ne prend que des chiffres");
 }
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
SUC.prototype.FF=function(zone,evt) //~~ pour FireFox ~~
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
{
 if ( evt.which<0x30 || evt.which>0x39 )
 {
  zone.value=zone.value.replace(/[^0-9]/g,"");
  alert("Ce champ ne prend que des chiffres");
 }
}
// ---------------->
function annule(){

    var ddd=document.form_newsl.nom.value;
    if(ddd=="Entrez votre nom") {
      ddd="";
      }
      else if (ddd==""){
      //document.form_newsl.mailnewsl.value="Entrez votre courriel";
      }
    }
 function annule1(){

    var ddd=document.form_newsl.mailnewsl.value;
    if(ddd=="Entrez votre courriel") {
       ddd="";
      }
      else if (ddd==""){
      //document.form_newsl.mailnewsl.value="Entrez votre courriel";
      }
    }
</script>

</head>
<?php
function verifemail($courriel){
//$regex = #^[a-z0-9-+_](\.?[a-z0-9-+_])*@[a-z0-9-+_](\.?[a-z0-9-+_])*\.[a-z]{2,4}$#i

$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caract�res autoris�s avant l'arobase
$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caract�res autoris�s apr�s l'arobase (nom de domaine)
$regex = '/^' . $atom . '+' .   // Une ou plusieurs fois les caract�res autoris�s avant l'arobase
'(\.' . $atom . '+)*' .         // Suivis par z�ro point ou plus
                                // s�par�s par des caract�res autoris�s avant l'arobase
 '@' .                           // Suivis d'un arobase
 '(' . $domain . '{1,63}\.)+' .  // Suivis par 1 � 63 caract�res autoris�s pour le nom de domaine
                              // s�par�s par des points
$domain . '{2,63}$/i';

            if (preg_match($regex,$courriel)) {
               // echo "L'adresse $courriel est valide";
                return 1;
                }
             else {
               // echo "L'adresse $courriel n'est pas valide";
                return 0;
            }
}

?>
<center>