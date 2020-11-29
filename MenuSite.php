<!DOCTYPE html>

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
  	<li><a href="MenuSite.php">Home</a></li>
  	<li><a href="#"> Access Forum</a></li>
  	<li><a href="YourAccount.html"> Your Account </a></li>
  	<li><a href="Contact.html"> Contact </a></li>
	<div id ="menu2"> 
	<button type="button" onclick = "location.href = 'connexion.php'" name="button"> Se connecter </button>
	<button type="button" onclick = "location.href = 'inscriptionUti.php'" name="button"> S'inscrire </button>
	</div> 	
	</div>


	<div class="sidenav"> <br>
		
		
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://i2.wp.com/bioinfo-fr.net/wp-content/uploads/2012/05/INSL5.png?ssl=1" height="70" width="115"><br> Sequences </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Genomes </button> <br>
		
		<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="http://ugene.unipro.ru/wp-content/uploads/2015/03/55.png" height="70" width="115""><br> Alignement </button> <br>
		
		<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://avatars1.githubusercontent.com/u/9991058?s=280&v=4" height="70" width="115"><br> Uniprot </button> <br>

		<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://img.favpng.com/25/4/15/human-genome-project-ensembl-genomes-vertebrate-png-favpng-hEkxiJ3p9xdYChKT41UQ9M9TN.jpg" height="70" width="115" ><br> Ensembl </button> <br>

				<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Pfam_logo.gif" height="70" width="115"><br> PFAM </button> <br>
  
	</div>


	<div id ="searchSeq">
	<h3> Rechercher une séquence </h3>
	<form>

	Sequence ID :
​	<textarea id="txtArea" rows="1" cols="10" id="query" placeholder = "Search.."> </textarea> <br><br>
		
	Séquence : <br>
​	<textarea id="txtArea" rows="7" cols="60" id="query" placeholder = "Search.."> </textarea> <br><br>
 		
	Type :
 	<select> 
  	<option value="nucl"> Nucléotique </option>
  	<option value="2"> Proteique </option>
	</select> <br><br>

	<input type="submit" value="Rechercher" /> </button> <br>
	</form>
	</div>

	<div id= "searchGenome" >

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
​		<textarea id="txtArea" rows="10" cols="60" id="query" placeholder = "Search.."> </textarea> <br><br>

		<input type="submit" value="Rechercher" /> </button> <br>

	        <?php 
					if(isset($_GET['erreur'])){
        	$err = $_GET['erreur'];
          if($err==1 )
          echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>"; } 
				?>

		</form>
	</div>

	<div id ="startAnnot">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="./exemple.png" height="110" width="160"><br> Annoter une Séquence </button> <br>
	</div>
	<div id ="accederCompte">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://cdn.onlinewebfonts.com/svg/img_215060.png" height="110" width="160"><br> Acceder à mon compte </button> <br>
	</div>

	<div id ="accederForum">	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="https://png.pngtree.com/png-vector/20190129/ourlarge/pngtree-message-vector-icon-png-image_355784.jpg" height="110" width="160"><br> Acceder au Forum </button> <br>
	</div>

	<div class ="bottombar">
  		<li><a href="plan.html"> Plan du Site  </a> </li>
  		<li><a href="policy.html"> Conditions  </a> </li>
  		<li><a href="About us.html"> Qui sommes nous ? </a> </li>
  		<li><a href="Contact.html"> Nous contacter </a></li> 
	</div> 


	<div id = "footer"> 
		© 2020 GeneGATE
	</div> 

  </body>


</html>

