
<!DOCTYPE html>

<?php
   # connexion à la base : affiche "connection failed" si pas de connection
   # remplir user= password= sans espace
   $db = pg_connect( "host=localhost dbname=genegate port=5432  user=_____  password=_____ "  ) or die('connection failed');
?>


<?php
//Pour chaque fichier 
$fasta_files = ['Escherichia_coli_cft073_cds.fa', 'Escherichia_coli_o157_h7_str_edl933_cds.fa','Escherichia_coli_str_k_12_substr_mg1655_cds.fa'];
foreach($fasta_files as $fasta_file){
   //Ouverture du fichier
   $lines = file($fasta_file) or die("Unable to open file!");
   $seq = '';
   //Parcours du fichier
   foreach ($lines as $line) { //On parcourt ligne par ligne
      $bool_chevron = strpos($line, '>'); //Recherche du chevron qui caracterise le debut d'une ligne d'information dans un fichier fasta
      if ($bool_chevron !== false) { //Si le chevron a ete trouve
         //ajouter dans sql le cds precedent
         if (strlen($seq) > 0) {
            //mettre la bonne requete sql + les trucs pour se connecter
            $query_sql = pg_query($db,"INSERT INTO genegate.transcrit (idSeq,nomGene,nomProt,fonction,seqNt,seqProt,pos_debut,pos_fin,taille_transcrit,biotypeGene,biotypeTranscrit,annotee,idGenome) VALUES ('$id_cds','$id_gene',NULL,'$description','$seq',NULL,'$pos_deb','$pos_fin','$taille','$biotype_gene','$biotype_transcript',1,'$id_chr')") or die ('Erreur connexion'. pg_last_error($db)); 
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
            $taille = $pos_fin - $pos_deb;
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
}

pg_close($db);

?>


<html lang="fr">


   <head>
      <meta charset="utf-8" />
      <title>Lien Transcrit</title>
   </head>

   <body>
      <br>
      Supprimer ce qui suis si tout marche :
      Petit test pour voir si ça parse (qq info de la derniere cds) <br>
      CDS <?php echo $id_cds;?> <br>
      Position de fin <?php echo $pos_fin;?> <br>
      Description <?php echo $description;?> <br>
   </body>

    

</html>

