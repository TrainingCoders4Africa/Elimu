<?php
//require_once('connection.php');
//maj d'un dossier

function update_dossier($idPro){
	//echo "<br>bienvenu pour maj un dossier </br>";

	if(isset($_POST["valider"])){
	echo "sss".$idDos = addslashes($_POST['idDos']);
    $pj=movefichier("mpj".$idDos,$idDos);
	//$idPro = addslashes($_POST['abib']);
	$theme = addslashes($_POST['Theme']);
	$reference = addslashes($_POST['Reference']);
	$idNat = addslashes($_POST['Nature']);
	$idCl = addslashes($_POST['Classeur']);
	$idGest = addslashes($_POST['Gestionnaire']);
	$dateEnr=$_POST['dateEnr'];

 	$sql_maj="UPDATE `dossier` SET  `theme` = '$theme', `reference` = '$reference', `idNat` = '$idNat',";
 	$sql_maj.=" `idCl` = '$idCl', `idGest` = '$idGest', `Date_Enregistrement` = '$dateEnr' WHERE `idDos` = '$idDos' ";

   // echo "<br> requete : ".$sql_maj;

  $query_maj=mysql_query($sql_maj) or die(mysql_error());
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}  /**/
    }

}



//maj user


function update_user(){

	//echo "<br>bienvenu pour maj un user </br>";


	if(@($_POST["valider"])<>""){

	$id = addslashes($_POST['user']);
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	/*$login = addslashes($_POST['Login']);
	$password = addslashes($_POST['password']);
	$privilege = addslashes($_POST['Privilege']); */
	$fonction= addslashes($_POST['fonction']);

 	//$sql_maj="UPDATE `user` SET `nom` = '$nom', `prenom` = '$prenom', `fonction` = '$fonction', `login` = '$login', `password` = '$password', `privilege` = '$privilege' WHERE `id` = '$id' ";
 	$sql_maj="UPDATE `user` SET `nom` = '$nom', `prenom` = '$prenom', `fonction` = '$fonction' WHERE `id` = '$id' ";

   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
    }
}


//maj classeur


function update_classeur(){

	//echo "<br>bienvenu pour maj d'un classeur <br>";

	if(isset($_POST["valider"])){

	$idCl = addslashes($_POST['classeur']);
	$idEt = addslashes($_POST['Etagiaire']);
	$nom = addslashes($_POST['Nom']);
	$nbreDossier = addslashes($_POST['nbre_dos']);
	$specification = addslashes($_POST['Specification']);


 	$sql_maj="UPDATE `classeur` SET `idEt` = '$idEt', `nom` = '$nom', `nbreDossier` = '$nbreDossier', `specification` = '$specification' WHERE `idCl` = '$idCl' ";


   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
    }

}



//maj etagiaire


function update_etagiare(){

	//echo "<br>bienvenu pour maj un dossier <br>";


	if(isset($_POST["valider"])){

	$idEt = addslashes($_POST['Etagiaire']);
	$idRa = addslashes($_POST['Rayon']);
	$nom = addslashes($_POST['Nom']);
	$nbreClasseur = addslashes($_POST['nbre_cla']);
	$specification = addslashes($_POST['Specification']);

 	$sql_maj="UPDATE `etagiare` SET `idRa` = '$idRa', `nom` = '$nom', `nbreClasseur` = '$nbreClasseur', `specification` = '$specification' WHERE `idEt` = '$idEt' ";

   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
    }

}


//maj rayon


function update_rayon(){

	//echo "<br>bienvenu pour maj un dossier <br>";

	if(isset($_POST["valider"])){

	$idRa = addslashes($_POST['Rayon']);
	$nom = addslashes($_POST['Nom']);
	$nbreEtagiaire = addslashes($_POST['nbre_eta']);
	$specification = addslashes($_POST['Specification']);

 	$sql_maj="UPDATE `rayon` SET `nom` = '$nom', `nbreEtagiaire` = '$nbreEtagiaire', `specification` = '$specification' WHERE `idRa` = '$idRa' ";

   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			echo "<meta http-equiv=\"refresh\" content=\"0;url=rayon.php?&vis=1\">";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
     	/**/
    }

}


//maj nature


function update_nature(){

	//echo "<br>bienvenu pour maj un dossier <br>";

	if(isset($_POST["valider"])){

	//echo"id : ".
	$idNat = ($_POST['idnat']);
	$libelle = addslashes($_POST['Libelle']);
	$specification = addslashes($_POST['Specification']);

 	$sql_maj="UPDATE `nature` SET `libelle` = '$libelle', `specification` = '$specification' WHERE `idNat` = '$idNat' ";

   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
    }

}


//maj gestionnaire


function update_gestionnaire(){

	//echo "<br>bienvenu pour maj un dossier <br>";


	if(isset($_POST["Login"])){
  	$idGest = addslashes($_POST['Gestionnaire']);
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	$login = addslashes($_POST['Login']);
	$password = addslashes($_POST['password']);
	$service = addslashes($_POST['Service']);
	$poste = addslashes($_POST['Poste']);

 	$sql_maj="UPDATE `gestionnaire` SET `nom` = '$nom', `prenom` = '$prenom', `login` = '$login', `password` = '$password',";
 	$sql_maj.="`service` = '$service', `poste` = '$poste' WHERE `idGest` = '$idGest' ";

   // echo "<br> requete : ".$sql_maj;

   /* $query_maj=mysql_query($sql_maj) or die($erreur);
			if($query_maj){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
     		*/
    }

}


//maj proprietaire


function update_proprietaire(){

	//echo "<br>bienvenu pour maj un dossier <br>";


	if(isset($_POST["Theme"])){

	$idPro = addslashes($_POST['idPro']);
	$nom = addslashes($_POST['Nom']);
	$prenom = addslashes($_POST['Prenom']);
	$societe = addslashes($_POST['Societe']);
	$statut = addslashes($_POST['Statut']);


 	$sql_maj="UPDATE `proprietaire` SET `nom` = '$nom', `prenom` = '$prenom', `societe` = '$societe', `statut` = '$statut' WHERE `idPro` = '$idPro' ";

   // echo "<br> requete : ".$sql_maj;

    $query_maj=mysql_query($sql_maj) or die($erreur);

    //$idpro = mysql_insert_id();

			if($query_maj){
			////echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
			//	//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}  /**/
    }

	return $idPro ;
}

// metier

function retour(){


		//echo "<br>bienvenu pour ajouter un gestionnaire <br>";

	if(isset($_POST["dateretour"])){

	$bajoutsier = addslashes($_POST['dossier']);
	$dateretour = dateslashes($_POST['dateretour']);
	//$destination = addslashes($_POST['destinaire']);
	//$dateMig = addslashes($_POST['datemig']);
	//$motif = addslashes($_POST['motif']);

 	$sql_ajout = "UPDATE `migration` SET `dateRetour` = '$dateretour' WHERE `idMig` = '$bajoutsier' ";


   // echo "<br> requete : ".$sql_ajout;

    $query_ajout=mysql_query($sql_ajout) or die($erreur);
			if($query_ajout){
			//echo"<h3 align='center'>enregistrement valide!</h3>";
			}
			else
			{
				//echo"<h3 align='center' style='color:red'>Echec!Veuillez reprendre</h3>";

     		}
    }
}

function update_suivi(){ if(isset($_POST["valider"])){  $idDos=$_POST["idDos"];
  $suivi=findByValue("suivi","idDos",$idDos);
  while($ow=mysql_fetch_row($suivi)){  	      $iduser=$ow[2];          $datedeb=dateslashes($_POST["datedebut$iduser"]);
          $datefin=dateslashes($_POST["datefin$iduser"]);
          $dateret=dateslashes(@$_POST["dateretour$iduser"]);
         // echo"<br>pj ".
          $pj=movefichier("mpj".$idDos.$iduser."",$idDos."-".$iduser);

        // echo "<br>update suivi set datedebut='$datedeb',datefin='$datefin',dateretour='$dateret'
          //     where idDos='$idDos' AND idUser='$iduser'";
          $exe=mysql_query("update suivi set datedebut='$datedeb',datefin='$datefin',dateretour='$dateret'
               where idDos='$idDos' AND idUser='$iduser'");
  }}
}

?>