<!DOCTYPE html>


<html lang="fr">
  <head>
		<meta charset="utf-8" />
		<title> Connexion </title>
		<link rel="stylesheet" type="text/css" href="./style1.css">

	<div id ="header"> <br> 
			<h> GENEGATE </h> <br><br>
			  <div class = "searchbar">
  			<form id="form"> 
  			<input type="search" id="query" placeholder = "Search..">
  			<button text-align = "center"> Rechercher </button>
  		</form>
		</div>
	</div>

	</head>


	<body>
		<div id ="menu"> 
  		<li><a href="#">Home</a></li>
  		<li><a href="#"> Access Forum</a></li>
  		<li><a href="#"> Your Account </a></li>
  		<li><a href="#"> Update </a></li>
  		<li><a href="#"> Contact </a></li>
		</div>



	<div class = "LoginRegisterForm">
  	<form action="user.php" method="POST"> 

    	<h1> Acceder à votre espace personnel </h1>  
       
      	<label><b> Email ou Username </b></label> <br>
        <input type="text" placeholder="Email" name="email" required> <br><br>

				<label><b> Mot de passe </b></label> <br>
        <input type="password" placeholder="Mot de passe" name="pwd" required> <br><br>

				<input type="submit" id='submit' value='Login' > 
				<button type="button" id = "signIn" onclick = "location.href = 'inscriptionUti.html'"> </button> 

        <?php 
					if(isset($_GET['erreur'])){
        	$err = $_GET['erreur'];
          if($err==1 )
          echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>"; } 
				?>

    </form>
	</div> 


   
	</body>

	<div class="bottombar">
  	<a href="#news"> Website Plan</a>
  	<a href="#news"> Policy</a>
  	<a href="#news">About Us</a>
  	<a href="#contact">Contact Us</a>
	</div>

	<div id="footer">
		© 2020 GENEGATE
	</div> 

</html>
