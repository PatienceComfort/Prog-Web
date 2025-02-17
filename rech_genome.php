<!DOCTYPE html>
<?php
   # connexion à la base : affiche "connection failed" si pas de connection
   include 'connect_db.php';
	 session_start();
?>
<html lang="fr">

  <head>
  	<meta charset="utf-8" />
  	<title>Genegate</title>  
		<link rel="stylesheet" type="text/css" href="style1.css">
		<div id="header"> <br>
	<h> GeneGATE </h> <br><br>					
		</div>
  </head>

  <body>
	<div id ="menu"> 
  		<?php if ( $_SESSION['statut'] == 'Annotateur') {
          	 $menu='MenuA.php'; 
	} else if ( $_SESSION['statut'] == 'Validateur') {      	 
		$menu='MenuV.php'; 
	} else {
		$menu='MenuL.php'; 
	}?>

  	<li><a href="<?php echo $menu ?>">Home</a></li>
  	<li><a href="ForumSujets.php"> Access Forum</a></li>
  	<li><a href="utilisateur.php"> Your Account </a></li>
  	<li><a href="Contact.php"> Contact </a></li>		
	</div>
	
	<div class="sidenav"> <br>
		<button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.flaticon.com/svg/static/icons/svg/1198/1198618.svg" height="70" width="115"><br> Rechercher séquence </button> <br>

		<button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.flaticon.com/svg/static/icons/svg/1198/1198618.svg" height="70" width="115"><br> Rechercher génome </button> <br>

		<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Transcrit </button> <br>

		<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>
	</div>

<table style='width:40%';>
	<div id="pageresults">
	<h2> Résultats :</h2>
<?php
	
	// on regarde quels informations sont rentrées par l'utilisateur
	$query_sql = "";
	$info_formulaire = ["id","query","souche","espece","genre"];
	$col_table = ["idgenome","genomecomplet","souche","espece","genre"];
	for ($i = 0; $i <= 4; $i++) { //Pour chaque champ du formulaire
		$ch = $info_formulaire[$i];
		$col = $col_table[$i];
		if (!empty($_POST[$ch])){ //Si la champ est rempli
			if (strlen($query_sql) > 5){//Si la requete n'est pas vide
				if($ch != "query"){
					$query_sql .= "AND ".$col."='".$_POST[$ch]."'";
				}else{
					$query_sql .= "AND ".$col." LIKE '%".$_POST[$ch]."%' ";
				}
				
			}else{ // Si la requete est vide
				if($ch != "query"){
					$query_sql .= "SELECT * FROM genegate.genome WHERE ".$col."='".$_POST[$ch]."'";
				}else{
					$query_sql .= "SELECT * FROM genegate.genome WHERE ".$col." LIKE '%".$_POST[$ch]."%' ";
					
				}
				
			}
		}
	}
	if(strlen($query_sql) > 5){ //Si la requete n'est pas vide
		$query_sql .= ";";
		$res = pg_query($db,$query_sql);
	}
	
	if (!$res) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	if(pg_num_rows($res) == 0) { // si 0 resultats alors on affiche toute la base
		$res2 = pg_query($db,"SELECT * FROM genegate.genome ;");
		echo " <div style='font-size:150%'> Aucun résultat </div> <br> <br> <br>";
		echo " <td colspan='5'> ID Genre Espece Souche </td>";
		while ($row = pg_fetch_assoc($res2) ){
		echo "<div style='font-size:110%'> 
		<br><tr>
            	<td> <a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a> </td> 
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
       		</tr> </div>";
		
		}
	}
	
	if(pg_num_rows($res) != 0) { //Affichage de tous les resultats
		$array_id = array();
		echo " <td colspan='5'> ID Genre Espece Souche </td>";
		while ($row = pg_fetch_assoc($res) ){
		echo "<br><tr>
            	<td> <a href='fiche.php?id=".$row['idgenome']."'> ".$row['idgenome']."</a> </td>  
	    	<td>".$row['genre']."</td>
	    	<td>".$row['espece']."</td>
	    	<td>".$row['souche']."</td>
       		</tr>";
		$array_id[] = $row['idgenome'];
		
		} // l'identifiant renvoie vers le lien de la fiche ==> ?id= dans l'url : sert à retrouver l'id et sert à partir d'une page fiche.php afficher toutes les résultats/génome que l'utilisateur veut voir.

	}

pg_close($db);
?>



</table>
</div>

<div style="text-align:center">
			Pour obtenir le fichier fasta correspondant aux résultats:<br><br>
			<form action="sortiefa.php" method="post">
				<?php
				echo "<input type='hidden' name='my_form_data' value='".htmlspecialchars(serialize($array_id))."'>";
				?>
            	<input type="submit" value="fasta">
            </form>
</div> 

</body>

	<div class ="bottombar">
  		<li><a href="plan.php"> Plan du Site  </a> </li>
  		<li><a href="policy.php"> Conditions  </a> </li>
  		<li><a href="About us.php"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.php"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		© 2020 GeneGATE
	</div> 





</html>
