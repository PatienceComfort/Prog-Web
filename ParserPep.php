<!DOCTYPE html>

<?php
   # connexion à la base : affiche "connection failed" si pas de connection
   # remplir user= password= sans espace
   $db = pg_connect( "host=localhost dbname=genegate port=5432  user=_____  password=_____ "  ) or die('connection failed');
?>

<?php
//Pour chaque fichier 
$fasta_files = ['Escherichia_coli_cft073_pep.fa', 'Escherichia_coli_o157_h7_str_edl933_pep.fa','Escherichia_coli_str_k_12_substr_mg1655_pep.fa', 'new_coli_pep.fa'];
foreach($fasta_files as $fasta_file){
   //Ouverture du fichier
   $lines = file($fasta_file) or die("Unable to open file!");
   $seq = '';
   //Parcours du fichier
   foreach ($lines as $line) { //On parcourt ligne par ligne
      $bool_chevron = strpos($line, '>'); //Recherche du chevron qui caracterise le debut d'une ligne d'information dans un fichier fasta
      if ($bool_chevron !== false) { //Si le chevron a ete trouve
         //ajouter dans sql le cds precedent
         if ((strlen($seq) > 0) &&(strlen($id_cds))) {
            $query_sql = pg_query($db,"UPDATE genome.transcrit SET seqProt = '$seq' WHERE idSeq = '$id_cds';"); 
            echo "Update SQL \n";
         }
         $seq = ''; //Re initialisation de la sequence
         //extraction de l'id_cds
         $results = array();
         $test = preg_match_all('#>(.+?) pep chromosome:#', $line, $results);
         $id_cds = $results[1][0];


      }else{//La ligne correspond a la sequence en aa
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
      Seqaa <?php echo $seq;?> <br>
   </body>

    

</html>