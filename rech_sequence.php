<!DOCTYPE html>
<?php session_start();?>
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

<table style='width:40%';>
	<div id="pageresults">
	<h2> Résultats :</h2>
<?php
	
	//$db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996"  );
	$db = pg_connect("host=localhost dbname=romane user=romane");
	if(!$db) {      
		echo "Error : Unable to open database\n";
	}

	// on regarde quels informations sont rentrées par l'utilisateur
	$query_sql = "";
	$info_formulaire = ["id_seq","id_genome","souche","espece","genre","query_nuc","query_prot","taille","debut","fin","nomgene","biotypegene","biotypetranscrit","fonction"];
	$col_table = ["idseq","idgenome","souche","espece","genre","seqnt","seqprot","taille_transcrit","pos_debut","pos_fin","biotypeTranscrit","biotypeGene","fonction"];
	for ($i = 0; $i <= 13; $i++) { //Pour chaque champ du formulaire
		$ch = $info_formulaire[$i];
		$col = $col_table[$i];
		if ($col=="idgenome"){ //idgenome est ambigu
			$col = "transcrit.".$col;
		} 
		if (!empty($_POST[$ch])){ //Si la champ est rempli
			if (strlen($query_sql) > 5){//Si la requete n'est pas vide
				if(($ch != "query_nuc")&&($ch != "query_prot")){
					$query_sql .= "INTERSECT SELECT * FROM genegate.genome,genegate.transcrit WHERE genome.idgenome = transcrit.idgenome AND ".$col."='".$_POST[$ch]."'";
				}else{
					$query_sql .= "INTERSECT SELECT * FROM genegate.genome,genegate.transcrit WHERE genome.idgenome = transcrit.idgenome AND ".$col." LIKE '%".$_POST[$ch]."%' ";
				}
				
			}else{ // Si la requete est vide
				if(($ch != "query_nuc")&&($ch != "query_prot")){
					$query_sql .= "SELECT * FROM genegate.genome,genegate.transcrit WHERE genome.idgenome = transcrit.idgenome AND ".$col."='".$_POST[$ch]."'";
				}else{
					$query_sql .= "SELECT * FROM genegate.genome,genegate.transcrit WHERE genome.idgenome = transcrit.idgenome AND ".$col." LIKE '%".$_POST[$ch]."%' ";
					
				}
				
			}
		}
	}

if(strlen($query_sql) > 5){ //Si la requete n'est pas vide
		$query_sql .= ";";
		echo "<br>";
		//echo $query_sql;
		$res = pg_query($db,$query_sql);
	}
	
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
		echo pg_last_error($conn);
  	exit;
	}

	if(pg_num_rows($res) == 0) { // si 0 resultats
		echo " <br><div style='font-size:150%'> Aucun résultat </div> <br> <br>";
	}
	
	if(pg_num_rows($res) != 0) { //Affichage de tous les resultats
		$array_id = array();
		echo " <td colspan='5'> IDtranscrit Genre Espece Souche Taille </td>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<br><tr>
            	<td> <a href='fiche2.php?id=".$row['idseq']."'> ".$row['idseq']."</a> </td>  
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
		<td>".$row['taille_transcrit']."</td>
       		</tr>";
		$array_id[] = $row['idseq'];
		
		} // l'identifiant renvoie vers le lien de la fiche ==> ?id= dans l'url : sert à retrouver l'id et sert à partir d'une page fiche2.php afficher toutes les résultats/transcrit que l'utilisateur veut voir.

	}
	pg_close($db);
?>
</table>
</div>
	<div style="text-align:center">
			Pour obtenir le fichier cds correspondant aux résultats:<br><br>
			<form action="sortiecds.php" method="post">
				<?php
				echo "<input type='hidden' name='my_form_data' value='".htmlspecialchars(serialize($array_id))."'>";
				?>
            	<input type="submit" value="cds">
            </form>
			Pour obtenir le fichier pep correspondant aux résultats:<br><br>
			<form action="sortiepep.php" method="post">
				<?php
				echo "<input type='hidden' name='my_form_data' value='".htmlspecialchars(serialize($array_id))."'>";
				?>
            	<input type="submit" value="pep">
            </form>
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
