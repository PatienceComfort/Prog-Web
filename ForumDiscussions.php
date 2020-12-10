<!DOCTYPE html>
<?php session_start();?>
<html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Website Style</title>  
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

            <button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher séquence </button> <br>
            <button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher génome </button> <br>
            <button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="http://ugene.unipro.ru/wp-content/uploads/2015/03/55.png" height="70" width="115""><br> Alignement </button> <br>
            <button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://i2.wp.com/bioinfo-fr.net/wp-content/uploads/2012/05/INSL5.png?ssl=1" height="70" width="115"><br> Base Nucléotidique </button> <br>
            <button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Proteique </button> <br>
            <button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>
        
	    </div>

        <table style='width:40%';>
	        <div id="pageresults">
	            <h2> Discussion :</h2>
                <?php
                //Connexion a la base de donnee
                //$db = pg_connect( "host=localhost port=5432 dbname=genegate user=abirami password=16011996"  );
                $db = pg_connect( "host=localhost dbname=romane user=romane");
                if(!$db) {      
                    echo "Error : Unable to open database\n";
                }
                //Recuperation de l'id du sujet
                $str=$_SERVER['REQUEST_URI'];
	            $keywords = preg_split("/=/", $str);
	            $id_sujet = $keywords[1]; // id sujet recupéré de l'url
                //Requete sql pour savoir quelles reponses affichees
                $res = pg_query($db,"SELECT reponse.dateReponse, reponse.nomAnnot, reponse.response FROM genegate.reponse WHERE reponse.idSujet = '".$id_sujet."' ORDER BY reponse.dateReponse ASC;");
                if (!$res) {
                    echo "Une erreur s'est produite.<br>";
                    exit;
                }
                //Si aucun resulat
                if(pg_num_rows($res) == 0) {
                    echo "Aucune discussion a afficher.<br>";
                }
                //Si il y a des discussions a afficher
                if(pg_num_rows($res) != 0) {
                    $flag = 0;
                    while ($row = pg_fetch_assoc($res) ){
                        if($flag == 0){
                            echo "<br><tr>
                                <tr><td>Date de Réponse</td>
                                    <td>Identifiant de l'Annotateur</td>
                                    <td>Reponse</td>
                                </tr>
                                <tr>
                                    <td>".$row['datereponse']."</a> </td>  
                                    <td>".$row['nomannot']."</td>
                                    <td>".$row['response']."</td>
                                </tr>";
                            $flag = 1;
                        }else{
                            echo "<br><tr>
                                <td>".$row['datereponse']."</a> </td>  
                                <td>".$row['nomannot']."</td>
                                <td>".$row['response']."</td>
                                </tr>";
                        }
                        
                    
                    }
                }
                //Deconnexion
                pg_close($db);
                ?>
        </table>
            </div>
        
         <div style="text-align:center">  
            <form action="reponse_form.php" method="get">
                <input type="hidden" name="idSujet" value=<?php echo $id_sujet; ?>>
                Votre reponse <input type="text" name="rep"><br>
            <input type="submit">
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
