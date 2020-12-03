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
	
	<div class = 'resultat'> 
	<h2>Fiche</h2>
<table style='width:10%';>
	
	<?php $str=$_SERVER['REQUEST_URI']; 
	
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; // id recupéré de l'url
	?>
	<?php
	$db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996"  );
	if(!$db) {      
		echo "Error : Unable to open database\n";
	}
	$res = pg_query($db,"SELECT * FROM genegate.genome WHERE idgenome='".$id."';");
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	echo " <td colspan='2'> Informations générales </td>";
	while ($row = pg_fetch_assoc($res) ){
	echo "<div style='font-size:110%'> 
	<tr><th> Genome ID = </th><td>".$row['idgenome']."</td></tr><br>
	<tr><th> Genre = </th><td>".$row['genre']."</td></tr><br>
	<tr><th> Espèce = </th><td>".$row['espece']."</td></tr><br>
	<tr><th> Souche = </th><td>".$row['souche']."</td></tr><br>
        </div>";
	$seq = $row['genomecomplet'];
	}
?>
</table>
 
	<h4>Séquence : </h4>
	<textarea name="txt" cols="65" rows="20" id="txt1">
    <?php echo $seq; ?> 
	</textarea>

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

