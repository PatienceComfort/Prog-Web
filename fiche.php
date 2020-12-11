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
	
	<!-- Fiche Genome -->
	<div class = 'resultat'> 
	<h2>Fiche</h2>
<table style='width:10%';>
	
	<?php $str=$_SERVER['REQUEST_URI']; 
	
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; // id recupéré de l'url
	?>
	<?php

	$res = pg_query($db,"SELECT * FROM genegate.genome WHERE idgenome='".$id."';");
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}
	echo " <td colspan='2'> Informations générales </td>";
	while ($row = pg_fetch_assoc($res) ){
	echo "<div style='font-size:110%'> 
	<tr><th> Genome ID </th><td>".$row['idgenome']."</td></tr><br>
	<tr><th> Taille </th><td>".$row['taille']."</td></tr><br>
	<tr><th> Genre </th><td>".$row['genre']."</td></tr><br>
	<tr><th> Espèce </th><td>".$row['espece']."</td></tr><br>
	<tr><th> Souche </th><td>".$row['souche']."</td></tr><br>
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

	<?php 
// Récupérer l'identifiant de l'uniprot necessaire pour la visualisation du génome :
$url_request ="https://www.uniprot.org/proteomes/?query=+$genre+$espece+$souche&sort=score";
$txt = file_get_contents($url_request);
$results = array();

$test = preg_match_all('#(UP[0-9]+)#', $txt, $results);
$id=$results[0][0];


$url_request2 ="https://www.uniprot.org/proteomes/$id"; // identifiant du génome présent sur la fiche uniprot
$txt2 = file_get_contents($url_request2);
$test2 = preg_match_all('#([A-Z][A-Z][0-9]+)#', $txt2, $results2);
$id2 =$results2[0][14];
echo $id2;
?>

<!-- NCBI Sequence Viewer pour visualiser le génome -->
<script type="text/javascript" src="https://www.ncbi.nlm.nih.gov/projects/sviewer/js/sviewer.js"></script>
<div id="sviewer_x7zvq" class="SeqViewerApp" data-autoload>
<a href=<?php echo "?embedded=true&id=$id2" ?>>

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

