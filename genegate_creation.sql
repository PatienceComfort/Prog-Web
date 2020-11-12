DROP SCHEMA genegate CASCADE;
CREATE SCHEMA genegate;
SET SCHEMA 'genegate';

--UTILISATEUR
--------------

-- #Création de la relation
CREATE TABLE utilisateur(
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
);

--GENOME ET SEQUENCE
---------------------

-- #Creation de la relation genome
CREATE TABLE genome(
	idGenome VARCHAR(20),
	genre VARCHAR(20) NOT NULL,
	espece VARCHAR(20) NOT NULL,
	souche VARCHAR(20),
	genomeComplet TEXT NOT NULL,
	taille int NOT NULL,
	PRIMARY KEY (idGenome)
);

-- #Creation de la relation transcrit
CREATE TABLE transcrit(
	idSeq VARCHAR(20),  
	nomGene VARCHAR(20) NOT NULL, 
	nomProt VARCHAR(20) NOT NULL,
	fonction  VARCHAR(100),
	seqNt TEXT NOT NULL,
	seqProt TEXT NOT NULL,
	pos_debut int NOT NULL,
	pos_fin int NOT NULL,
	taille_transcrit int NOT NULL,
	biotypeGene VARCHAR(100) NOT NULL,
	biotypeTranscrit VARCHAR(100) NOT NULL,
	annotee BOOLEAN, -- False : non annotee, True : annotee
	idGenome VARCHAR(20) NOT NULL,
	PRIMARY KEY (idSeq), 
	CONSTRAINT fkseq FOREIGN KEY  (idGenome) REFERENCES genome (idGenome)
);

--FORUM
-------

--# Création de la relation Forum
CREATE TABLE forum (
	idSujet serial,
	sujet VARCHAR(100) NOT NULL UNIQUE,
	dateCreation timestamp NOT NULL,
	nomAnnot VARCHAR(20) NOT NULL,
	PRIMARY KEY (idSujet),
	CONSTRAINT fkforum FOREIGN KEY (nomAnnot) REFERENCES utilisateur(username)
);

--# Création de la relation Réponse
CREATE TABLE reponse( 
	idReponse serial,
	nomAnnot  VARCHAR(20) NOT NULL,
	response  TEXT NOT NULL,
	dateReponse  timestamp NOT NULL,
	idSujet  int NOT NULL,
	PRIMARY KEY (idReponse), 
	CONSTRAINT fkrep1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkrep2 FOREIGN KEY  (idSujet) REFERENCES forum(idSujet)
);

--# Creation de la relation Accessujet
CREATE TABLE accessujet(
	nomAnnot  VARCHAR(20),
	idSujet int,
	CONSTRAINT fkacc1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkacc2 FOREIGN KEY  (idSujet) REFERENCES forum (idSujet),
	PRIMARY KEY (nomAnnot,idSujet)
);

--ANNOTATIONS
--------------

--# Création de la relation Annotation
CREATE TABLE annotation ( 
	numAnnot int,
	idSeq VARCHAR(20) NOT NULL,
	idAnnot  VARCHAR(20),
	idValid1  VARCHAR(20),
	idValid2  VARCHAR(20),
	commentaire TEXT,
	statut VARCHAR(20) CHECK (statut = 'Pas de validateur' OR statut = 'Pas d annotateur' OR statut = 'A annoter' OR statut = 'A valider' OR statut = 'Validation' OR statut = 'Rejet'),
	PRIMARY KEY (numAnnot), 
	CONSTRAINT fkannot1 FOREIGN KEY  (idSeq) REFERENCES transcrit (idSeq),
	CONSTRAINT fkannot2 FOREIGN KEY  (idAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkannot3 FOREIGN KEY  (idValid1) REFERENCES utilisateur (username),
	CONSTRAINT fkannot4 FOREIGN KEY  (idValid2) REFERENCES utilisateur (username)
);


