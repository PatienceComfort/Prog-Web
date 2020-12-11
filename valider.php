<!DOCTYPE html>
<?php
session_start();
# connexion à la base : affiche "connection failed" si pas de connection
include 'connect_db.php';?>

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
<table style='width:30%'; >
	<?php

	$res = pg_query($db, "SELECT * FROM genegate.annotation WHERE statut = 'A valider';");
	
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	while ($row = pg_fetch_assoc($res) ){
	echo "<td>  ID </td><td>Annotateur</td><td>Statut</td>";
	echo "<tr> 
			<td> <a href='fiche2.php?id=".$row['idseq'] ."'>".$row['idseq']."</a> </td>	";
	echo "
			<td>".$row['idannot']."</td>
	    	<td>".$row['statut']."</td></tr> ";
	$id=$row['idseq'];	
	}
	
?>
</div>
<div id="validation">
<form action='confirmValid.php?id=<?php echo $id ;?>' method='POST'>
<input type='submit' value='valider'>
</form> <br>

<form action='rejetValid.php?id=<?php echo $id ;?>' method='POST'>
<input type='submit' value='rejet'>
</div>

</form>
</table>

</body>

</html>
