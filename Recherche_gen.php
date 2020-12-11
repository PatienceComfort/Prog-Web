<!DOCTYPE html>
<?php session_start(); 
include 'connect_db.php';
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

	<!-- Formulaire de Recherche de Génome -->
	<div id= "searchSeqGenome2" >

		<form action="rech_genome.php" method="POST">
		<h3> Rechercher un génome </h3>

		Génome ID :
		<input type="text" placeholder="ID" name="id" >

		Genre : 
		<input type="text" placeholder="Genre" name="genre" > <br><br>
		
		Espèce :
		<input type="text" placeholder="Espèce" name="espece" >

		Souche :
		<input type="text" placeholder="Souche" name="souche" > <br><br>

		Séquence génome : <br>
​		<textarea id="txtArea" rows="10" cols="60" name="query" placeholder = "Search.."> </textarea> <br><br>

		<input type="submit" value="Rechercher" /> </button> <br>

		</form>
	</div>


	<div class ="bottombar">
  		<li><a href="plan.php"> Plan du Site  </a> </li>
  		<li><a href="policy.php"> Conditions  </a> </li>
  		<li><a href="About us.php"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.php"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		© 2020 GeneGATE
	</div> 

  </body>


</html>



  
	</div>
