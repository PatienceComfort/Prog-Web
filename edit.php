<?php
  include "connect_db.php"
  $username = $_GET['username'];
  $query = pg_query($bdd, "SELECT username, email, validation_compte FROM utilisateur WHERE username = '$username'");
  $data = pg_fetch_array($query);

  if(isset($_POST['Confirmer'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $edit = pg_query($bdd, "UPDATE utilisateur SET validation_compte = true WHERE username = '$username'");

  if($edit){
    pg_close($bdd);
    header("location:admini.php");
    exit;
  }
}
?>

<h3>Confirmer utilisateurs </h3>

<form method =  "POST">
  <input type="text" name = "username" value="<?php echo $data['username']?>" placeholder = "Entrez nom d'utilisateur" Required>
  <input type = "submit" name = "confirmer" value= "Confirmer">
</form>
