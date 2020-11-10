
--CONNEXION
------------
--Se connecter
SELECT mdp --Pour verifier le mot de passe de l'utilisateur en comparant avec le mdp tape
FROM utilisateur
WHERE username = "JeanPierre_2"
  AND statut = TRUE;   --Seuls les utilisateurs valides peuvent acceder au site

--Se connecter
SELECT mdp --Comme precedemment, mais utilisation de l'email au lieu du nom d'utilisateur
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

-- Obtenir les noms d'utilisateurs deja present dans la base
SELECT username
FROM utilisateur;

-- Obtenir les noms d'utilisateurs deja present dans la base
SELECT email
FROM utilisateur;

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
SELECT transcrit.idSeq
FROM transcrit
WHERE seqProt LIKE "MPLLKDBNTRRADETN%"
  AND pos_debut = 3567
  AND biotypeGene = "Protein";

-- Recherche d’information sur une séquence nucléotidique:
SELECT transcrit.idSeq
FROM transcrit
WHERE seqNt LIKE "%ATAAACCG%"
  AND fonction= "nuclease"
  AND taille_transcrit <200;

-- Recherche d’information sur une séquence nucléotidique d'un genome particulier:
SELECT transcrit.idSeq
FROM transcrit, genome
WHERE transcrit.idGenome = genome.idGenome
  AND fonction= "nuclease"
  AND seqNt LIKE "%ATAAACCG%"
  AND genome.genre = "Escherichia"

-- Recherche d’information sur le génome des E.Coli :
SELECT *
FROM genome
WHERE genre = "Escherichia"
  AND espece = "Coli"
  AND taille > 3000000;

--GESTION DES ANNOTATIONS
---------------------------

-- Recherche des annotations d'un annotateur :
SELECT *
FROM annotation
WHERE utilisateur.idUtilisateur = "JeanPierre_2"
ORDER BY annotation.statut ASC;

-- Annotations visibles par les validateurs
SELECT *
FROM annotation;

-- Choix du validateur 
UPDATE annotation
SET idValid1 = "CRoy_1999",
  statut = "Pas d'annotateur"
WHERE annotation.idSeq = "EAR4567"; 

-- Choix de l'annotateur par le validateur
UPDATE annotation
SET idAnnot = "JeanPierre_2",
  statut = "A annoter"
WHERE annotation.idSeq = "EAR4567";

-- Annotation d'une sequence par l'annotateur
UPDATE transcrit
SET fonction = "Hypothetical protein"
WHERE idSeq = "EAR4567";

UPDATE annotation 
SET statut = "A valider"
WHERE annotation.idSeq = "EAR4567";

-- Validation d'une annotation par un validateur
UPDATE annotation 
SET idValid2 = "CRoy_1999",
  commentaire = 'blablablabla'
  statut = "Validation"
WHERE annotation.idSeq = "EAR4567";

UPDATE transcrit 
SET annotee = 1
WHERE idSeq = "EAR4567";

-- Rejet d'une annotation
UPDATE annotation 
SET idValid2 = 10,
  commentaire = 'blblablabla'
  statut = "Rejet"
WHERE annotation.idSeq = "EAR4567";

--GESTION DU FORUM
------------------

-- Pour afficher les sujets du forum auxquels a acces un annotateur
SELECT sujet, emailAnnot, dateCreation
FROM forum, accessujet
WHERE forum.idSujet = accessujet.idSujet
  AND accessujet.idAnnot = "JeanPierre_2";

-- Pour afficher la derniere reponse d'un sujet
SELECT response, emailAnnot, dateReponse
FROM reponse
WHERE idSujet = 10
  AND dateReponse = (SELECT MIN(dateReponse)
                      FROM reponse
                      WHERE idSujet =10);

-- Pour afficher la discussion liee a un sujet
SELECT response, emailAnnot, dateReponse
FROM reponse
WHERE idSujet = 10
ORDER BY dateReponse ASC;

-- Pour afficher le nom d'un sujet (idSujet =10)
SELECT sujet
FROM forum
WHERE idSujet = 10;

-- Accès au sujet a certains utilisateurs
INSERT INTO accessujet VALUES ('JeanPierre_2',36);


--AUTRE
------------------
-- Regrouper chez E.Coli les gènes par leurs fonctions :
SELECT fonction
FROM transcrit, genome
WHERE transcrit.idGenome = genome.idGenome and genre = "Escherichia" and souche ="Coli";

-- Trier les annotateurs ayant annotés le plus de séquences 
SELECT emailAnnot, COUNT(idSeq)
FROM  annotation 
GROUP BY emailAnnot 
ORDER BY COUNT(idSeq);

-- Sélectionner les informations des validateurs ayant validés des séquences du génome id = “AR5330I” 
SELECT nom, prenom, username
FROM utilisateur , annotation
WHERE utilisateur.username = annotation.idValid2 
and idGenome =  "AR5330I";