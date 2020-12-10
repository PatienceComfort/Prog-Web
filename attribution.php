<!DOCTYPE html>
<?php
session_start();
	$db = pg_connect("host=localhost port=5432 dbname=genegate user=abirami password=16011996");
	
        $seq = pg_query($db,"SELECT * FROM genegate.annotation WHERE idSeq='".$_POST["id"]."'");
	$uti = pg_query($db,"SELECT * FROM genegate.utilisateur WHERE email='".$_POST["email"]."'");

	if (!$seq or !$uti) {
 		echo "Une erreur s'est produite.\n";
  	exit;
	}

	$bool = 0;
	if (pg_num_rows($seq) != 0) {
		while ($row = pg_fetch_assoc($seq) ){
		if ($row['statut'] == 'Pas d annotateur') {
			$id = $row['idSeq'];
			$bool ++;
			echo $row['idSeq'];;
		}
		}
		
	}

	if (pg_num_rows($uti) != 0) {
		while ($row = pg_fetch_assoc($uti) ){
			$username = $row['username'];
		if ($row['statut'] =! 'Lecteur' and $row['validation_compte'] == TRUE) { // le compte est validé et a les fonctionalités d'annotations
			$bool ++;
			echo $row['username'];;
		}
		}	
	}
	 
	if ($bool == 2) { // si bool = 2 alors verification utilisateur et seq ok
		$statut='A annoter';
		$update = pg_query($db,"UPDATE genegate.annotation SET idAnnot='".$username."', statut='".$statut."' WHERE idSeq='".$id."'");
	// affichage :
	//$upd2 = pg_query($db,"SELECT * FROM genegate.annotation WHERE idAnnot='".$username."' AND idSeq='".$id."'");
	 	
	//while ($row = pg_fetch_assoc($upd2)){
	//	echo $row['idseq'];
	//	echo $row['idannot'];
	//}
	
	
 	}

pg_close($db);
	
?>

