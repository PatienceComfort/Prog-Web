
--CONNEXION
------------
--Se connecter
SELECT mdp --Pour verifier le mot de passe de l'utilisateur en comparant avec le mdp tape
FROM utilisateur
WHERE username = 'JP91'
  AND validation_compte  = 't';   --Seuls les utilisateurs valides peuvent acceder au site

--Se connecter
SELECT mdp --Comme precedemment, mais utilisation de l'email au lieu du nom d'utilisateur
FROM utilisateur
WHERE email = 'mauve.guy@gmail.com'
  AND validation_compte  = 't';

--Pour savoir quelle vue de la page d'accueil choisir
SELECT utilisateur.statut 
FROM utilisateur
WHERE username = 'JP91';

-- S'inscrire:
INSERT INTO utilisateur VALUES ('charles@gmail.com','CharlesR', 'CRoy_1999','Roy','Charles',0678956787,NULL,'Validateur',False);


-- Obtenir les noms d'utilisateurs deja present dans la base
SELECT username
FROM utilisateur;

-- Obtenir les emails d'utilisateurs deja present dans la base
SELECT email
FROM utilisateur;

--GESTION DES UTILISATEURS
--------------------------

--Mise a jour de la date de derniere connexion
UPDATE utilisateur
SET dateConnexion = '09-11-2020 17:04:00'
WHERE username = 'JP91';

-- Rechercher les utilisateurs non validés et leurs informations pour les afficher a l'administrateur
SELECT *
FROM utilisateur
WHERE validation_compte = 'f';

-- Rechercher les utilisateurs validés et leurs informations pour les afficher a l'administrateur
SELECT *
FROM utilisateur
WHERE validation_compte = 't';

-- Rechercher les annotateurs:
SELECT username,nom,prenom
FROM utilisateur
WHERE statut = 'Annotateur';

-- Valider une inscription
UPDATE utilisateur
SET validation_compte = 't'
WHERE username = 'MarieL';

-- Refuser une inscription                
DELETE FROM utilisateur
WHERE username = 'MarieL';

--RECHERCHE GENOME/SEQUENCE
---------------------------

-- Recherche d’information sur une séquence proteique :
SELECT transcrit.idSeq
FROM transcrit
WHERE seqProt LIKE 'MPLLKDBNTRRADETN%'
  AND pos_debut = 3567
  AND biotypeGene = 'Protein';

-- Recherche d’information sur une séquence nucléotidique:
SELECT transcrit.idSeq
FROM transcrit
WHERE seqNt LIKE '%ATAAACCG%'
  AND fonction= 'nuclease'
  AND taille_transcrit <200;

-- Recherche d’information sur une séquence nucléotidique d'un genome particulier:
SELECT transcrit.idSeq
FROM transcrit, genome
WHERE transcrit.idGenome = genome.idGenome
  AND fonction= 'nuclease'
  AND seqNt LIKE '%ATAAACCG%'
  AND genome.genre = 'Escherichia';

-- Recherche d’information sur le génome des E.Coli :
SELECT idGenome
FROM genome
WHERE genre = 'Escherichia'
  AND espece = 'Coli'
  AND taille > 3000000;

--GESTION DES ANNOTATIONS
---------------------------

-- Recherche des annotations d'un annotateur :
SELECT *
FROM annotation
WHERE annotation.idAnnot = 'JP91'
ORDER BY annotation.numAnnot DESC;

-- Annotations visibles par les validateurs
SELECT *
FROM annotation;

-- Choix du validateur 
UPDATE annotation
SET idValid1 = 'CharlesR',
  statut = 'Pas d annotateur'
WHERE annotation.idSeq = 'E21'
 AND annotation.numAnnot=1; 

-- Choix de l'annotateur par le validateur
UPDATE annotation
SET idAnnot = 'JP91',
  statut = 'A annoter'
WHERE annotation.idSeq = 'E21'
 AND annotation.numAnnot=1; 

-- Annotation d'une sequence par l'annotateur
UPDATE transcrit
SET fonction = 'Hypothetical protein'
WHERE idSeq = 'E21'; 

UPDATE annotation 
SET statut = 'A valider'
WHERE annotation.idSeq = 'E21'
 AND annotation.numAnnot=1; 

-- Validation d'une annotation par un validateur
UPDATE annotation 
SET idValid2 = 'CharlesR',
  commentaire = 'blablablabla',
  statut = 'Validation'
WHERE annotation.idSeq = 'E21'
 AND annotation.numAnnot=1; 

UPDATE transcrit 
SET annotee = 't'
WHERE idSeq = 'E21';

-- Rejet d'une annotation
UPDATE annotation 
SET idValid2 = 'CharlesR',
  commentaire = 'blblablabla',
  statut = 'Rejet'
WHERE annotation.idSeq = 'E21';

--GESTION DU FORUM
------------------

-- Pour afficher les sujets du forum auxquels a acces un annotateur
SELECT sujet, forum.nomAnnot, dateCreation
FROM forum, accessujet
WHERE forum.idSujet = accessujet.idSujet
  AND accessujet.nomAnnot = 'JP91';

-- Pour afficher la derniere reponse d'un sujet
SELECT response, nomAnnot, dateReponse
FROM reponse
WHERE idSujet = 1
  AND dateReponse = (SELECT MIN(dateReponse)
                      FROM reponse
                      WHERE idSujet =1);

-- Pour afficher la discussion liee a un sujet
SELECT response, nomAnnot, dateReponse
FROM reponse
WHERE idSujet = 1
ORDER BY dateReponse ASC;

-- Pour afficher le nom d'un sujet (idSujet =1)
SELECT sujet
FROM forum
WHERE idSujet = 1;

-- Accès au sujet a certains utilisateurs
INSERT INTO accessujet VALUES ('JP91',1);


--AUTRE
--------

-- Trier les annotateurs par le nombre de séquences annotees
SELECT idAnnot, COUNT(idSeq)
FROM  annotation 
GROUP BY idAnnot 
ORDER BY COUNT(idSeq) DESC;

-- Sélectionner les informations des validateurs ayant validés des séquences du génome id = “AR5330I” 
SELECT nom, prenom, username
FROM utilisateur,annotation,transcrit
WHERE utilisateur.username = annotation.idValid2
  AND transcrit.idSeq = annotation.idSeq
  AND transcrit.idGenome =  '1AEALBA';