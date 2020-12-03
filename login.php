<!DOCTYPE html>   

<html lang="fr">

  <head>
  <meta charset="utf-8" />
        <title>Website Style</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>   
 
	<body>      
		<div id="form">

			<form action="user.php" method="POST"> 
				<fieldset>

					<div id = "head">
						<h2>Connexion</h2>
					</div>

			<hr class="colorgraph">

			 Email ou username:<br>
       <input type="email" name="email" class="form-control input-lg" placeholder="Email Address">
			Mot de passe : <br>
       <input type="password" name="pwd" class="form-control input-lg" placeholder="Password">
			
			<a href="">Forgot Password?</a>

			<hr class="colorgraph">
			
			<input type="submit" id='submit' value='Login' > 
			<button  id='inscrit' onclick = "location.href = 'inscriptionUti.php'"> S'inscrire </button> 

			
			    <?php 
	  $_SESSION['user'] = $_POST['email'];

	  if(isset($_GET['erreur'])){
        	$err = $_GET['erreur'];
          if($err==1 )
          echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>"; } 
				?>
			
				</fieldset>
			</form>
		</div>

	</body>     
</html>
