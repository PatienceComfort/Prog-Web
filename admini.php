<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Espace administrateur</title>
  </head>
  <body>
    <h2>Utilisateurs à valider</h2>
    <table border = "2">
      <tr>
        <td>Username</td>
        <td>email</td>
        <td>Role demandé</td>
        <td>Valider</td>
        <td>Supprimer</td>
      </tr>
      <?php
      include "connect_db.php";
      if(isset($_GET['confirme'])){
        $confirme = $_GET['confirme'];
        $req = $bdd->pg_prepare('UPDATE utilisateur SET validation_compte = true WHERE username = ?');
        $req->pg_execute(array($confirme));
      }
      if(isset($_GET['supprime'])){
        $supprime = $_GET['supprime'];
        $req = $bdd->pg_prepare('DELETE FROM  utilisateur WHERE username = ?');
        $req->pg_execute(array($supprime));
      }
      $infos = pg_query($bdd,"SELECT username,email, statut,validation_compte FROM utilisateur");
      while($data = pg_fetch_array($infos))
      {?>
        <tr>
          <td><?php echo $data['username'];?></td>
          <td><?php echo $data['email'];?></td>
          <td><?php echo$data['statut'];?></td>
          <td><?php if($data['validation_compte']==false){?>
            <a href="admini.php?confirme=<?= $data['username']?>">Confirmer</a>
        <?php  } ?></td>
        <td><?php if($data['validation_compte']==true){?>
          <a href="admini.php?supprime=<?= $data['username']?>">Supprimer</a>
      <?php  } ?></td>
        </tr>
      <?php
      }
      ?>
    </table><br>
  </body>
</html>
