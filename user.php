<!DOCTYPE html>

<?php

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
	}

	if(pg_num_rows($res)!=0){ 
		echo "Login Successfully"; 
          	 header('Location: MenuSite.php');   
	}else{
		header('Location: connexion.php?erreur=1');		
		echo "Invalid Details";
    }

pg_close($db);
?>



