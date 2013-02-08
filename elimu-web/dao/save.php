<?php

function save_dossier(){

		//echo "<br>bienvenu pour ajouter un dossier <br>";

	if(isset($_POST["valider"])){
	$idDos = "1";
	//$idPro = $idpro;
	$courrie = addslashes($_POST['courrie']);
	$expediteur = addslashes($_POST['Expéditeur']);
	$emetteur = addslashes($_POST['Emetteur']);
	$objet = addslashes($_POST['objet']);
	$dateenr= addslashes($_POST['dateenr']);
	$typecourrier = addslashes($_POST['typecourrier']);
	$classeur = ($_POST['classeur']);
	$gestcourrier = addslashes($_POST['gestcourrier']);
	$datelimite = addslashes($_POST['datelimite']);
	$datetraitement = addslashes($_POST['datetraitement']);

    $exereq=mysql_query("select * from dossier where courrie='".$courrie."' AND expediteur='".$expediteur."'AND emetteur='".$emetteur."'AND date_enregistrement2='".$dateenr."'
    AND Objet1='".$objet."'AND type_courrier5='".$typecourrier."' AND idCl='".$classeur."'
    					AND idGest='".$gestcourrier."'AND date_limite='".$datelimite."'AND date_traitement2='".$datetraitement."' ");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO dossier VALUES ('', '$courrie', '$expediteur', '$emetteur','$objet', '$dateenr', '$typecourrier', '$classeur', '$gestcourrier',
 	'$datelimite','$datetraitement')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die(mysql_error());
    $i = mysql_insert_id();
			if($query_ajout){
			echo  $id = mysql_insert_id();
 	        mkdir("documents/".$id, 0700);
 	           if ((@$_FILES['fichier']['name']<>"")) {
			 	$stock=getcwd();
			    echo $dir="documents/".$id."/";
			    $paths=pathinfo($_FILES["fichier"]['name']);
			    $ext=$paths["extension"];
			    $tab=explode(".$ext",$_FILES["fichier"]['name']);

			    $nomfichconca=$id.".$ext";

			   // echo "nom complet du fichier : ".$_FILES["fichier"]['name']."<br> extension : ".$ext."<br> nom sans extension :".$tab[0];
			    if (is_uploaded_file($_FILES["fichier"]["tmp_name"])) {
				move_uploaded_file($_FILES["fichier"]['tmp_name'], $dir.$_FILES["fichier"]['name']);

				rename($dir.$_FILES['fichier']['name'],$dir.$nomfichconca);
			    }
			    else{
			     echo"<BR>le fichier n'a pas été déplacé ".$_FILES["fichier"]['error'];
			    }
			   }
			echo "<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
    return $i;
    }
    else{    	echo "<div align=center class=imp>Ce dossier existe déja</div>";    }

    }



}


//ajout user


function save_user(){

	//echo "<br>bienvenu pour ajouter un utilisateur <br>";

	if(isset($_POST["Nom"])){
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	$login = addslashes($_POST['Login']);
	$password = addslashes($_POST['password']);
	$dpt = addslashes($_POST['departemenat']);
	$fonction = addslashes($_POST['fonction']);
    $exereq=mysql_query("select * from user where nom= '$nom' AND prenom='$prenom' AND fonction='$fonction'");
     if(mysql_num_rows($exereq)==0){
 	//$sql_ajout="INSERT INTO user VALUES ('', '$nom', '$prenom','$fonction', '$login', '$password', '$privilege')";
 	$sql_ajout="INSERT INTO user VALUES ('', '$nom', '$prenom','$fonction')";


   // echo "<br> requete : ".$sql_ajout;

   $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo  $i = mysql_insert_id();
 	        mkdir("docuser/".$i, 0700);
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}  /* */

      }
     else{
    	echo "<br>Ce Gestionnaire existe déja";
     }
    }


}


//ajout classeur


function save_classeur(){

	//	echo "<br>bienvenu pour ajouter un classeur <br>";

	if(isset($_POST["Nom"])){
	$idEt = addslashes($_POST['Etagiaire']);
	$nom = addslashes($_POST['Nom']);
	$nbreDossier = addslashes($_POST['nbre_dos']);
	$specification = addslashes($_POST['Specification']);
    $exereq=mysql_query("select * from classeur where idEt='$idEt' AND nom='$nom'  AND specification='$specification' ");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO classeur VALUES ('', '$idEt', '$nom', '$nbreDossier', '$specification')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
     }

    else{
    	echo "<br>Ce classeur existe déja";
    }
    }
}


//ajout etagiaire


function save_etagiare(){
	//	echo "<br>bienvenu pour ajouter un etagiaire <br>";

	if(isset($_POST["Nom"])){
	$idRa = addslashes($_POST['Rayon']);
	$nom = addslashes($_POST['Nom']);
	$nbreClasseur = addslashes($_POST['nbre_cla']);
	$specification = addslashes($_POST['Specification']);
    $exereq=mysql_query("select * from etagiare where  idRa='idRa' and nom='$nom' and specification ='$specification'") or die(mysql_error());
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO etagiare VALUES ('', '$idRa', '$nom', '$nbreClasseur', '$specification')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
    }
    else{
    	echo "<br>Cet étagère  existe déja";
    }
    }


}


//ajout rayon


function save_rayon(){

	//	echo "<br>bienvenu pour ajouter un rayon <br>";

	if(isset($_POST["libelle"])){
	//$idEt = "diop";
	$nom = addslashes($_POST['libelle']);
    $exereq=mysql_query("select * from series where libelle1='$nom'");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO series VALUES ('', '$nom')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
    }

    else{
    	echo "<br>La série ".$nom." existe déja";
    }
    }

}

//ajout nature


function save_nature(){
	//	echo "<br>bienvenue pour ajouter une nature <br>";

	if(isset($_POST["Libelle"])){
	//$nom = "mbene";
	$libelle = addslashes($_POST['Libelle']);
	$specification = addslashes($_POST['Specification']);
    $exereq=mysql_query("select * from nature where libelle='".$libelle."'") or die(mysql_error());
	    if(mysql_num_rows($exereq)==0){
	 	$sql_ajout="INSERT INTO nature VALUES ('', '$libelle', '$specification')";

	   // echo "<br> requete : ".$sql_ajout;

	    $query_ajout=mysql_query($sql_ajout) or die($erreur);
				if($query_ajout){
				echo"<div align=center class=imp>enregistrement valide!</div>";
				}
				else
				{
					echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

	     		}
	    }

	    else{
	    	echo "<br>Cette nature existe déja";
	    }

    }

}

//ajout gestionnaire


function save_gestionnaire(){

		//echo "<br>bienvenu pour ajouter un gestionnaire <br>";

	if(isset($_POST["Login"])){
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	$login = addslashes($_POST['Login']);
	$password = addslashes($_POST['password']);
	$service = addslashes($_POST['departement']);
	$poste = addslashes($_POST['Poste']);
	//$privilege = addslashes($_POST['Libelle']);
    $exereq=mysql_query("select * from gestionnaire where nom ='".$nom."' and prenom='".$prenom."' and Login1='".$login."'
    and  Mot_de_Passe7='".$password."' and departement5 ='".$service."' and poste='".$poste."'") or die(mysql_error());
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO gestionnaire VALUES ('', '$nom', '$prenom', '$login', '$password', '$service', '$poste')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement réussi</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
    }
    else{
    	echo "<br>Ce gestionnaire existe déja";
    }
    }

}


//ajout proprietaire


function save_proprietaire(){
		//echo "<br>bienvenu pour ajouter un proprietaire <br>";

	if(isset($_POST["valider"])){
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	$societe = addslashes($_POST['Societe']);
	$statut = addslashes($_POST['Statut']);
    $exereq=mysql_query("select * from proprietaire where nom='$nom' and prenom='$prenom' and societe='$societe' and statut='$statut'");
	    if(mysql_num_rows($exereq)==0){
	 	$sql_ajout="INSERT INTO proprietaire VALUES ('', '$nom', '$prenom', '$societe', '$statut')";

	   // echo "<br> requete : ".$sql_ajout;

	    $query_ajout=mysql_query($sql_ajout) or die($erreur);

	    $idpro = mysql_insert_id();

				if($query_ajout){
			//	echo"<div align=center class=imp>enregistrement valide!</div>";
				}
				else
				{
			//		echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

	     		}

	    }

	    else{
	    	//echo "<br>Ce propriétaire existe déja";
	    }
    }

    return $idpro ;
}


//ajout migration


function save_migration(){

		//echo "<br>bienvenu pour ajouter un gestionnaire <br>";

	if(isset($_POST["valider"])){

	$bajoutsier = addslashes($_POST['idDos']);
	$destination = addslashes($_POST['Classeur_dest']);
	$origine=addslashes($_POST['Classeur_orig']);
	$dateMig = date("d/m/Y");
	$motif = addslashes($_POST['motif']);

    $exereq=mysql_query("select * from migration where idDos='$bajoutsier' and destination='$destination' and origine='$origine' and dateMig='$dateMig' and motif='$motif'");
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO migration VALUES ('', '$bajoutsier', '$destination','$origine', '$dateMig', '$motif')";
    $exe_req=MYSQL_query("update dossier set idCl=".$destination."
    			where idDos=".$bajoutsier."");
    //echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die( mysql_error());
			if($query_ajout){
			echo"<div align=center class=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}

    }
    else{
    	echo "<br>Cette migration  existe déja";
    }
    }
}

// ajout suivi
 function save_suivi(){

		//echo "<br>bienvenu pour ajouter un suivi <br>";

//	if(@($_POST["datefin"])<>"" AND @($_POST["datedebut"])<>""){

	$nom = addslashes($_POST['idDos']);
	$prenom = addslashes($_POST['idUser']);
	$login = dateslashes($_POST['datedebut']);
	$password = dateslashes($_POST['datefin']);
	$service ="";
    // echo "select * from suivi where idDos='$nom' and idUser='prenom' and datedebut='$login' and datefin='$password'";
	//$privilege = addslashes($_POST['Libelle']);
    $exereq=mysql_query("select * from suivi where idDos='$nom' and idGest='prenom' and datedebut='$login' and datefin='$password'")OR die(mysql_error());
    if(mysql_num_rows($exereq)==0){
 	$sql_ajout="INSERT INTO suivi VALUES ('', '$nom', '$prenom', '$login', '$password', '$service')";

   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			echo"<div align=center CLASS=imp>enregistrement valide!</div>";
			}
			else
			{
				echo"<div align=center class=imp>Echec!Veuillez reprendre</div>";

     		}
    }

    else{
    	echo "<div align=center CLASS=imp>Ce suivi existe déja</div>";
    }
   // }
}


?>