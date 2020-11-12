-- # Utilisateur

INSERT INTO utilisateur VALUES ('mauve.guy@gmail.com','MauveG', '12345678','Guy','Mauve',0711202007,NULL,'Lecteur',True);
INSERT INTO utilisateur VALUES ('JP@gmail.com','JP91', 'JeanPierre_2','Jean','Pierre',0714578900,NULL,'Annotateur',True);
INSERT INTO utilisateur VALUES ('marie@gmail.com','MarieL', 'Laurent_123','Laurent','Marion',0610209876,NULL,'Lecteur',False);
INSERT INTO utilisateur VALUES ('charles@gmail.com','CharlesR', 'CRoy_1999','Roy','Charles',0678956787,NULL,'Validateur',False);


-- # Genome

INSERT INTO genome VALUES ('1AECOLI','Escherechia','Coli', 'BYU34','AAAAATTTTTCCCCCGGGGG',20);
INSERT INTO genome VALUES ('1AEALBA','Escherechia','Alba', 'AHB02','AAAAATTTTTCCCCCGGGGG',20);
INSERT INTO genome VALUES ('1CECOLI','Escherechia','Coli', 'K12','AAAAATTTTTCCCCCGGGGG',20);

--# Transcrit
INSERT INTO transcrit VALUES ('001','Gene1','Pro1','Protease','ATTTTT','MM',5,10,6,'Unknown','Unknown',True,'1AECOLI')






