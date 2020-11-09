
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
SET statut = TRUE,
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

-- Recherche de séquence annoté par Paul :
SELECT seqid
FROM annotation, utilisateur
where annotation.emailAnnot = utilisateur.email and utilisateur.prenom ="Paul";


-- Selectionner Les séquences non attribués 
SELECT geneId
FROM sequences,genome
WHERE sequences.statut = "0";




-- Sélectionner les annotateurs ayant validés des séquences du génome id = “AR5330I” 
SELECT nom, prenom
FROM utilisateur , annotation
WHERE utilisateur.email = annotation.email 
and idGenome =  "AR5330I";

-- Trier Les annotateurs ayant annotés le plus de séquences 
SELECT emailAnnot, COUNT(idSeq)
FROM  annotation 
GROUP BY emailAnnot 
ORDER BY COUNT(idSeq);

-- Selectionner les génomes complètement annotés :

--GESTION DU FORUM
------------------

--AUTRE
------------------
-- Regrouper chez E.Coli les gènes par leurs fonctions :
SELECT fonction
FROM sequences, genome
WHERE sequences.idGenome = genome.idGenome and genre = "Escherichia" and souche ="Coli";



--UPDATE ??