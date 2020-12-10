<!DOCTYPE html>

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
  	<li><a href="ForumSujets.php"> Access Forum</a></li>
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
<table style='width:10%';>
	<?php $str=$_SERVER['REQUEST_URI']; 
	
	$keywords = preg_split("/=/", $str);
	$id = $keywords[1]; // id recupéré de l'url
	?>

	<h1> Fiche  </h1>
	<?php
	$db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996");
	if(!$db) {      
		echo "Error : Unable to open database\n";
	}

	$res = pg_query($db,"SELECT * FROM genegate.transcrit WHERE idseq='".$id."';");
	

	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	while ($row = pg_fetch_assoc($res) ){
		echo "<td colspan='2'> Informations générales </td>
		<tr><th> Seq ID </th><td>".$row['idseq']."</td></tr>
	        <tr><th> nom Gene </th><td>".$row['nomgene']."</td></tr> 
		<tr><th> nom Proteine </th><td>".$row['nomprot']."</td></tr>
	        <tr><th> Biotype gene </th><td>".$row['biotypegene']."</td></tr>
		<tr><th> Biotype transcrit </th><td>".$row['biotypetranscrit']."</td></tr>
		<tr><th> possition début </th><td>".$row['pos_debut']."</td></tr>
	        <tr><th> position fin </th><td>".$row['pos_fin']."</td></tr>";
		$seq=$row['seqnt'];
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
<h4>Séquence : </h4>
	<textarea name="txt" cols="65" rows="10" id="txt1">
    <?php echo $seq; ?> 
	</textarea>



</div>
<div id="uniprotPfamEnsembl">
      Fiches Références : <br><br>

	<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_uniprot;?>'"> <img src="https://avatars1.githubusercontent.com/u/9991058?s=280&v=4" height="70" width="115""> <br> Uniprot </button> <br><br>	
	<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_pfam;?>'"><img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Pfam_logo.gif" height="70" width="115""><br> PFAM </button> <br><br>
		<button id="close-image" name="img" onclick = "location.href = '<?php echo $url_ensembl;?>'"><img src="https://avatars2.githubusercontent.com/u/5832463?s=280&v=4" height="70" width="115""><br> Ensembl </button> <br>


   </div>

</body>
</html>

