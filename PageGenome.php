<!DOCTYPE html>

<html lang="fr">



  <head>
  <meta charset="utf-8" />
        <title>Page Génome</title>
        <link rel="stylesheet" type="text/css" href="./PageAnnotation.css">
  </head>

   <body>
  <p> Génome ASM744v1 </p1>
<?php  $seq = "TCTGTCACAGCTCGACAATCTCTTTGCCGCGCGTGTGGCGAAGGCCCGTGATGAAGGAAAAGTTTTGCGCTATGTTGGCAATATTGATGAAGATGGCGTCTGCCGCGTG
AAGATTGCCGAAGTGGATAGTAATGATCCGCTGTTCAAAGTGAAAAATGGCGAAAACGCCCTGGCCTTCTATAGCCACT
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
    <td colspan="2" style= "text-align:center" > Informations générales
    </td>
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
</div> <br><br>
<div id = "textFentre">
<br> 

<!-- textarea ne permet pas de colorer la sous sequence  -->

<?php
$a='';
$b='';
$c='';
if ( strlen($seq) > ($_GET["fin"] - $_GET["debut"]) ) {
	for ($i = 0; $i <= strlen($seq); $i++) {
                if ($i < $_GET["debut"]) {
			$a .= $seq[$i]; }
		if ( ($i >= $_GET["debut"]) && ($i <= $_GET["fin"]) ) {
			$b .= $seq[$i];
		} else {
			$c .= $seq[$i]; 
		}	
	 }
}  
?>
<p1> <?php echo "$a"?> </p1>
<p2 style="color : #336600; text-decoration-line: underline"> <?php echo "$b"?> </p2>
<p3> <?php echo "$c" ?> </p3>
	
</div>




    </body>

<a href="./test.html"> Retour à l'accueil </a> <br>


</html>

