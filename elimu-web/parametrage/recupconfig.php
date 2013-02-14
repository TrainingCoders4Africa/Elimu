<?php
include"../dao/connection.php";
include"../dao/select.php";
//base("gescosen");
function copilogo(){
if(@$_FILES["logo"]['name']!="")
{
copy($_FILES['logo']['tmp_name'],"logos/".$_FILES['logo']['name']);
}
}
if (isset($_POST["libelle"])) {
   $libelle=str_replace("'","\'",$_POST["libelle"]);
    $ia=str_replace("'","\'",$_POST["ia"]);
     $iden=str_replace("'","\'",$_POST["iden"]);
   
  $slogan= str_replace("'","\'",$_POST["slogan"]);
   $ouverture=$_POST["ouverture"];
   $adresse=str_replace("'","\'",$_POST["adresse"]);
   $tel=$_POST["tel"];
   $bp=$_POST["bp"];
    $site=$_POST["site"];
	 $fax=$_POST["fax"];
   $email=$_POST["email"];
     $status=$_POST["status"];
   	$datejour=date("Y")."-".date("m")."-".date("d");
 if($_FILES['logo']['name']<>""){
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
		$photo=$_FILES['logo']['name'];
$extension_upload = strtolower(  substr(  strrchr($photo, '.')  ,1)  );
//if ( in_array($extension_upload,$extensions_valides) ){
     //echo "Extension correcte";
      $tab=explode(".",$photo);
      $nb=0;
      for($i=0;$i<strlen($photo);$i++){
		  	if(isset($tab[$i])){
		        $nb+=1;
		  	}

	   }
	$stock=getcwd();
	$dir=$stock."/logos/";
	$mynb=$nb-1;
	$logo = "logo".".".$tab[$mynb] ;
	$chemin  =$logo;
	if(file_exists($dir.$logo)){
		 unlink($dir.$logo);
		}
	
 	move_uploaded_file($_FILES['logo']['tmp_name'], $dir.$_FILES['logo']['name']);
 	rename($dir.$photo,$dir.$logo);
	}
	elseif(isset($_POST["chemin"]))
	{
	$chemin=$_POST["chemin"];
	}
	else
	$chemin="";
	 $req_vide="truncate table etablissements";
   $exe_req_vide =mysql_query($req_vide) or die(mysql_error());
   
 $req_insert="insert into etablissements values('$ia','$iden','$libelle','$chemin',upper('$slogan'),'$ouverture','$adresse','$tel','$bp','$site','$fax','$email','$status','$datejour')";
   $exe_req_insert=mysql_query($req_insert) or die(mysql_error());
  // header("Location:design.php");
   echo'<SCRIPT LANGUAGE="JavaScript">
location.href="design.php"
</SCRIPT>';
}
else {
   //header("Location:config.php");
   echo'<SCRIPT LANGUAGE="JavaScript">
location.href="config.php"
</SCRIPT>';
}
?>

