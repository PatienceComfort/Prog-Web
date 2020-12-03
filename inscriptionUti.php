<!DOCTYPE html>   

<html lang="fr">

  <head>
  <meta charset="utf-8" />
        <title>Website Style</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>   
 
	<body>      
		<div id="form">

			<form action="confirmInscript.php" method="POST">
				<fieldset>

					<div id = "head">
						<h2>Connexion</h2>
					</div>

			<hr class="colorgraph">

			Sexe : <select name="sexe"> 
  			<option value="M"> M </option>
  			<option value="F"> F </option>
			</select> <br><br>

 
			<label> <b> Nom : <b> </label>
			<input type="text"  name="nom" placeholder="First Name" required> <br><br>

			<label> <b> Prenom : <b> </label>
			<input type="text" name="prenom" placeholder="Last Name" required> <br><br>

			<label> <b> Date de naissance : <b> </label>
			<input id="date" type="date" value="2020-11-22" required> <br><br>

			<label> <b> Email : <b> </label>
			<input type="text" name="email" placeholder="Email address" required> <br><br>

			<label> <b> N° de téléphone : <b> </label>
			<input type="tel"  name="phone" placeholder="Phone number"required> <br><br>

			<label> <b> Username : <b> </label>
			<input type="text"  name="username" placeholder="Username"required> <br><br>

			<label> <b> Entrez votre mot de passe : <b> </label>
			<input type="text"  name="password_1" placeholder="Password"required> <br><br> 

			<label> <b> Veuillez Confirmez votre mot de passe : <b> </label>
			<input type="text"  name="password_2" placeholder="Confirm password"required> <br><br>
			
			Veuillez choisir votre role : 
			<select id="role" name="role"required > 
  			<option name='Lecteur' value='Lecteur'>Lecteur</option>
  			<option name='Annotateur' value='Annotateur'>Annotateur</option>
			<option name='Validateur value='Validateur'>Validateur</option>
			</select> <br><br>
			<hr class="colorgraph">
			
			<input type="submit" id='submit' value="S'inscrire" > 

			
				</fieldset>
			</form>
		</div>

	</body>     
</html>
