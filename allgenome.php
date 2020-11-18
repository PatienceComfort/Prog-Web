<!DOCTYPE html>
<?php

# connexion à la base : affiche "connection failed" si pas de connection
# remplir user= password= sans espace
$db = pg_connect( "host=localhost dbname=genegate port=5432  user=_____  password=_____ "  ) or die('connection failed');

$fasta='Escherichia_coli_o157_h7_str_edl933.fa';
$txt_file = file_get_contents($fasta); //Accès au contenu
$rows = explode(">", $txt_file); //Split en fonction ">" 

foreach ($rows as $row) {
   $line = explode("REF", $row); //Split les lignes en fonction du séparateur "REF"
   $id = $line[0];
   $seq = $line[1];
}
$taille = strlen($seq);



# Parser le nom du fichier pour avoir la souche, le genre et l'espèce 
$s=''; 
$nom = explode("_",$fasta); # nom est separé en fonction "_", et est mis dans un tableau = l'item 0:genre, 1:espèce et le reste:souche,
for ($j=2; $j<20;$j++) { #le nom de la souche peut etre plus ou moins long donc on met max à 20 pour les concaténations
	$s .= $nom[$j];
}

$souche = preg_replace('"\.fa$"', ' ', $s); # on enlève l'extention .fa du nom de la souche
echo $souche;

$id=7; # id genome ==> essayer de mettre un id plus spécifique et à incrementer automatiquement

# mettre dans la table le bon fichier
$query = pg_query($db,"INSERT INTO genegate.genome (idgenome,genre,espece,souche,genomecomplet,taille) VALUES ('$id','$nom[0]','$nom[1]','$souche','$seq',$taille)") or die ('Erreur connexion'. pg_last_error($db)); 


# afficher toutes les lignes de la table Genome sauf sequence car trop long
$echo = pg_query($db, " SELECT  *  FROM genegate.genome;");
while ($row = pg_fetch_assoc($echo) ){
echo   "<br><tr>
            <td>".$row['idgenome']."</td>
	    <td>".$row['genre']."</td>
	    <td>".$row['espece']."</td>
	    <td>".$row['souche']."</td>
	    <td>".$row['taille']."</td>
		
        </tr>";
}

pg_close($db);

?>

</html>

# Comentaires :
# Pour parser l'ensemble des fichiers : foreach (glob("*.fa") as $file) : 
# faire des boucles avec conditions : for  if file == '*cds.fa' { ... }  else if file == '*.pep.fa' {...}  else {...} ?
# dans chacune de ces boucles ==> mettre un id incrementé automatiquement à chaque tour de boucle.
