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
        
        </div>
        <div style="text-align:center">  
        <?php
            //Recuperation des informations
            $id_utilisateur = $_SESSION['username'];
            $timestamp = time();
            $datetime = date("m-d-Y H:i:s",$timestamp);
			$ForumSujet = $_GET['Titre'];
            //Insertion du nouveau sujet dans la base
            $res = pg_query($db,"INSERT INTO genegate.forum(idSujet,sujet,dateCreation,nomAnnot) VALUES(DEFAULT,'$ForumSujet','$datetime','$id_utilisateur') RETURNING idSujet;");
			echo pg_last_error($db);
			//Acces au sujet du createur
			$row = pg_fetch_row($res);
			$id_Sujet = $row['0'];
			//echo $id_Sujet;
			pg_query($db, "INSERT INTO genegate.accessujet (nomAnnot, idSujet) VALUES ('$id_utilisateur','$id_Sujet');");
            echo pg_last_error($db);
			//Donner l'acces aux amis
			$amis = $_GET['amis'];
			echo "Les personnes suivantes ont acces au sujet : <br>";
			foreach ($amis as $personne){ 
    			echo $personne."<br />";
				if($personne != $id_utilisateur){
					pg_query($db, "INSERT INTO genegate.accessujet (nomAnnot, idSujet) VALUES ('$personne','$id_Sujet');");
					echo pg_last_error($db);
				}
			}
            //Deconnexion
            pg_close($db);
            echo "Votre sujet a bien été créé.";
            echo "<a  href='ForumSujets.php'>  Retour au forum</a> ";
                    
        ?>
         </div> 
    </body>

    <div class ="bottombar">
        <li><a href="plan.php"> Plan du Site  </a> </li>
        <li><a href="policy.php"> Conditions  </a> </li>
        <li><a href="aboutUs.php"> Qui sommes nous ? </a> </li>
        <li><a href="Contact.php"> Nous contacter </a></li> 
    </div> 


    <div id = "footer"> 
        © 2020 GeneGATE
    </div> 

</html>
