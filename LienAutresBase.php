
<!DOCTYPE html>

<?php
//Information du transcrit
//$transcrit = "AAN78501";
$transcrit = "AAC73132";
//$transcrit = "AAG59303";


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


<html lang="fr">


   <head>
      <meta charset="utf-8" />
      <title>Lien Transcrit</title>
   </head>

   <body>
      Fiches Références : <br>
      <form action = <?php echo $url_uniprot;?>>
         <input  type="submit" class="btn"  style="background-color: #606162" value="Uniprot" /> <br>
      </form> <br>
      <form action = <?php echo $url_pfam;?>> 
         <input type="submit" class="btn" style="background-color: #606162" value="PFAM" /> <br>
      </form> <br>
      <form action = <?php echo $url_ensembl;?>>
         <input type="submit" class="btn" style="background-color: #606162" value="EnsemblBateria" /> <br>
      </form> <br>
      </button>
      Si l'un des boutons ne fonctionne pas, copiez-collez les urls suivantes dans votre naviguateur <br>
      <?php echo $url_uniprot;?> <br>
      <?php echo $url_pfam;?> <br>
      <?php echo $url_ensembl;?> <br>
   </body>

    

</html>

