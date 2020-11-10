DROP SCHEMA genegate CASCADE;
CREATE SCHEMA genegate;
SET SCHEMA 'genegate';

--UTILISATEUR
--------------

-- #Création de la relation
CREATE TABLE utilisateur(
	email VARCHAR(100) NOT NULL UNIQUE  CHECK (email ~* '[a-z0-9]*@[a-z0-9.]*'),
	username VARCHAR(20) NOT NULL UNIQUE,
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
	genomeComplet TEXT,
	taille int,
	PRIMARY KEY (idGenome)
);

-- #Creation de la relation transcrit --> car sequence est un mot deja pris 
CREATE TABLE transcrit(
	idSeq VARCHAR(20),  
	nomGene VARCHAR(20),
	nomProt VARCHAR(20),
	fonction  VARCHAR(100),
	seqNt TEXT,
	seqProt TEXT,
	pos_debut int,
	pos_fin int,
	biotypeGene VARCHAR(100),
	biotypeTranscrit VARCHAR(100),
	annotee BOOLEAN, -- (statut = 0 OR statut = 1 OR statut = 2 OR statut = 3), -- # 0 : non annoté, 1: annoté, 2: en cours d'annotation, 3: annoté mais non validé
	idGenome VARCHAR(20),
	PRIMARY KEY (idSeq), 
	CONSTRAINT fkseq FOREIGN KEY  (idGenome) REFERENCES genome (idGenome)
);

--FORUM
-------

--# Création de la relation Forum
CREATE TABLE forum (
	idSujet serial,
	sujet VARCHAR(100) NOT NULL UNIQUE,
	dateCreation timestamp,
	emailAnnot VARCHAR(100),
	PRIMARY KEY (idSujet),
	CONSTRAINT fkforum FOREIGN KEY (emailAnnot) REFERENCES utilisateur(email)
);

--# Création de la relation Réponse
CREATE TABLE reponse( 
	idReponse serial,
	nomAnnot  VARCHAR(100),
	response  VARCHAR(250) NOT NULL,
	dateReponse  timestamp,
	idSujet  int,
	PRIMARY KEY (idReponse), 
	CONSTRAINT fkrep1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (email),
	CONSTRAINT fkrep2 FOREIGN KEY  (idSujet) REFERENCES Forum(idSujet)
);

--# Creation de la relation Accessujet
CREATE TABLE accessujet(
	nomAnnot  VARCHAR(100),
	idSujet int,
	CONSTRAINT fkacc1 FOREIGN KEY  (nomAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkacc2 FOREIGN KEY  (idSujet) REFERENCES forum (idSujet),
	PRIMARY KEY (nomAnnot,idSujet)
);

--ANNOTATIONS
--------------

--# Création de la relation Annotation --> creation d'un statut ici plutot que seq
CREATE TABLE Annotation ( 
	numAnnot int,
	idSeq VARCHAR(20),
	idAnnot  VARCHAR(100),
	idValid1  VARCHAR(100),
	idValid2  VARCHAR(100),
	commentaire TEXT,
	statut int CHECK (statut = 0 OR statut = 1 OR statut = 2 OR statut = 3), -- # 0 : non annoté, 1: annoté, 2: en cours d'annotation, 3: annoté mais non validé-- CHECK blablablabla 
	PRIMARY KEY (numAnnot), 
	CONSTRAINT fkannot1 FOREIGN KEY  (idSeq) REFERENCES sequence (idSeq),
	CONSTRAINT fkannot2 FOREIGN KEY  (idAnnot) REFERENCES utilisateur (username),
	CONSTRAINT fkannot3 FOREIGN KEY  (idValid1) REFERENCES utilisateur (username),
	CONSTRAINT fkannot4 FOREIGN KEY  (idValid2) REFERENCES utilisateur (username)
);


