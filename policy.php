<html lang="fr">

  <head>
  <meta charset="utf-8" />
        <title>Website Style</title>  
	 <link rel="stylesheet" type="text/css" href="style1.css">
		<div id ="header"> <br> 
		<h> GENEGATE </h> <br><br>	
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
	<div id ="menu2"> 
	<button type="button" onclick = "location.href = 'connexion.php'"name="button"> Se connecter </button>
	<button type="button" onclick = "location.href = 'inscriptionUti.php'"name="button"> S'inscrire </button>
	</div> 	
	</div>


	<div class="sidenav"> <br>

		
	<button id="close-image" name="img" onclick = "location.href = 'Recherche_seq.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher séquence </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Recherche_gen.php'"> <img src="https://www.biospectrumasia.com/uploads/articles/oncotest-debiopharm-identify-biomarker-candidates.jpg" height="70" width="115"><br> Rechercher génome </button> <br>
	
	<button id="close-image" name="img" onclick = "location.href = 'PageRecherche.html'"> <img src="http://ugene.unipro.ru/wp-content/uploads/2015/03/55.png" height="70" width="115""><br> Alignement </button> <br>
		<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://i2.wp.com/bioinfo-fr.net/wp-content/uploads/2012/05/INSL5.png?ssl=1" height="70" width="115"><br> Base Nucléotidique </button> <br>

	<button id="close-image" name="img" onclick = "location.href = 'Sequence.php'"> <img src="https://cdn.rcsb.org/rcsb-pdb/general_information/releases/1504_images/VisualizationStructure10000.png" height="70" width="115"><br> Base Proteique </button> <br>
	<button id="close-image" name="img" onclick = "location.href = 'Genome.php'"> <img src="https://genome.cshlp.org/content/19/10/1801/F1.large.jpg" height="70" width="115"><br> Base Génome </button> <br>

  
	</div>

<div class ="webplanPolicy">
<h2> Conditions et Politique de Confidentalité </h2>
<p>Cette politique de confidentialité vous aidera à comprendre comment GeneGate utilise et protège les données que vous nous fournissez <br> lorsque vous visitez et utilisez notre site Web. <br>
Nous nous réservons le droit de modifier cette politique à tout moment, dont vous serez rapidement mis à jour. Si vous voulez vous assurer que <br> 
vous êtes debout à jour avec les derniers changements, nous vous conseillons de visiter fréquemment cette page. </p>

<p> Quelles données utilisateur collectons-nous? <br>
Lorsque vous visitez le site Web, nous pouvons collecter les données suivantes:<br>
Vos coordonnées et votre adresse e-mail. <br>
Autres informations telles que les intérêts et les préférences. <br>
Profil de données concernant votre comportement en ligne sur notre site Web. </p>

<p> Pourquoi collectons-nous vos données? <br>
Nous collectons vos données pour plusieurs raisons: <br>
Pour mieux comprendre vos besoins. <br>
Pour améliorer nos services. <br>
Pour garder une traçabilité des activités. <br>
Pour personnaliser notre site Web en fonction de votre comportement en ligne et de vos préférences personnelles.  </p>

<p> Sauvegarde et sécurisation des données <br>
Genegate s'engage à sécuriser vos données et à les garder confidentielles. Genegate a fait tout ce qui était en son pouvoir pour empêcher le  vol de données, <br>
accès non autorisé et divulgation en mettant en œuvre les dernières technologies et logiciels, qui nous aident à protéger toutes les <br> informations que nous collecter en ligne. </p>

<p> Notre politique de cookies <br>
Une fois que vous acceptez d'autoriser notre site Web à utiliser des cookies, vous acceptez également d'utiliser les données qu'il collecte <br> concernant votre comportement en ligne (analyser le trafic Web, les pages Web sur lesquelles vous passez le plus de temps et les sites Web que vous visitez). <br>
Les données que nous collectons en utilisant des cookies sont utilisées pour personnaliser notre site Web en fonction de vos besoins. 
Une fois que nous utilisons les données pour l'analyse statistique, les données sont complètement supprimées de nos systèmes. <br>
Veuillez noter que les cookies ne nous permettent en aucun cas de prendre le contrôle de votre ordinateur.<br> 
Ils sont strictement utilisés pour surveiller les pages que vous trouvez utiles et celles qui ne vous intéressent pas afin que nous puissions vous offrir une meilleure expérience. <br>
Si vous souhaitez désactiver les cookies, vous pouvez le faire en accédant aux paramètres de votre navigateur Internet.</p>

<p> Notre site Web contient des liens menant vers d'autres sites Web. Si vous cliquez sur ces liens, Genegate n'est pas responsable de la <br> protection de vos données et de votre vie privée. La visite de ces sites Web n'est pas régie par cet accord de politique de confidentialité. <br> Assurez-vous de lire la politique de confidentialité <br>
documentation du site Web sur lequel vous accédez à partir de notre site Web. </p>

<p> Restreindre la collecte de vos données personnelles <br>
À un moment donné, vous souhaiterez peut-être restreindre l'utilisation et la collecte de vos données personnelles. <br>
Vous pouvez y parvenir en procédant comme suit: Lorsque vous remplissez les formulaires sur le site Web, assurez-vous de cocher s'il existe <br> une case que vous pouvez laisser décochée, si vous ne le souhaitez pas divulguer vos informations personnelles. <br>
Si vous avez déjà accepté de partager vos informations avec nous, n'hésitez pas à nous contacter par e-mail et nous serons plus qu'heureux de changer cela pour vous. <br>
Genegate ne louera, ne vendra ni ne distribuera vos informations personnelles à des tiers, sauf si nous avons votre permission. Nous pourrions le faire si la loi nous y oblige. </p>
</div>

	</body>

	<div class="bottombar">
  	<a href="plan.php"> Website Plan</a>
  	<a href="policy.php"> Policy</a>
  	<a href="About us.php">About Us</a>
  	<a href="Contact.php">Contact Us</a>
	</div>

	<div id = "footer">
		© 2020 GeneGATE
	</div> 



</html>

