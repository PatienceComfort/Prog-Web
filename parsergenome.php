<?php

   $db = pg_connect( "host=localhost dbname=genegate port=5432  user=abirami  password=16011996 "  ) or die('connection failed');

## Connexion à la base de données
$fasta_files = ['Escherichia_coli_cft073.fa', 'Escherichia_coli_o157_h7_str_edl933.fa','Escherichia_coli_str_k_12_substr_mg1655.fa','new_coli.fa'];

foreach($fasta_files as $fasta){

	$txt_file = file_get_contents($fasta); //Accès au contenu
	$rows = explode(">", $txt_file); //Split en fonction ">" 
	foreach ($rows as $row) {
   		$line = explode("REF", $row); //Split les lignes en fonction du séparateur "REF" pour récupérer la sequence et l'identifiant du génome
   		$seq = $line[1]; // Séquence du génome

		$results = array();
		$test = preg_match_all('#chromosome:(.+?):Chromosome#', $line[0], $results); 
		$id = $results[1][0]; // id de génome
	}

	$taille = strlen($seq); // taille de génome
	
	// on récupère le nom du Genre, de l'Espèce et de la Souche à partir du nom du fichier
	$nom = explode("_",$fasta);

	if  (sizeof($nom) > 2) {
		$genre=$nom[0]; // Genre
		$espece=$nom[1]; // Espèce
		$s=""; 
		$souche=""; // Souche
		for ($j=2; $j<sizeof($nom); $j++) { 
			$s.=$nom[$j]."_";

		}
		$souche = preg_replace('"\.fa_$"','', $s);
		} else {

	// pour la souche new coli : les noms ne sont pas spécifiés
			$genre =$nom[0];
			$espece = $nom[1];
			$souche= $nom[1];
		}

	$query = pg_query($db,"INSERT INTO genegate.genome (idgenome,genre,espece,souche,genomecomplet,taille) VALUES 			('$id','$genre','$espece','$souche','$seq',$taille)") or die (pg_last_error($db)); 

	}
	
?>



