
--CONNEXION
------------
--Se connecter
SELECT utilisateur.mdp --Pour verifier le mot de passe de l'utilisateur en comparant avec le mdp tape
FROM utilisateur
WHERE username = "JeanPierre_2"
  AND statut = TRUE;   --Seuls les utilisateurs valides peuvent acceder au site

SELECT utilisateur.mdp --Comme précédemment, mais utilisation de l'email au lieu du nom d'utilisateur
FROM utilisateur
WHERE email = ‘X’
  AND statut = TRUE;

--Pour savoir quelle vue de la page d'accueil choisir
SELECT utilisateur.role 
FROM utilisateur
WHERE username = "JeanPierre_2";

-- S'inscrire:
INSERT INTO utilisateur
VALUES (‘email.com’, ‘username’, ‘mdp’, ‘nom’, ‘prenom’, ‘numtel’, ‘statut’); --mettre des vraies valeurs ? 

--GESTION DES UTILISATEURS
--------------------------

--Mise a jour de la date de derniere connexion
UPDATE utilisateur
SET dateConnexion = '09/11/2020 17h04',
WHERE username = "JeanPierre_2";

-- Rechercher les utilisateurs non validés et leurs informations pour les afficher a l'administrateur
SELECT *
FROM utilisateur
WHERE statut = FALSE;

-- Rechercher les utilisateurs validés et leurs informations pour les afficher a l'administrateur
SELECT *
FROM utilisateur
WHERE statut = TRUE;

-- Rechercher les annotateurs:
SELECT nom,prenom
FROM utilisateur
WHERE role = "Annotateur";

-- Valider une inscription
UPDATE utilisateur
SET statut = TRUE
WHERE username = "Laurent_123";

-- Refuser une inscription                (a verifier !!)
DELETE FROM 'utilisateur'
WHERE 'username' = "Laurent_123";

--RECHERCHE GENOME/SEQUENCE
---------------------------

-- Recherche d’information sur une séquence proteique :
SELECT *
FROM sequences
WHERE seqProt = "MPLLKDBNTRRADETN";

-- Recherche d’information sur une séquence nucléotidique:
SELECT seqNt
FROM sequences
WHERE seqNt LIKE "%ATAAACCG%"
  AND fonction= "nuclease";

-- Recherche d’information sur une séquence nucléotidique d'un genome particulier:
SELECT seqNt
FROM sequences, genome
WHERE sequences.idGenome = genome.idGenome
  AND fonction= "nuclease"
  AND seqNt LIKE "%ATAAACCG%"
  AND genome.genre = "Escherichia"

-- Recherche d’information sur le génome  de E.Coli :
SELECT *
FROM genome
WHERE genre = "Escherichia" and souche ="Coli";

--GESTION DES ANNOTATIONS
---------------------------

-- Recherche des annotaions d'un annotateur :
SELECT *
FROM annotation
WHERE utilisateur.idUtilisateur = 4
ORDER BY annotation.statut ASC;

-- Annotations visibles par les validateurs
SELECT *
FROM annotation;

-- Choix du validateur 
UPDATE annotation
SET idValid1 = 6,
  statut = "Pas d'annotateur"
WHERE annotation.idSeq = "EAR4567"; 

-- Choix de l'annotateur par le validateur (idUtilisateur = 6)
UPDATE annotation
SET idAnnot = 8,
  statut = "A annoter"
WHERE annotation.idSeq = "EAR4567";

-- Annotation d'une sequence par l'annotateur
UPDATE sequences
SET fonction = "Hypothetical protein"
WHERE idSeq = "EAR4567";

UPDATE annotation 
SET statut = "A valider"
WHERE annotation.idSeq = "EAR4567";

-- Validation d'une annotation par un validateur (idUtilisateur = 10)
UPDATE annotation 
SET idValid2 = 10,
  commentaire = 'blblablabla'
  statut = "validation"
WHERE annotation.idSeq = "EAR4567";

UPDATE transcrit 
SET annotee = 1
WHERE idSeq = "EAR4567";

-- Rejet d'une annotation
UPDATE annotation 
SET idValid2 = 10,
  commentaire = 'blblablabla'
  statut = "rejet"
WHERE annotation.idSeq = "EAR4567";

--GESTION DU FORUM
------------------
SELECT *
FROM 

--AUTRE
------------------
-- Regrouper chez E.Coli les gènes par leurs fonctions :
SELECT fonction
FROM sequences, genome
WHERE sequences.idGenome = genome.idGenome and genre = "Escherichia" and souche ="Coli";

-- Trier Les annotateurs ayant annotés le plus de séquences 
SELECT emailAnnot, COUNT(idSeq)
FROM  annotation 
GROUP BY emailAnnot 
ORDER BY COUNT(idSeq);

-- Sélectionner les annotateurs ayant validés des séquences du génome id = “AR5330I” 
SELECT nom, prenom
FROM utilisateur , annotation
WHERE utilisateur.email = annotation.email 
and idGenome =  "AR5330I";