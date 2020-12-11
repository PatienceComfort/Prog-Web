<!DOCTYPE html>
<?php session_start();
include 'connect_db.php';
?>
<html lang="fr">

  <head>

  <meta charset="utf-8" />
        <title>Genegate</title>  
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

	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>
	</div>

	<div style="text-align:center">
	<?php
		if (!empty($_POST['my_form_data'])){
			$id_a_conserver = unserialize($_POST['my_form_data']);
			$flag = 0;
			$new_file = "resultcds.txt";
			file_put_contents($new_file,"MES RESULTATS\n");
			//Pour chaque fichier 
			$fasta_files = ['Escherichia_coli_cft073_cds.fa', 'Escherichia_coli_o157_h7_str_edl933_cds.fa','Escherichia_coli_str_k_12_substr_mg1655_cds.fa', 'new_coli_cds.fa'];
			foreach($fasta_files as $fasta_file){
				//Ouverture du fichier
				$lines = file($fasta_file) or die("Unable to open file!");
				//Parcours du fichier
				foreach ($lines as $line) { //On parcourt ligne par ligne
					$bool_chevron = strpos($line, '>'); //Recherche du chevron qui caracterise le debut d'une ligne d'information dans un fichier fasta
					if ($bool_chevron !== false) { //Si le chevron a ete trouve
						//extraction de l'id_cds
						$results = array();
						$test = preg_match_all('#>(.+?) cds chromosome:#', $line, $results);
						$id_cds = $results[1][0];
						//conservation de la ligne si dans bon id
						if (in_array($id_cds, $id_a_conserver)){
							$flag = 1;
							file_put_contents($new_file, $line."\n", FILE_APPEND);
						}else{
							$flag = 0;
						}
						//echo $id_cds;
					}else{//ligne de sequence
						if($flag==1){
							file_put_contents($new_file, $line."\n", FILE_APPEND);
						}
					}
				}
			}	
			echo "Fichier cds créé";
		}else{
			echo "Pas de fichier créé";
		}
		
	?>
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
