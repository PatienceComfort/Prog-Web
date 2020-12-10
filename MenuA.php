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
	<div id="searchbar">
	<form id="form"> 
  		<input type="search" id="query" placeholder = "Search..">
  		<button text-align = "center"> Rechercher </button>
  	</form>
	</div>


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

	<div id="user">
	<?php echo Bonjour, $_SESSION['username']?>
	</div>
	<div class="sidenav"> <br>

		
	<button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher séquence </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher génome </button> <br>
	
	<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://i2.wp.com/bioinfo-fr.net/wp-content/uploads/2012/05/INSL5.png?ssl=1" height="70" width="115"><br> Base Nucléotidique </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Proteique </button> <br>
	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>	

  
	</div>
	
  
	</div>


	<div id ="searchSeq">
	<form action="rech_sequence.php" method="POST">
	<h3> Rechercher une séquence </h3>
	<form>

	Sequence ID :
​	<input type="text" placeholder="ID" name="id_seq" >  <br><br>

	Génome ID :
	<input type="text" placeholder="ID" name="id_genome" >

	Genre : 
	<input type="text" placeholder="Genre" name="genre" > <br><br>
	
	Espèce :
	<input type="text" placeholder="Espèce" name="espece" >

	Souche :
	<input type="text" placeholder="Souche" name="souche" > <br><br>

	Séquence nulcéotidique (motif...) : <br>
​	<textarea id="txtArea" rows="10" cols="60" name="query_nuc" placeholder = "Search.."> </textarea> <br><br>
 	
	Séquence protéique (motif...) : <br>
​	<textarea id="txtArea" rows="10" cols="60" name="query_prot" placeholder = "Search.."> </textarea> <br><br>

	Taille du transcrit :
	<input type="text" placeholder="taille" name="taille" > <br><br>
	Position de début :
	<input type="text" placeholder="début" name="debut" > <br><br>
	Position de fin :
	<input type="text" placeholder="fin" name="fin" > <br><br>
	
	Nom du gène :
	<input type="text" placeholder="gène" name="nomgene" > <br><br>
	Biotype du gène :
	<input type="text" placeholder="biotype" name="biotypegene" > <br><br>
	Biotype du transcrit :
	<input type="text" placeholder="biotype" name="biotypetranscrit" > <br><br>
	Fonction :
	<input type="text" placeholder="mot-clé" name="fonction" > <br><br>
 		


	<input type="submit" value="Rechercher" /> </button> <br>
	</form>
	</div>

	<div id= "searchGenome">

	        <?php echo $_SESSION['user'] ?>

		<form action="rech_genome.php" method="POST">
		<h3> Rechercher un génome </h3>

		Génome ID :
		<input type="text" placeholder="ID" name="id" >

		Genre : 
		<input type="text" placeholder="Genre" name="genre" > <br><br>
		
		Espèce :
		<input type="text" placeholder="Espèce" name="espece" >

		Souche :
		<input type="text" placeholder="Souche" name="souche" > <br><br>

		Séquence génome : <br>
​		<textarea id="txtArea" rows="10" cols="60" name="query" placeholder = "Search.."> </textarea> <br><br>

		<input type="submit" value="Rechercher" /> </button> <br>

	        <?php 
					if(isset($_GET['erreur'])){
        	$err = $_GET['erreur'];
          if($err==1 )
          echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>"; } 
				?>

		</form>
	</div>

	<div id ="accederCompte">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://png.pngtree.com/png-vector/20190615/ourlarge/pngtree-folderfiledatastorage-business-logo-template--flat-color-png-image_1486788.jpg" height="110" width="160"><br> Acceder à mon compte </button> <br>
	</div>

	<div id ="accederForum">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://www.mindnews.fr/files/images/Images%20de%20production/Photos%20th%C3%A9matiques/_cropthumbs/commentaires%20chat%20forums%20OK-350x220.jpg?v=YgMnXZ26jNq2qNCuqq19FpgkbW5eNthZ2KCSUgjKrLQ" height="110" width="160"><br> Acceder au Forum </button> <br>
	</div>

	<div id ="startAnnot">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/97/LambdaPhage_Genome_Linear.jpg/800px-LambdaPhage_Genome_Linear.jpg" height="110" width="160"><br> Annoter une Séquence </button> <br>
	</div >

	<div class ="bottombar">
 		<li><a href="plan.php"> Plan du Site  </a> </li>
  		<li><a href="policy.php"> Conditions  </a> </li>
  		<li><a href="About us.php"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.php"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		©2020 GeneGATE
	</div> 


  </body>
	

</html>

