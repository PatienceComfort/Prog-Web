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
	<form action="attribution.php" method="POST">

	Sequence ID :
​	<input type="text" placeholder="ID" name="id" id="id" required> <br><br>

	Username :
​	<input type="text" placeholder="username" name="username" id="username" required> <br><br>

	Email :
​	<input type="text" placeholder="email" name="email" id="email" required> <br><br>

	<input type="submit" id='submit' value='Attribuer'> 
	</form>
	
   </body>
</html>
