<!DOCTYPE html>



<?php

  $db = pg_connect( "host=localhost dbname=genegate port=5432  user=abirami  password=16011996"  ) or die('connection failed');

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 =  $_POST['password_2'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $num = $_POST['phone'];
  $statut = $_POST['statut'];

  if (empty($username)) { 
		header('Location: connexion.php?erreur=1');		
		echo "Invalid Details";  
	}
  else if (empty($email)) { 
		header('Location: connexion.php?erreur=1');		
		echo "Invalid Details";  
	}
  else if (empty($password_1)) { 
		header('Location: connexion.php?erreur=1');		
		echo "Invalid Details";  
	}
  else if ($password_1 != $password_2) { 
		header('Location: connexion.php?erreur=1');		
		echo "Mot de passe différents";  
	}
    
  else {
	$query1 =  "SELECT * FROM genegate.utilisateur WHERE email ='".$_POST["email"]."'";
	$res = pg_query($db,$query);
	if(pg_num_rows($res)!=0){ 
		header('Location: connexion.php?erreur=1');		
		echo "Un Compte existe déja";  
	} else  {

  	$query2 = pg_query($db,"INSERT INTO genegate.utilisateur (email,username,mdp,nom,prenom,numtel,statut) VALUES ('$email ','$username','$password','$nom','$prenom','$phone','$statut')") or die ('Erreur connexion'. pg_last_error($db));
  	pg_query($db, $query2);
  	header('Location: connexion.php?erreur=1');
	echo "Sucess";
  	}
		
    }


pg_close($db);
?>

