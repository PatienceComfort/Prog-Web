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

<?php
  $id=$_SESSION['idAnnot'];
   
  $gene=$_POST['nomgene'];
  $cds=$_POST['nomcds'];

  $fonction =$_POST['fonction'];
  $biotype_gene =$_POST['biotypegene'];
  $biotype_transcrit=$_POST['biotypeprot'];

	// Recuperation des annotations et enregistrement dans les bases transcrit et annotation
  $update1 = pg_query($db," UPDATE genegate.transcrit SET fonction='".$fonction."',biotypeTranscrit='".$biotype_transcrit."', nomGene='".$gene."', nomProt='".$cds."' WHERE idSeq='".$id."'"); 
  $update2 = pg_query($db,"UPDATE genegate.annotation SET statut='A valider' WHERE idSeq='".$id."'");

  pg_close($db);
?>

<div id = "attribution">
<!-- Confirmation de l'attribution -->
<p> Annotation confirmée ! Veuillez attendre la confirmation d'un validateur. <p>
<p> Retourner au tableaux des séquences à annoter : <a href="annotation.php"> Cliquer ici </a> <p>;

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
