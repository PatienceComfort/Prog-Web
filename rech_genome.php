<!DOCTYPE html>
<?php session_start();?>
<html lang="fr">

  <head>

  <meta charset="utf-8" />
        <title>Website Style</title>  
	 <link rel="stylesheet" type="text/css" href="style1.css">
	<div id="header"> <br>
		<h> GeneGATE </h> <br><br>					
	</div>

  </head>

  <body>
	<div id ="menu"> 
  	<li><a href="MenuSite.html">Home</a></li>
  	<li><a href="#"> Access Forum</a></li>
  	<li><a href="YourAccount.html"> Your Account </a></li>
  	<li><a href="Contact.html"> Contact </a></li>	
	</div>


	<div id="pageresults">
<?php

	$db = pg_connect( "host=localhost port=5432 dbname=genegate user= password="  );
	if(!$db) {      
		echo "Error : Unable to open database\n";
	}

	// on regarde quels informations sont rentrées par l'utilisateur
	if (!empty($_POST["id"])) { 
		$res = pg_query($db,"SELECT * FROM genegate.genome WHERE idgenome='".$_POST["id"]."';");
	} elseif (!empty($_POST["query"])) {
		$res = pg_query($db,"SELECT * FROM genegate.genome WHERE genomecomplet='".$_POST["query"]."';");
	} elseif (!empty($_POST["souche"])) {
		$res = pg_query($db,"SELECT * FROM genegate.genome WHERE souche='".$_POST["souche"]."';");
	} elseif (!empty($_POST["espece"])) {
		$res = pg_query($db,"SELECT * FROM genegate.genome WHERE espece='".$_POST["espece"]."';");
	} else {
		$res = pg_query($db,"SELECT * FROM genegate.genome WHERE genre='".$_POST["genre"]."';");
	}
	

	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	if(pg_num_rows($res) == 0) { // si 0 resultats alors on affiche toute la base
		$res2 = pg_query($db,"SELECT * FROM genegate.genome ;");
		echo " <br> Requete introuvable <br> <br>";
		echo "<div style='font-size:150%'> ID Genre Espece Souche </div>";
		while ($row = pg_fetch_assoc($res2) ){
		echo "<div style='font-size:110%'> 
		<br><tr>
            	<td> <a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a> </td> 
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
       		</tr> </div>";
		
		}
	}
	if(pg_num_rows($res) != 0) {
		echo "<div style='font-size:110%' ID Genre Espece Souche </div>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<div style='font-size:110%'> 
		<br><tr>
            	<td> <a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a> </td>  
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
       		</tr> </div>";
		
		} // l'identifiant renvoie vers le lien de la fiche ==> ?id= dans l'url : sert à retrouver l'id et sert à partir d'une page fiche.php afficher toutes les résultats/génome que l'utilisateur veut voir.

	}

pg_close($db);
?>

</div>

</body>



	<div id = "footer"> 
		© 2020 GeneGATE
	</div> 

  </body>


</html
