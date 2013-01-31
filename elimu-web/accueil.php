<?php session_start();
if(@$_GET["id"]=="deconx"){
session_destroy();
}
include"all_function.php";
 $datejour=date("Y")."-".date("m")."-".date("d");
$mois=date("m");
$annee=date("Y");

 $aca="";
$mois=date("n");
        $annee=date("Y");
		$annee1=date("Y")+1;
		if( $mois>=10){
		 $aca=$annee .'/'. $annee1;
		}
		else{
		 $aca=date("Y")-1 .'/'.$annee;
		}
?>

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
<body background=1ptrans.gif text="#000000" link="#FF0000" vlink="#FF0000"
topmargin="0" leftmargin="0" onLoad="chgFocus()">

<script type="text/javascript" src="css/conform.js"></script>
<table border=0 cellpadding=0 cellspacing=0 width=100% height=100%>
	<tr>
	  <td  valign="center"  align="center">

	    <table border=10 cellpadding=0 cellspacing=0 width=615 height="292" >
                   <tr>


	  		              <td  class="titr"width=615 height="292" align=center style="padding-top:30px;padding-left:100px;padding-right:100px;">
<?php
    if(@$_GET["idr"]=="fff"){
	     echo '<div align="left" class=error>Login ou Mot de Passe Incorrect(s)</div>';
	     }
?>
			<form name='frm' action='verifuser.php?ide=sss&' onsubmit='return (conform(this));'   method='POST'>
			
  	<legend class="kc">Connexion - Administration</legend>
	
	<table border=0 cellpadding=0 cellspacing=10 align="left" >
  <tr><td><b>Login * </b></td><td> <input class='kc1' id='Login' type=text name=Login1 size='20'required placeholder="Donner le Login"/></td></tr>
  <tr><td><b>Mot de Passe *</b></td><td> <input class='kc1' id='Mot de Passe' type='password' name=Mot_de_Passe7 size='20' required placeholder="Donner le mot de passe" /></td></tr>
	<tr><td><b>Profil *</b></td><td><select class=kc1  id="Statut" type="text" name="Statut5" size="1" required  placeholder="Choisir votre profile"  />
   <option value=>Choisir votre profile</option>
	                     <option value='Administrateur' >Administrateur</option>
						 
						  <?php
  $sqlstm1="select distinct profile5 from user where cdeetud in (select distinct matricule from personnels where enable8='1') ORDER BY profile5 asc";
  $req1=mysql_query($sqlstm1);

  while($ligne=mysql_fetch_array($req1))
  {
  $slib=$ligne['profile5'];

  ?>

	                     <option  value="<?php echo $slib;?>" ><?php echo $slib;?>
  <?php
}
?>
 </option>
	                     </select></td></tr>
						 <tr><TD>&nbsp;</td></tr>
						<tr align="center"><td><input class=kc1 type="submit" value="Connexion" />&nbsp;&nbsp;<input class=kc1 type="reset" value="Annuler" /></td></tr>

  </form>
			 
	  </td>
	</tr>
 </table>
