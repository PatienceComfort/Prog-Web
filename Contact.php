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


	<div class = "LoginRegisterContactForm">
	<h1> Contact Us : </h1>
	<form>
	<p> Name : </p> <input type="text" name="name">
	<p> Email : </p> <input type="text" name="email">
	<p> Objet :  </p>
 	<select> 
  	<option value="1"> Information sur mon Compte </option>
  	<option value="2"> Information Annotations </option>
	<option value="3"> Information Validations </option>
	<option value="4"> Information Base de données </option>
	<option value="5"> Autres </option>
	</select>
	<p>Message</p><textarea name="message" rows="10" cols="40"></textarea><br><br>
	<input type="submit" value="Send">
	<input type="reset" value="Clear">
	</form>
	</div>

	</body>

	<div class="bottombar">
  	<a href="plan.php"> Website Plan</a>
  	<a href="policy.php"> Policy</a>
  	<a href="About us.php">About Us</a>
  	<a href="Contact.php">Contact Us</a>
	</div>

	<div id = "footer">
		© 2020 GeneGATE
	</div> 

</html>

