<!DOCTYPE html>
<?php session_start(); 
?>

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
	
	
	<div class = 'resultat'> 

	<?php $str=$_SERVER['REQUEST_URI']; 
	
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; // id recupéré de l'url
	?>

	<h1> Fiche <?php echo $_SESSION['id'] ?> </h1>
	<?php
	$db = pg_connect( "host=localhost port=5432 dbname=genegate user= password="  );
	if(!$db) {      
		echo "Error : Unable to open database\n";
	}
	$res = pg_query($db,"SELECT * FROM genegate.genome WHERE idgenome='".$id."';");
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	while ($row = pg_fetch_assoc($res) ){
	echo "<div style='font-size:110%'> 
	Genome ID = ".$row['idgenome']."<br>
	Genre = ".$row['genre']." <br>
	Espèce = ".$row['espece']." <br>
	Souche = ".$row['souche']." <br>
        </div>";
	$seq = $row['genomecomplet'];
	}
?>
	
	<textarea name="txt" cols="65" rows="40" id="txt1">
    <?php echo $seq; ?> 
	</textarea>

	</div>

 </body>


</html>

