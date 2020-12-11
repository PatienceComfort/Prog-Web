<!DOCTYPE html>
<?php
session_start();
# connexion à la base : affiche "connection failed" si pas de connection
include 'connect_db.php';
	$id=$_POST["id"];
	$emailValid=$_SESSION['mail'];
    $seq = pg_query($db,"SELECT * FROM genegate.annotation WHERE idSeq='".$id."'"); // récupération de l'ID de sequence
	$uti = pg_query($db,"SELECT * FROM genegate.utilisateur WHERE email='".$_POST["email"]."'"); // récuperation de l'émail de l'utilisateur 
	if ((!$seq) || (!$uti)) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}	
	$bool = 0;
	if (pg_num_rows($seq) != 0) {
		while ($row = pg_fetch_assoc($seq) ){
		if ($row['statut'] == "Pas d annotateur") { // verification du statut de la séquence
			$bool ++;
			}
		}	
	}
	if (pg_num_rows($uti) != 0) {
		while ($row = pg_fetch_assoc($uti) ){
			$username = $row['username'];
		if ($row['statut'] != 'Lecteur' and $row['validation_compte'] == TRUE) { // verification du statut de l'utilisateur
			$bool ++;
			}
		}	
	}
	
	if ($bool == 2) { // si bool = 2 alors les 2 verifications sont validées
		$update = pg_query($db,"UPDATE genegate.annotation SET idAnnot='".$username."', statut='A annoter' WHERE idSeq='".$id."'");
		$update2 = pg_query($db,"UPDATE genegate.annotation SET idValid='".$emailValid."' WHERE idSeq='".$id."'");
	}	

	/*$res = pg_query($db,"SELECT * FROM genegate.annotation WHERE idSeq='".$id."'");
		while ($row = pg_fetch_assoc($res)){
		echo "<tr>
		<td>".$row['idseq']."</td><td>".$row['statut']."</td><td>".$row['idannot']."</td></tr>";
	}*/ 
pg_close($db);
	
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
<!-- Confirmation de l'attribution -->
<p> Attribution confirmée ! <p>
<p> Retourner au tableaux des séquences à attribuer : <a href="attribuer.php"> Cliquer ici </a> <p>;
<?php echo "<a href='mailto: ".$_POST["email"]."?subject=Nouvelle Sequence a annoter'> Avertir l'annotateur ? </a>";// envoyer le mail ?>
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


