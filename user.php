<!DOCTYPE html>

<?php
session_start(); 

   $db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
    

	$query =  "SELECT * FROM genegate.utilisateur WHERE email ='".$_POST["email"]."' AND mdp = '".$_POST["pwd"]."'";
	
	$res = pg_query($db,$query);
	while ($row = pg_fetch_assoc($res)) {
	  echo $row['email'];
	$_SESSION['username']=$row['prenom'];
	$_SESSION['mail']=$row['email'];
	$_SESSION['statut']=$row['statut']; 
	}

	if(pg_num_rows($res)!=0){ 
		if ( $_SESSION['statut'] == 'Annotateur') {
          	 header('Location: MenuA.php'); 
	} else if ( $_SESSION['statut'] == 'Validateur') {      	 header('Location: MenuV.php'); 
	} else {
	header('Location: MenuL.php'); 
}
	}else{
		header('Location: login.php?erreur=1');		
		echo "Invalid Details";
    }

pg_close($db);
?>



