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

	<!-- Fiche Transcrit -->
	<div class = 'resultat'> 
<table style='width:10%';>
	<?php $str=$_SERVER['REQUEST_URI']; 
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; // id de la sequence d'interet, récupéré grace à l'URL
	?>

	<h1> Fiche  </h1>
	<?php

	$res = pg_query($db,"SELECT * FROM genegate.transcrit WHERE idseq='".$id."';");
	
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	while ($row = pg_fetch_assoc($res) ){
		echo "<td colspan='2'> Informations générales </td>
		<tr><th> Seq ID </th><td>".$row['idseq']."</td></tr>
	    <tr><th> nom Gene </th><td>".$row['nomgene']."</td></tr> 
		<tr><th> Genome ID </th><td><a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a></td></tr>
	    <tr><th> Biotype gene </th><td>".$row['biotypegene']."</td></tr>
		<tr><th> Biotype transcrit </th><td>".$row['biotypetranscrit']."</td></tr>
		<tr><th> Description </th><td>".$row['fonction']."</td></tr>
		<tr><th> position début </th><td>".$row['pos_debut']."</td></tr>
		<tr><th> position fin </th><td>".$row['pos_fin']."</td></tr>
	    <tr><th> statut </th><td>".$row['annotee']."</td></tr>";
		$seqnuc=$row['seqnt'];
		$seqaa = $row['seqprot'];
		$transcrit=$row['nomgene'];
	}

//Recuperation de l'url bacteria.ensembl
$url_request = "http://bacteria.ensembl.org/Multi/Search/Results?species=all;idx=;q={$transcrit};site=ensemblunit";
$txt = file_get_contents($url_request);
$results = array();
$test = preg_match_all('#<a class="name" href="/(.+?)"><strong>#', $txt, $results);
$url_ensembl = "http://bacteria.ensembl.org/{$results[1][0]}";

//Recuperation de l'url uniprot sur la page bacteria.ensembl
$txt_ensbl = file_get_contents($url_ensembl);
$results_ensbl = array();
$test_ensbl = preg_match_all('#<a href="http://www.uniprot.org/uniprot/(.+?)" rel="external" #', $txt_ensbl, $results_ensbl);
$url_uniprot = "http://www.uniprot.org/uniprot/{$results_ensbl[1][0]}";

//Recuperation de l'url pfam sur la page uniprot
$txt_uniprot = file_get_contents($url_uniprot);
$results_uniprot = array();
$test_uniprot = preg_match_all('#<a href="http://pfam.xfam.org/protein/(.+?)" onclick#', $txt_uniprot, $results_uniprot);
$url_pfam = "http://pfam.xfam.org/protein/{$results_uniprot[1][0]}";	
?>

</table>

<h4>Séquence nucléotidique: </h4>
	<textarea name="txt" cols="65" rows="10" id="txt1">
    <?php echo $seqnuc; ?> 
	</textarea>

<h4>Séquence protéique: </h4>
	<textarea name="txt" cols="65" rows="10" id="txt1">
    <?php echo $seqaa; ?> 
	</textarea>


</div>

<!-- Fiches références -->
<div id="uniprotPfamEnsembl">
    Fiches Références : <br><br>

	<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_uniprot;?>'"> <img src="https://avatars1.githubusercontent.com/u/9991058?s=280&v=4" height="70" width="115""> <br> Uniprot </button> <br><br>	
	<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_pfam;?>'"><img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Pfam_logo.gif" height="70" width="115""><br> PFAM </button> <br><br>
	<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_ensembl;?>'"><img src="https://avatars2.githubusercontent.com/u/5832463?s=280&v=4" height="70" width="115""><br> Ensembl </button> <br>
</div>
<!-- Alignement Blast -->
<div id="Alignement"> <br>
Pour obtenir les résultats de BLASTn contre la base nt:<br><br>
	<form action="blastResult.php" method="get">
  	<input type="hidden" name="seqnt" value=<?php echo preg_replace('/\s+/','',$seqnuc);?>>
     	<input type="submit" value="BLASTn">
  </form> <br><br>
Pour obtenir les résultats de BLASTp contre la base nr:<br><br>
	<form action="blastResult2.php" method="get">
    <input type="hidden" name="seqaa" value=<?php echo preg_replace('/\s+/','',$seqaa); ?>>
      <input type="submit" value="BLASTp">
  </form> <br><br>
</div>
</body>
</html>

