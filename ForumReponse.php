<!DOCTYPE html>
<?php session_start(); ?>
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
            <li><a href="#"> Access Forum</a></li>
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
        <?php
        //Recuperation de l'id du sujet
                $str=$_SERVER['REQUEST_URI']; 
	            $keywords = preg_split("/=/", $str);
                $id_sujet = $keywords[1]; // id sujet recupéré de l'url
        ?>
        <!-- Formulaire d'ecriture de la reponse -->
        <form action="reponse_form.php" method="POST">
            <input type="txtArea" id="rep" placeholder = "Ecrire ici votre réponse.."> </textarea> <br><br>
            <input type="submit" value="Rechercher" /> </button> <br>
            <input type=hidden id="variableAPasser" value=<?php echo $id_sujet; ?>/>
        </form>