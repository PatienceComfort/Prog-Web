<?php
	session_start();
?>
<?php

//CONNEXION A LA BASE
echo "HELLLLOOOOO <br>";
$conn = pg_connect("host=localhost dbname=romane user=romane");
	if(!$conn) {      
		echo "Error : Unable to open database\n";
	}
echo pg_last_error($conn);
//CREATION DES BASES ET REMPLISSAGE
$query = "DROP SCHEMA genegate cascade;";
$query .= "CREATE SCHEMA genegate;";
$query .= "SET SCHEMA 'genegate';";
$query .= "CREATE TABLE utilisateur(
	email VARCHAR(100) NOT NULL UNIQUE CHECK (email ~* '[a-z0-9]*@[a-z0-9.]*'),
	username VARCHAR(20),
	mdp VARCHAR(20) NOT NULL CHECK (length(mdp) > 7),
	nom VARCHAR(20) NOT NULL,
	prenom VARCHAR(20)NOT NULL,
	numtel VARCHAR(15) NOT NULL,
	dateConnexion timestamp,
	statut VARCHAR(10) NOT NULL CHECK (statut = 'Lecteur' OR statut ='Annotateur' OR statut ='Validateur' OR statut ='Administrateur'),
	validation_compte BOOLEAN,
	PRIMARY KEY (username)
);";
$query .= "CREATE TABLE genome(
	idGenome VARCHAR(20),
	genre VARCHAR(20) NOT NULL,
	espece VARCHAR(20) NOT NULL,
	souche VARCHAR(100),
	genomeComplet TEXT NOT NULL,
	taille int NOT NULL,
	PRIMARY KEY (idGenome)
);";
$query .= "CREATE TABLE transcrit(
	idSeq VARCHAR(20),  
	nomGene VARCHAR(20) NOT NULL, 
	nomProt VARCHAR(20),
	fonction  VARCHAR(500),
	seqNt TEXT NOT NULL,
	seqProt TEXT,
	pos_debut int NOT NULL,
	pos_fin int NOT NULL,
	taille_transcrit int NOT NULL,
	biotypeGene VARCHAR(100),
	biotypeTranscrit VARCHAR(100),
	annotee VARCHAR(20),
	idGenome VARCHAR(20) NOT NULL,
	PRIMARY KEY (idSeq));";
$query .= "CREATE TABLE forum (
	idSujet serial,
	sujet VARCHAR(100) NOT NULL UNIQUE,
	dateCreation timestamp NOT NULL,
	nomAnnot VARCHAR(20) NOT NULL,
	PRIMARY KEY (idSujet),
	CONSTRAINT fkforum FOREIGN KEY (nomAnnot) REFERENCES utilisateur(username)
);";
$query .= "CREATE TABLE reponse( 
	idReponse serial,
	nomAnnot  VARCHAR(20) NOT NULL,
	response  TEXT NOT NULL,
	dateReponse  timestamp NOT NULL,
	idSujet  int NOT NULL,
	PRIMARY KEY (idReponse), 
	CONSTRAINT fkrep1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkrep2 FOREIGN KEY  (idSujet) REFERENCES forum(idSujet)
);";
$query .= "CREATE TABLE accessujet(
	nomAnnot  VARCHAR(20),
	idSujet int,
	CONSTRAINT fkacc1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkacc2 FOREIGN KEY  (idSujet) REFERENCES forum (idSujet),
	PRIMARY KEY (nomAnnot,idSujet)
);";
$query .= "CREATE TABLE annotation ( 
	numAnnot int,
	idSeq VARCHAR(20) NOT NULL,
	idAnnot  VARCHAR(20),
	idValid1  VARCHAR(20),
	idValid2  VARCHAR(20),
	commentaire TEXT,
	statut VARCHAR(20) CHECK (statut = 'Pas de validateur' OR statut = 'Pas d annotateur' OR statut = 'A annoter' OR statut = 'A valider' OR statut = 'Validation'),
	PRIMARY KEY (numAnnot), 
	CONSTRAINT fkannot1 FOREIGN KEY  (idSeq) REFERENCES transcrit (idSeq),
	CONSTRAINT fkannot2 FOREIGN KEY  (idAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkannot3 FOREIGN KEY  (idValid1) REFERENCES utilisateur (username),
	CONSTRAINT fkannot4 FOREIGN KEY  (idValid2) REFERENCES utilisateur (username)
);";
$query .= "INSERT INTO utilisateur VALUES ('mauve.guy@gmail.com','MauveG', '12345678','Guy','Mauve',0711202007,NULL,'Lecteur',True);
INSERT INTO utilisateur VALUES ('JP@gmail.com','JP91', 'JeanPierre_2','Jean','Pierre',0714578900,NULL,'Annotateur',True);
INSERT INTO utilisateur VALUES ('marie@gmail.com','MarieL', 'Laurent_123','Laurent','Marion',0610209876,NULL,'Lecteur',True);
INSERT INTO utilisateur VALUES ('charles@gmail.com','CharlesR', 'CRoy_1999','Roy','Charles',0678956787,NULL,'Validateur',True);";
$query .= "INSERT INTO forum VALUES (DEFAULT, 'Probleme annotation','08-08-2020 15:35:00', 'JP91');
-- # Reponse
INSERT INTO reponse VALUES (DEFAULT, 'JP91', 'Un petit probleme est apparu lors de mon annotation','08-20-2020 15:35:00',1);
-- # Accessujet
INSERT INTO accessujet VALUES ('JP91',1);
INSERT INTO accessujet VALUES ('CharlesR',1);";
pg_query($conn, $query);
echo pg_last_error($conn);
echo "<br> Coucou <br>";

//TEST
$result = pg_query($conn, "SELECT * from transcrit;");
if (!$result) {
 	echo "Une erreur s'est produite.<br>";
    echo pg_last_error($conn);
}else{
    $arr = pg_fetch_all($result);
    print_r($arr);
}
//Variables de session
//$_SESSION['username'] = 'JP91';
//$_SESSION['statut'] = 'Validateur';

//Test d'email
$email = "romane.junker@orange.fr";
echo "<br> <br> <a href='mailto: ".$email."?subject=Nouvelle Sequence a annoter'> Mail me  </a>";

echo "<br>BYYYYYE<br>";
?>