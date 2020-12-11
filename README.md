# Prog-Web

ParserGenome, ParserCDS, ParserPep : permettent de parser les fichiers fasta et de remplir les bases transcrit, genome et annotations

login.php : permet de se connecter au site
  - user.php : verifie que l'utilisateur est bien inscrit dans la base
inscriptionUti.php : contient le formulaire d'inscription de nouveaux utilisateurs
  - confirmInscript.php : permet de rentrer le nouvel utilisateur dans la base 
  
  MenuL.php : Menu Lecteur
  
  MenuA.php: Menu Annotateur
  
  MenuV.php: Menu Validateur
  
  utilisateur.php : affiche les information sur l'utilisateur/son compte
  
  policy.php : affiche les conditions d'utilisation du site
  
  plan.php : affiche les fonctionalités du sites
  
  aboutUs.html : affiche une page de presentation sur les créatrices du sites
  
  Rechercher les séquences et génomes :
  
   Recherche_seq.php Recherche_gen.php : contiennnt les formulaire de recherche des séquences et génome
   rech_sequence.php et rech_genome.php : permet de chercher dans la base et d'aaficher les resultats des requetes

   sortiecds.php, sortiepep.php, sortiefa.php : obtention des fichiers plats de sorties

   Genome.php Sequence.php : affichent tout le contenu/fiches disponibles dans les bases
  
   fiche.php : correspond à une fiche génome
   fihe2.php : correspond à une fiche de séquence

   
  
  Attribuer les séquences par un validateur:
    attribuer.php : affiche l'ensemble des séquences qui n'ont pas d'annotateur,
    attribuerseq : formulaire qui pertmet au validateur de rentrer les coordonnées d'un annotateur
    attibution : attribution de la séquence (modifie la base annotation) et affiche un lessage de confirmation
  
  Annoter :
    annotation.php : affiche l'ensemble des séquences à annoter pour un annotateur
    annoter.php : contient le formulaire d'annotation 
    confirmAnnotation.php : permet de rentrer les annotations dans la base transcrit et met à jour la base Annotation
   
   Valider ou rejetter les sequences
      validation.php : affiche les séquences de la base annotation a valider
      valider.php : afficher la sequence selectionnée et 2 boutons valider ou rejet 
        confirmValid.php : valide les annotations; met à jour la base annotations et transcrit
        rejetValid.php : rejette les annotations; met à jour la base annotations et transcrit
  
  Forum des annotateurs et des validateurs
    ForumSujets.php : les sujets visibles par l'utilisateur
    ForumDiscussions.php : la discussion liée à un sujet
    sujet_form.php : création d'un nouveau sujet
    reponse_form.php : création d'une nouvelle réponse à un sujet
  
  Gestion des utilisateurs :
   admini.php : visualisation des utilisateurs de la base
   validation_user.php, suppression_user.php : validation ou suppression des utilisateurs
        
          
  
  
