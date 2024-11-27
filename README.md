Documentation API POKEMON pour la gestion de cartes pokemon et de tournois

I / LES ENTITES
II / LES DIFFERENTES ROUTES 

I / LES ENTITES ----------------------------------------------------------------------------------------------------------------
J'ai fait le choix de créer 4 entités 

Entité Carte (ou pokemon)
Les champs :
  id
  nom
  pv
  type
  photo
  energie_id
  serie_id
  commande_id

Toutes ces informations permettent de créer une "carte".

Entité énergie : 
Les champs : 
  id 
  type
Cette entité est relié à l'entité Carte en OneToMany. Une énergie peut être relié à plusieurs pokemon et un pokemon ne peut être relié qu'à une seule énergie.

Entité Série : 
Les champs
  id
  type
Nous sommes sur le même principe que l'entité énergie. La série représente le set où nous pouvons retrouver le pokemon.

Entité Tournoi
Les champs 
  id
  nom 
  date
Cette entité regroupe les différents tournois.

Entité tournoi_pokemon
Les champs
  tournoi_id
  pokemon_id

Cette entité doit être créé pour retrouver les cartes selon les tournois.

II / LES DIFFÉRENTES ROUTES ------------------------------------------------------------------------------------------------------------------------

En GET (pour lister) : 
  
  Pour lister toutes cartes :
  /api/cartes
  
  Pour lister une carte selon l'id :
  /api/carte/{id}
  
  Pour lister les cartes selon l'énergie choisi :
  /api/cartes/energie/{type}
  
  Énergie disponible : feu, eau, plante, electrique, obscurite, psy, combat, fee, metal, dragon, incolore.
  
  Pour lister les cartes selon le set : 
  /api/cartes/set/{id}
  
  Pour lister les energies : 
  /api/energies
  
  Pour lister les tournois : 
  /api/tournois
  
  Pour lister les tournois passés : 
  /api/tournois/ancien
  
  Pour lister les tournois à venir : 
  /api/tournois/avenir
  
  Pour lister les cartes selon l'id du tournoi : 
  /api/cartes/tournoi/{id}

En POST pour ajouter une donnée : 

  Pour ajouter une carte : 
  /api/cartes
  
  Pour ajouter un tournoi : 
  /api/tournois
  
 En DELETE pour supprimer une donnée : 
  
  Pour supprimer une carte selon l'id : 
  /api/carte/{id}
  
  Pour supprimer un tournoi selon l'id : 
  api/tournoi/{id}





