<!DOCTYPE html>
<?php session_start(); 
include 'connect_db.php';
?>
<html lang="fr">
<?php
	// connexion de l'utilisateur à la base 
	$query =  "SELECT * FROM genegate.utilisateur WHERE email='".$_POST["email"]."' AND mdp='".$_POST["pwd"]."'";
	
	$res = pg_query($db,$query);
	while ($row = pg_fetch_assoc($res)) {
	  echo $row['email'];
	$_SESSION['username']=$row['username'];
	$_SESSION['mail']=$row['email'];
	$_SESSION['statut']=$row['statut']; 
	$_SESSION['pseudo']=$row['username'];
	}
	$timestamp = time();
	$datetime = date("d-m-Y H:i:s",$timestamp);
	$update_time = pg_query($db,"UPDATE genegate.utilisateur SET dateconnexion = '".$datetime."' WHERE email='".$_POST["email"]."';");
	// rechercher le role de l'utilisateur
	if(pg_num_rows($res)!=0){ 
		if ( $_SESSION['statut'] == 'Annotateur') {
          	 header('Location: MenuA.php'); 
	} else if ( $_SESSION['statut'] == 'Validateur') {    header('Location: MenuV.php'); 
		} else {
		header('Location: MenuL.php');
	}
	}else{
		header('Location: login.php?erreur=1');		
    }

pg_close($db);
?>



