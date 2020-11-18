<!DOCTYPE html>
<?php

# connexion à la base : affiche "connection failed" si pas de connection
# remplir user= password= sans espace
$db = pg_connect( "host=localhost dbname=genegate port=5432  user=  password="  ) or die('connection failed');
	

$i=0;
# stocker le fichier fasta, affiche "Unable to open file!" sinon
$lines = file('./Escherichia_coli_cft073.fa') or die("Unable to open file!");
$seq="";
foreach ($lines as $line) {
	if ($i == 0) {
	$id = $line; # la première ligne du fichier fasta
	} else { 
           $seq .= $line;   # concatène la séquence
	   $i=$i+1; 
	}
            
}
echo $seq;

# inserer une nouvelle valeur à la table
$query = pg_query($db,"INSERT INTO genome VALUES ('1234','Esch','Coli','K12','seq','9');");
if ($query) {
    echo "Values inserted successfully in the table seqs\n";
} else {
    echo "Error inserting values ";
}


# afficher la ligne genome id de la table Genome
$echo = pg_query($db, " SELECT  *  FROM genegate.genome;");
while ($row = pg_fetch_assoc($echo) ){
echo   "<br><tr>
            <td>".$row['idgenome']."</td>
        </tr>";
}


pg_close($db);

?>

</html>
