<!DOCTYPE html>

<?php

  $db = pg_connect("host=localhost dbname=genegate port=5432  user=  password=") or die('connection failed');

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 =  $_POST['password_2'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $num = $_POST['phone'];
  $role = $_POST['role']; 


  if ($password_1 != $password_2) {  // verifier les mots de passe
		header('Location: inscriptionUti.php?erreur=1');		  
	}
	else {
	$query1 =  "SELECT * FROM genegate.utilisateur WHERE email ='".$_POST["email"]."'";  // verifier si email existe déja ?
	$res = pg_query($db,$query1);
	if(pg_num_rows($res)!=0){ 
		header('Location: inscriptionUti.php?erreur=1');		  
	} else  {
	
  	$res = pg_query($db,"INSERT INTO genegate.utilisateur(email,username,mdp,nom,prenom,numtel,dateConnexion,statut,validation_compte) VALUES ('$email ','$username','$password_1','$nom','$prenom','$phone',NULL,'$role',FALSE)") or die ('Erreur connexion'. pg_last_error($db));
	echo "Votre inscription a bien été enregistré. Veuillez attendre la confirmation de votre inscription par l'administrateur. <p> <br>
	   Pour retourner au menu <a href=MenuSite.php> Cliquer ici" // sinon ajout de l'utilisateur dans la base, et message de confirmation
  	}
    }

pg_close($db);
?>

