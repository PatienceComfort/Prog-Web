<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Espace administrateur</title>
  </head>
  <body>
    <h2>Utilisateurs à valider</h2>
    <table>
      <tr>
        <td>Username</td>
        <td>email</td>
        <td>Valider</td>
      </tr>
      <?php
      include "connect_db.php";
      $infos = pg_query($bdd,"SELECT username,email, validation_compte FROM utilisateur");
      while($data = pg_fetch_array($infos))
      {?>
        <tr>
          <td><?php echo $data['username'];?></td>
          <td><?php echo $data['email'];?></td>
          <td><a href="edit.php?validation_compte=<?php echo $data['validation_compte'];?>">Confirmer</a></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </body>
</html>
