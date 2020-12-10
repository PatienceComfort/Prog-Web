<?php
  //Selectionner la bonne connexion
  //--------------------------------

  //$db = pg_connect("host=localhost port=5432 dbname=genegate username =postgres") or die ("Connection failed");
  $db = pg_connect("host=localhost dbname=romane user=romane") or die ("Connection failed");
  //$db = pg_connect("host=localhost port=5432 dbname=genegate user=abirami password=16011996") or die ("Connection failed");

?>
