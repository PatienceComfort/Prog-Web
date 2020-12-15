<!DOCTYPE html>
<?php session_start(); 
include 'connect_db.php';
?>
<html>

  <head>

  <meta charset="utf-8" />
        <title> Genegate</title>  
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

	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br> </div>

  
   	<div="resultats">
      <table> <br><br>

	 <th td colspan ="5"> Utilisateurs à valider </th>
        <tr>
          <td>Username</td>
          <td>email</td>
          <td>Role demandé</td>
          <td>Valider</td>
          <td>Supprimer</td>
        </tr> 
	</div>
        <?php
        echo pg_last_error($db);
        $infos = pg_query($db,"SELECT * FROM genegate.utilisateur WHERE validation_compte='f';");
        if(pg_num_rows($infos) > 0){//S'il y a des resultats
          while ($row = pg_fetch_assoc($infos) ){ //Affichage des utilisateurs non valides
            echo "<tr><td>".$row['username']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['statut']."</td>
                      <td> <a href='validation_user.php?id=".$row['username']."'> Valider </a> </td> 
                      <td> <a href='suppression_user.php?id=".$row['username']."'> Supprimer </a> </td> 
                  </tr>";
          }
        }
        ?>

      </table><br>
      <table> <br><br>

	 <th td colspan ="5"> Utilisateurs </th>
        <tr>
          <td>Username</td>
          <td>email</td>
          <td>Role</td>
          <td>Dernière connexion</td>
          <td>Supprimer</td>
        </tr> 

        <?php
       
        $infos = pg_query($db,"SELECT * FROM genegate.utilisateur WHERE validation_compte='t';");
        if(pg_num_rows($infos) > 0){//S'il y a des resultats
          while ($row = pg_fetch_assoc($infos) ){ //Affichage des utilisateurs non valides
            echo "<tr><td>".$row['username']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['statut']."</td>
                      <td>".$row['dateconnexion']."</td> 
                      <td> <a href='suppression_user.php?id=".$row['username']."'> Supprimer </a> </td> 
                  </tr>";
          }
        }
        ?>

      </table><br>

  </body>
    
