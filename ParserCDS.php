
<!DOCTYPE html>

<?php
//Ouverture du fichier
$fasta_file = 'Escherichia_coli_cft073_cds.fa';
$lines = file($fasta_file) or die("Unable to open file!");
$seq = '';
//a faire : boucle sur tous les fichiers, bouton pour lancer le remplissage de la base ?
//Parcours du fichier
foreach ($lines as $line) { //On parcourt ligne par ligne
   $bool_chevron = strpos($line, '>'); //Recherche du chevron qui caracterise le debut d'une ligne d'information dans un fichier fasta
   if ($bool_chevron !== false) { //Si le chevron a ete trouve
      //ajouter dans sql le cds precedent
      if (strlen($seq) > 0) {
         //$sql = "INSERT INTO `seqs` (`ID`, `org_name`, `sequence`) VALUES ($id, $org_name, $value)";
         //mettre la bonne requete sql + les trucs pour se connecter
         echo "Insertion SQL \n";
      }
      $seq = ''; //Re initialisation de la sequence

      //recuperation des informations du cds actuel
      $bool_gene_symbol = strpos($line, 'gene_symbol'); //Verification de la presence du champ gene_symbol
      if ($bool_gene_symbol !== false) { //Si la ligne contient gene_symbol
         $results = array();
         $test = preg_match_all('#>(.+?) cds chromosome:(.+?):Chromosome:(.+?):(.+?):(.+?) gene:(.+?) gene_biotype:(.+?) transcript_biotype:(.+?) gene_symbol:(.+?) description:(.+)#', $line, $results);
         $id_cds = $results[1][0];
         $id_chr = $results[2][0];
         $pos_deb = $results[3][0];
         $pos_fin = $results[4][0];
         $brin = $results[5][0];
         $id_gene = $results[6][0];
         $biotype_gene = $results[7][0];
         $biotype_transcript = $results[8][0];
         $gene_symbol = $results[9][0];
         $description = $results[10][0];
      }else{ //Si la ligne ne contient pas gene_symbol
         $results = array();
         $test = preg_match_all('#>(.+?) cds chromosome:(.+?):Chromosome:(.+?):(.+?):(.+?) gene:(.+?) gene_biotype:(.+?) transcript_biotype:(.+?) description:(.+)#', $line, $results);
         $id_cds = $results[1][0];
         $id_chr = $results[2][0];
         $pos_deb = $results[3][0];
         $pos_fin = $results[4][0];
         $brin = $results[5][0];
         $id_gene = $results[6][0];
         $biotype_gene = $results[7][0];
         $biotype_transcript = $results[8][0];
         $gene_symbol = '';
         $description = $results[9][0];
      }
   }else{//La ligne correspond a la sequence du CDS
      $seq = $seq.$line;
   }

}
?>


<html lang="fr">


   <head>
      <meta charset="utf-8" />
      <title>Lien Transcrit</title>
   </head>

   <body>
      <br>
      Petit test pour voir si ça parse (qq info de la derniere cds) <br>
      CDS <?php echo $id_cds;?> <br>
      Position de fin <?php echo $pos_fin;?> <br>
      Description <?php echo $description;?> <br>
   </body>

    

</html>

