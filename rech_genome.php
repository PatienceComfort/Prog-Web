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
  		<?php if ( $_SESSION['statut'] == 'Annotateur') {
          	 $menu='MenuA.php'; 
	} else if ( $_SESSION['statut'] == 'Validateur') {      	 
		$menu='MenuV.php'; 
	} else {
		$menu='MenuL.php'; 
	}?>

  	<li><a href="<?php echo $menu ?>">Home</a></li>
  	<li><a href="#"> Access Forum</a></li>
  	<li><a href="utilisateur.php"> Your Account </a></li>
  	<li><a href="Contact.php"> Contact </a></li>		
	</div>
	
	<div class="sidenav"> <br>

		
	<button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher séquence </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher génome </button> <br>
	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="http://ugene.unipro.ru/wp-content/uploads/2015/03/55.png" height="70" width="115""><br> Alignement </button> <br>
		<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://i2.wp.com/bioinfo-fr.net/wp-content/uploads/2012/05/INSL5.png?ssl=1" height="70" width="115"><br> Base Nucléotidique </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Proteique </button> <br>
	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>
  
	</div>

<table style='width:40%';>
	<div id="pageresults">
	<h2> Résultats :</h2>
<?php
	
	$db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996"  );
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
		echo " <br><div style='font-size:150%'> Aucun résultats </div> <br> <br>";
		echo " <td colspan='5'> ID Genre Espece Souche Taille </td>";
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
		echo " <td colspan='5'> ID Genre Espece Souche Taille </td>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<br><tr>
            	<td> <a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a> </td>  
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
		<td>".$row['taille']."</td>
       		</tr>";
		
		} // l'identifiant renvoie vers le lien de la fiche ==> ?id= dans l'url : sert à retrouver l'id et sert à partir d'une page fiche.php afficher toutes les résultats/génome que l'utilisateur veut voir.

	}

pg_close($db);
?>
</table>
</div>

</body>

	<div class ="bottombar">
  		<li><a href="plan.php"> Plan du Site  </a> </li>
  		<li><a href="policy.php"> Conditions  </a> </li>
  		<li><a href="About us.php"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.php"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		© 2020 GeneGATE
	</div> 





</html>
