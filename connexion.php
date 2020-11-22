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
  			<li><a href="MenuSite">Home</a></li>
  			<li><a href="#"> Access Forum</a></li>
  			<li><a href="YourAccount.html"> Your Account </a></li>
  			<li><a href="Contact.html"> Contact </a></li>
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
  	<a href="#plan.html"> Website Plan</a>
  	<a href="policy.html"> Policy</a>
  	<a href="About us.html">About Us</a>
  	<a href="Contact.html">Contact Us</a>
	</div>

	<div id="footer">
		© 2020 GENEGATE
	</div> 

</html>
