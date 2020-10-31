<!DOCTYPE html>

<html lang="fr">



  <head>
  <meta charset="utf-8" />
        <title>Page Transcrit</title>
        <link rel="stylesheet" type="text/css" href="./PageAnnotation.css">
  </head>

   <body>

<?php  $seqProt = "MFYREKRRAIGCILRKLCEWKSVRILEAECCADHIHMLVEIPPKMSVSGFMGYLKGKSSLMPYEQFGDLKFKYRNREFWCRGYYVDTVGKNTAKIQDYIKHQLEEDKMGEQ LSIPYPGSPFTGRK";
?>
<?php
$seqNc = "GTGTTCTACAGAGAGAAGCGTAGAGCAATAGGCTGTATTTTGAGAAAGCTGTGTGAGTGGAAAAGTGTACGGATTCTGGAAGCTGAATGCTGTGCAGATCATATCCATATGCTTGTGGAGATCCCGCCCAAAATGAGCGTATCAGGCTTTATGGGATATCTGAAAGGGAAAAGCAGTCTGATGCCTTACGAGCAGTTTGGTGATTTGAAATTCAAATACAGGAACAGGGAGTTCTGGTGCAGAGGGTATTACGTCGATACGGTGGGTAAGAACACGGCGAAGATACAGGATTACATAAAGCACC"
; ?>
 <p> Transcrit AAN78502 <p> <br>
<div id = "elem1" >
<table style="width:40%"; >

  
         <td colspan="2"> Informations générales
         </td>
 
  
  <tr>
      <th>Description</th>
      <td>Hypothetical protein</td>
  </tr>
   <tr>
      <th>Nom du gène</th>
      <td>c0002</td>
   </tr>
   <tr>
      <th> Abréviation du gène </th>
      <td> Non Existante </td>
   </tr>
   <tr>
      <th> Localisation </th>
      <td> 534:911:1 </td>
   </tr>
   <tr>
      <th> Biotype du gène </th>
      <td> protein_coding </td>
   </tr>
   <tr>
      <th> Biotype du transcrit </th>
      <td> protein_coding </td>
    </tr>
    <tr>
      <th> Genome ID </th>
      <td> ASM744v1 </td>
   </tr>
   </table>
</div>


<div id = "seq" >
   
   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <input type="radio" name ="rad" value= <?php echo $seqProt; ?>  > Sequence Protéique
          
          <input type="radio" name ="rad" value= <?php echo $seqNc; ?>   > Sequence Nucléotidique
          
          <input type="submit" value="OK"/>
   </form>


<textarea rows="8" cols="60">   
<?php if (isset($_POST["rad"]) != '') {  
     if (isset($_POST["rad"]) == "nucl") { echo $_POST["rad"];
       } elseif (isset($_POST["rad"]) == "prot") { 
	        echo $_POST["rad"];
	}
} 
?> 
</textarea>  
</div>

  <div id = "blast">
  Alignement de sequence contre la base nr <br> (Paramètres BLAST: par défaut)
  <form action ="https://blast.ncbi.nlm.nih.gov/Blast.cgi">
    <input type="submit" class = "btn"  style="color:black; border-color:#018FD1; border-radius:15px;"
 value="BLAST" /> 
    </form>
 
  </div>
  
  <div id = "img">
  <div class="topleft" style = "text-decoration-line: underline"> Localisation sur le génome ASM744v1 </div> 
  <img src="./image.png"  width="250" height="250" /> 
  </div>

    
    <div id = "Database">
     Fiches Références : 
    <form action ="https://www.uniprot.org/">
    <input  type="submit" class="btn"  style="background-color: #606162" value="Uniprot" /> <br>
    </form> <br>
  <form action ="https://pfam.xfam.org/"> 
    <input type="submit" class="btn" style="background-color: #606162" value="PFAM" /> <br>
    </form> <br>
   <form action ="https://www.ensembl.org/index.html">
    <input type="submit" class="btn" style="background-color: #606162" value="EnsemblBateria" /> 
    </form> <br>
    </button>
    </div>

    </body>

    <a href="./test.html"> Retour à l'accueil </a>
    

</html>

