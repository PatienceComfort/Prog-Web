<!DOCTYPE html>

<?php
   # connexion à la base : affiche "connection failed" si pas de connection
   include 'connect_db.php';
	 session_start();
?>
  <head>

  <meta charset="utf-8" />
        <title>Genegate</title>  
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
  	<li><a href="ForumSujets.php"> Access Forum</a></li>
  	<li><a href="utilisateur.php"> Your Account </a></li>
  	<li><a href="Contact.php"> Contact </a></li>		
	</div>

		<div class="sidenav"> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.flaticon.com/svg/static/icons/svg/1198/1198618.svg" height="70" width="115"><br> Rechercher séquence </button> <br>

		<button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.flaticon.com/svg/static/icons/svg/1198/1198618.svg" height="70" width="115"><br> Rechercher génome </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Transcrit </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>
  
	</div>

	<div id="pageresults">
<table style='width:45%';>
<?php
    
	// aficher l'intégralité de la base transcrit
	$res = pg_query($db,"SELECT * FROM genegate.transcrit");
	if(pg_num_rows($res) != 0) {
		echo "<td> ID </td><td>Gene </td><td>Proteine </td><td>Biotype gene</td><td>Biotype trancrit</td><td>Annotée</td>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<tr>
		<td><a href='fiche2.php?id=".$row['idseq']."'>".$row['idseq']."</a></td>
	    	<td>".$row['nomgene']."</td>
		<td>".$row['nomprot']."</td>
	    	<td>".$row['biotypegene']."</td>
		<td>".$row['biotypetranscrit']."</td>
		<td>".$row['annotee']."</td>
       		</tr> ";

		}
	}

	pg_close($db);
?>
</table>
	</div>

  </body>

</html>
