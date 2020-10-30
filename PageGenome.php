<!DOCTYPE html>

<html lang="fr">



  <head>
  <meta charset="utf-8" />
        <title>Page Génome</title>
        <link rel="stylesheet" type="text/css" href="./PageGenome.css">
  </head>

   <body>
  <p> Génome ASM744v1 </p1>
<?php  $seq = "TCTGTCACAGCTCGACAATCTCTTTGCCGCGCGTGTGGCGAAGGCCCGTGATGAAGGAAAAGTTTTGCGCTATGTTGGCAATATTGATGAAGAT
GGCGTCTGCCGCGTGAAGATTGCCGAAGTGGATAGTAATGATCCGCTGTTCAAAGTGAAAAATGGCGAAAACGCCCTGGCCTTCTATAGCCACT
ATTATCAGCCGCTGCCGTTGGTACTGCGCGGATATGGTGCGGGCAATGACGTTACAGCTGCCGGTGTCTTTGCTGATCTGCTAGTGTTCTACAGA
GAGAAGCGTAGAGCAATAGGCTGTATTTTGAGAAAGCTGTGTGAGTGGAAAAGTGTACGGATTCTGGAAGCTGAATGCTGTGCAGATCATATC
CATATGCTTGTGGAGATCCCGCCCAAAATGAGCGTATCAGGCTTTATGGGATATCTGAAAGGGAAAAGCAGTCTGATGCCTTACGAGCAGTTTG
GTGATTTGAAATTCAAATACAGGAACAGGGAGTTCTGGTGCAGAGGGTATTACGTCGATACGGTGGGTAAGAACACGGCGAAGATACAGGATT
ACATAAAGCACCAGCTTGAAGAGGATAAAATGGGAGAGCAGTTATCGATTCCCTATCCGGGCAGCCCGTTTACGGGCCGTAAGTAAATTACTAC
CATCAGTTGCGTTATGCGGCGGAAAAATCGCGGCGTAAATTCCTCTATGACACCAACGTTGGGGCTGGATTACCGGTTATCGAGAACCTGCAAA
ATCTGCTCAATGCTGGTGATGAATTGATGAAGTTCTCCGGCATTCTTTCAGGTTCGCTTTCTTATATCTTCGGCAAGTTAGACGAAGGCATGAGTT
TCTCCGAGGCGACCACACTGGCGCGGGAAATGGGTTATACCGAACCGGACCCGCGAGATGATCTTTCTGGTATGGATGTGGCGCGTAAGCTATT
GA" 

?>

<table style="width:60%"; >
  <th>
  Informations générales <!-- Regler la longueur de la premiere case -->
  </th>
  <tr>
      <th>Genome ID</th>
      <td>ASM744v1</td>
  </tr>
   <tr>
      <th>Taille</th>
      <td>5231428 pb</td>
   </tr>
   <tr>
      <th> Genre </th>
      <td> Escherichia </td>
   </tr>
   <tr>
      <th> Espece </th>
      <td> Coli </td>
   </tr>
   <tr>
      <th> Souche </th>
      <td> cft073 </td>
   </tr>
  
    
</table> <br><br><br>

<div id = "fenetre">
<thread> Fenetre des Positions  <br> </thread>

<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="get">
      <input type="number" name="debut" rows="1" cols="3" value="<?php echo $_GET["debut"];?>"> 
      <input type="number" name="fin" rows="1" cols="3" value="<?php echo $_GET["fin"];?>"> 
      <input type="submit" value="Show">
</form>

<br>
<!-- Ajouter une couleur à  la sous séquence choisit -->  
<!-- CSS : scrollbar, borderwith  du textarea --> 
<textarea name="seq" rows="5" cols="80"  >

<?php

if ( strlen($seq) > ($_GET["fin"] - $_GET["debut"]) ) {
	for ($i = 0; $i <= strlen($seq); $i++) {
		if ( ($i > $_GET["debut"]) && ($i < $_GET["fin"]) ) {
			echo '<div id="style">'.$seq[$i].'</div>';
		} else {
			echo $seq[$i]; 
		}
		
	 }
}  
?>
	
</textarea> <br><br><br>
</div>
    <a href="./test.html">Retour à l'accueil</a>

          
    </body>

</html>

