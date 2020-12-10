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
    <h2>Utilisateurs à valider</h2>
      <table>
        <tr>
          <td>Username</td>
          <td>email</td>
          <td>Role demandé</td>
          <td>Valider</td>
          <td>Supprimer</td>
        </tr>

        <?php
        include "connect_db.php";
        $infos = pg_query($db,"SELECT username,email, statut,validation_compte FROM genegate.utilisateur WHERE validation_compte='f';");
        if(pg_num_rows($infos) > 0){//S'il y a des resultats
          while ($row = pg_fetch_assoc($infos) ){ //Affichage des utilisateurs non valides
            echo "<tr><td>".$row['username']."</td>
                      <td>".$row['email']."</td>
                      <td>".$row['statut']."</td>
                      <td> <a href='validation_user.php?id=".$row['username']."'> Valider </a> </td> 
                      <td> <a href='suppression_user.php?id=".$row['username']."'> Supprimer </a> </td> 
                  </tr>";
          }
        }
        ?>

      </table><br>

  </body>
    
