DROP SCHEMA genegate CASCADE;
CREATE SCHEMA genegate;
SET SCHEMA 'genegate';

-- #Création de la relation
CREATE TABLE utilisateur(
	idUtilisateur serial,
	email VARCHAR(100) NOT NULL UNIQUE  CHECK (email ~* '[a-z0-9]*@[a-z0-9.]*'),
	username VARCHAR(20) NOT NULL UNIQUE,
	mdp VARCHAR(20) NOT NULL CHECK (length(mdp) > 7),
	nom VARCHAR(20) NOT NULL,
	prenom VARCHAR(20)NOT NULL,
	numtel VARCHAR(15) NOT NULL,
	dateConnexion timestamp,
	statut VARCHAR(10) NOT NULL CHECK (statut = 'Lecteur' OR statut ='Annotateur' OR statut ='Validateur' OR statut ='Administrateur'),
	validation BOOL,
	PRIMARY KEY (idUtilisateur)
);

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

-- #Creation de la relation sequence
CREATE TABLE sequence(
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
	statut int CHECK (statut = 0 OR statut = 1 OR statut = 2 OR statut = 3), -- # 0 : non annoté, 1: annoté, 2: en cours d'annotation, 3: annoté mais non validé
	idGenome VARCHAR(20),
	PRIMARY KEY (idSeq), 
	CONSTRAINT fkseq FOREIGN KEY  (idGenome) REFERENCES genome (idGenome)
);

--# Création de la relation Sujet 
CREATE TABLE Sujet(
	sujetid  serial,
	emailAnnot VARCHAR(100) NOT NULL UNIQUE,
	title VARCHAR(100) NOT NULL,
	PRIMARY KEY (sujetid), 
	CONSTRAINT fksuj FOREIGN KEY  (emailAnnot) REFERENCES utilisateur (email)
);

--# Création de la relation Forum
CREATE TABLE Forum (
	idSujet serial,
	sujet VARCHAR(100) NOT NULL,
	dateCreation timestamp,
	emailAnnot VARCHAR(100),
	PRIMARY KEY (idSujet),
	CONSTRAINT fkforum FOREIGN KEY (emailAnnot) REFERENCES utilisateur(email)
);

--# Création de la relation Réponse
CREATE TABLE reponse( 
	reponseid serial,
	emailAnnot  VARCHAR(100),
	response  VARCHAR(250) NOT NULL,
	dateReponse  timestamp,
	idSujet  int,
	PRIMARY KEY (reponseid), 
	CONSTRAINT fkrep1 FOREIGN KEY  (emailAnnot) REFERENCES utilisateur (email),
	CONSTRAINT fkrep2 FOREIGN KEY  (idSujet) REFERENCES Forum(idSujet)
);

--# Création de la relation Annotation --> utiliser les id pas les email, creation d'un statut ici plutot que seq
CREATE TABLE Annotation ( 
	numAnnot int,
	idSeq VARCHAR(20),
	idAnnot  VARCHAR(100),
	idValid1  VARCHAR(100),
	idValid2  VARCHAR(100),
	commentaire TEXT,
	PRIMARY KEY (numAnnot), 
	CONSTRAINT fkannot1 FOREIGN KEY  (idSeq) REFERENCES sequence (idSeq),
	CONSTRAINT fkannot2 FOREIGN KEY  (idAnnot) REFERENCES utilisateur (idUtilisateur),
	CONSTRAINT fkannot3 FOREIGN KEY  (idValid1) REFERENCES utilisateur (idUtilisateur),
	CONSTRAINT fkannot4 FOREIGN KEY  (idValid2) REFERENCES utilisateur (idUtilisateur)
);


