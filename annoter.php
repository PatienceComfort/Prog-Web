<!DOCTYPE html>
<?php
session_start();
# connexion à la base : affiche "connection failed" si pas de connection
include 'connect_db.php'; ?>

<html>

  <head>

  <meta charset="utf-8" />
        <title> Genegate</title>  
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

	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br> </div>

		<div id="attribution">

			<form action="confirmAnnotation.php" method="POST">

			<?php 
  			$str=$_SERVER['REQUEST_URI']; 
	
			$keywords = preg_split("/=/", $str);
			$_SESSION['idAnnot'] = $keywords[1]; 		
			?>
			<h1> Annoter la séquence <?php echo $_SESSION['idAnnot'] ?> </h1>
			
			Consulter la fiche :
			<?php echo "<a href='fiche2.php?id=".$_SESSION['idAnnot'] ."'>".$_SESSION['idAnnot']."</a>"; ?> <br><br>

			<label> <b> Nom gène: <b> </label>
			<input type="text"  name="nomgene" placeholder="gene" required> <br><br>

			<label> <b> Nom CDS: <b> </label>
			<input type="text"  name="nomcds" placeholder="cds" required> <br><br>

			<label> <b> Fonction: <b> </label>
			<input type="text"  name="fonction" placeholder="Fonction" required> <br><br>

			<label> <b> Biotype_gene : <b> </label>
			<input name="biotypegene" placeholder="biotypegene" required> <br><br>

			<label> <b> Biotype_transcrit : <b> </label>
			<input name="biotypeprot"  placeholder="biotypeprot" required> <br><br>

			<input type="submit" id='submit' value="Annoter" > 

			</form>
		</div>
​</body>
</html>
