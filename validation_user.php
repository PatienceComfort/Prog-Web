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
        <div style="text-align:center">
            <?php
                //Recuperation du username
                $str=$_SERVER['REQUEST_URI']; 
                $keywords = preg_split("/=/", $str);
                $username = $keywords[1]; // username recupéré de l'url
                //Validation du nouvel utilisateur
                include "connect_db.php";
                $query = "UPDATE genegate.utilisateur SET validation_compte = 'true' WHERE username = '".$username."';";
                pg_query($db,$query);
                echo pg_last_error($db);
                //Validation
                echo "Validation effectuee";
            ?>

            <a href='admini.php'> Retour à la gestion des utilisateurs </a>
        </div>

    </body>

