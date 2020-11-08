-- Faire son login:
SELECT utilisateur.role --Pour savoir quelle vue de la page d'accueil choisir
FROM utilisateur
WHERE username = "JeanPierre_2";

SELECT utilisateur.mdp --Pour verifier le mot de passe
FROM utilisateur
WHERE username = ‘X’;

SELECT utilisateur.mdp --Pour verifier le mot de passe
FROM utilisateur
WHERE email = ‘X’;

-- S'inscrire:
INSERT INTO utilisateur
VALUES (‘email.com’, ‘username’, ‘mdp’, ‘nom’, ‘prenom’, ‘numtel’, ‘statut’); --mettre des vraies valeurs ? 


-- Avoir toutes les informations sur un utilisateur :
SELECT *
FROM utilisateur
WHERE username = "MauveG";

-- Rechercher les annotateurs:
SELECT nom,prenom
FROM utilisateur
WHERE role = "Annotateur"


-- Recherche d’information sur une séquence proteique :
SELECT *
FROM sequences
WHERE seqProt = "MPLLKDBNTRRADETN";

-- Recherche d’information sur une séquence nucléotidique:
SELECT seqNt
FROM sequences
WHERE seqNt LIKE "%ATAAACCG%"
  AND fonction= "nuclease";

-- Recherche d’information sur le génome  de E.Coli :
SELECT *
FROM genome
WHERE genre = "Escherichia" and souche ="Coli";

-- Recherche de séquence annoté par Paul :
SELECT seqid
FROM annotation, utilisateur
where annotation.emailAnnot = utilisateur.email and utilisateur.prenom ="Paul";


-- Selectionner Les séquences non attribués 
SELECT geneId
FROM sequences,genome
WHERE sequences.statut = "0";


-- Regrouper chez E.Coli les gènes par leurs fonctions :
SELECT fonction
FROM sequences, genome
WHERE sequences.idGenome = genome.idGenome and genre = "Escherichia" and souche ="Coli" 
GROUP BY fonction;

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
