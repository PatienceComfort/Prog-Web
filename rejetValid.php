<!DOCTYPE html>
<?php session_start(); 
include 'connect_db.php';?>
<html lang="fr">
<?php
	// Rejet des annotations
	$str=$_SERVER['REQUEST_URI']; 
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; 

	$update = pg_query($db,"UPDATE genegate.annotation SET statut='Pas d annotateur',idValid2='".$_SESSION['mail']."' WHERE idSeq='".$id."'");
	$update2 = pg_query($db,"UPDATE genegate.transcrit SET annotee=False WHERE idSeq='".$id."'");

	
	$res= pg_query($db,"SELECT * FROM genegate.annotation WHERE idSeq='".$id."'");
	
	while ($row = pg_fetch_assoc($res) ){
		$user = $row['idannot'];
	}

	$res2= pg_query($db,"SELECT * FROM genegate.utilisateur WHERE username='".$user."'");
	while ($row = pg_fetch_assoc($res2) ){
		$email = $row['email'];
	}
?>

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
<div id = "attribution">

<!-- Rejet de la validation -->
<p> Rejet de la validation ! <p>

<?php echo "<a href='mailto: ".$email."?subject=Rejet Validation'> Avertir l'annotateur ? </a>"; // envoyer le mail ?>
</div>
<div class ="bottombar">
 		<li><a href="plan.php"> Plan du Site  </a> </li>
  		<li><a href="policy.php"> Conditions  </a> </li>
  		<li><a href="About us.php"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.php"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		©2020 GeneGATE
	</div> 
</body>
</html>
