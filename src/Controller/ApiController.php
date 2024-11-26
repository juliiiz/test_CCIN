<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Entity\Tournoi;
use App\Repository\EnergieRepository;
use App\Repository\PokemonRepository;
use App\Repository\TournoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    // LES ROUTES EN GET : LISTER LES DONNÉES

    // route en GET afin de lister toutes les cartes
    #[Route('/cartes', name: 'liste_cartes', methods: ['GET'])]
    public function listeCartes(PokemonRepository $pokemonRepository): JsonResponse
    {
        // Récupérer toutes les cartes
        $cartes = $pokemonRepository->findAll();

        // Transformer les objets en tableau
        $data = [];
        foreach ($cartes as $carte) {
            $data[] = [
                'id' => $carte->getId(),
                'nom' => $carte->getNom(),
                'pv' => $carte->getPv(),
                'type'=>$carte->getType(),
                'photo' => $carte->getPhoto(),
                'serie' => $carte->getSerie() ? $carte->getSerie()->getNom() : null,
                'energie' => $carte->getEnergie() ? $carte->getEnergie()->getType() : null,
            ];
        }

        return $this->json([
            'status' => 'success',
            'pokemon' => $data
        ]);
    }

// Route pour afficher une carte selon l'id
    #[Route('/carte/{id}', name: 'carte', methods: ['GET'])]
    public function getCarte(PokemonRepository $pokemonRepository, int $id): JsonResponse{

        // récupérer la carte selon l'id récupérer dans l'url
        $carte = $pokemonRepository->find($id);

        // erreur si la carte n'existe pas
        if(!$carte){
            return $this->json([
                'status' => 'error',
                'message' => 'Carte non trouvée'
            ], 404);
        }

        $data = [
            'id' => $carte->getId(),
            'nom' => $carte->getNom(),
            'pv' => $carte->getPv(),
            'type'=>$carte->getType(),
            'photo' => $carte->getPhoto(),
            'serie' => $carte->getSerie() ? $carte->getSerie()->getNom() : null,
            'energie' =>  $carte->getEnergie() ? $carte->getEnergie()->getType() : null,
        ];

        return $this->json([
            'status' => 'success',
            'pokemon' => $data
        ]);
    }
    // Route pour afficher les tournois
    #[Route('/tournois', name: 'tournois', methods: ['GET'])]
    public function listeTournoi(TournoiRepository $tournoiRepository): JsonResponse
    {
    // Afficher tous les tournois
        $tournois = $tournoiRepository->findAll();
        $data = [];
        foreach ($tournois as $tournoi) {
            $data [] = [
                'id' => $tournoi->getId(),
                'nom' => $tournoi->getNom(),
                'date' => $tournoi->getDate(),
            ];
        }
        return $this->json([
            'status' => 'success',
            'tournois' => $data
        ]);
    }

    // Lister pokemon par énergie : plus simple de connaître les énergies par rapport à leurs id (de plus toutes les
    // energies sont dans la base
    #[Route('/cartes/energie/{type}', name: 'liste_cartes_energie', methods: ['GET'])]
    public function listeCartesEnergie(PokemonRepository $pokemonRepository, string $type): JsonResponse
    {
        // Appel de la fonction dans PokemonRepository.php pour récupérer toutes les cartes ayant l'énergie mise dans l'url
        $cartes = $pokemonRepository->findByEnergieType($type);
        if(!$cartes){
            return $this->json([
                'status' => 'error',
                'message' => 'Aucune carte est associée à l\'énergie '.$type.'.'
            ], 404);
        }
            $data = [];
            foreach ($cartes as $carte) {
                $data[] = [
                    'id' => $carte->getId(),
                    'nom' => $carte->getNom(),
                    'pv' => $carte->getPv(),
                    'type'=>$carte->getType(),
                    'photo' => $carte->getPhoto(),
                    'serie' => $carte->getSerie() ? $carte->getSerie()->getNom() : null,
                    'energie' =>  $carte->getEnergie() ? $carte->getEnergie()->getType() : null,
                ];

        }

        return $this->json([
            'status' => 'success',
            'pokemon energie '.$carte->getEnergie()->getType() => $data
        ]);
    }


    // Lister pokemon par set : choix de l'id car on ne connait pas forcément les set qui sont dans la base
    #[Route('/cartes/set/{id}', name: 'liste_cartes_set', methods: ['GET'])]
    public function listeCartesSet(PokemonRepository $pokemonRepository, int $id): JsonResponse
    {
        // Appel de la fonction dans PokemonRepository.php pour récupérer toutes les cartes ayant l'énergie mise dans l'url
        $cartes = $pokemonRepository->findBy(['serie' => $id]);
        if(!$cartes){
            return $this->json([
                'status' => 'error',
                'message' => 'Aucune carte est associée à ce tournoi'
            ], 404);
        }
        $data = [];
        foreach ($cartes as $carte) {
            $data[] = [
                'id' => $carte->getId(),
                'nom' => $carte->getNom(),
                'pv' => $carte->getPv(),
                'type'=>$carte->getType(),
                'photo' => $carte->getPhoto(),
                'serie' => $carte->getSerie() ? $carte->getSerie()->getNom() : null,
                'energie' =>  $carte->getEnergie() ? $carte->getEnergie()->getType() : null,
            ];

        }

        return $this->json([
            'status' => 'success',
            'set : '.$carte->getSerie()->getNom() => $data
        ]);
    }
    // Lister les énergies
    #[Route('/energies', name: 'liste_energies', methods: ['GET'])]
    public function listeEnergies(EnergieRepository $energieRepository): JsonResponse
    {
        // Récupérer toutes les energies
        $energies = $energieRepository->findAll();

        // Transformer les objets en tableau
        $data = [];
        foreach ($energies as $energie) {
            $data[] = [
                'id' => $energie->getId(),
                'type' => $energie->getType(),
            ];
        }

        return $this->json([
            'status' => 'success',
            'energies' => $data
        ]);
    }
    //Lister les tournois passé
    #[Route('/tournois/ancien', name: 'tournois_ancien', methods: ['GET'])]
    public function listeTournoiAncien(TournoiRepository $tournoiRepository): JsonResponse
    {
        $dateActuelle = new \DateTime();
        $tournois = $tournoiRepository->findAll();
        $data = [];

        foreach ($tournois as $tournoi) {
            $tournoiDate = $tournoi->getDate();
            if ($tournoiDate < $dateActuelle) {
                $data[] = [
                    'id' => $tournoi->getId(),
                    'nom' => $tournoi->getNom(),
                    'date' => $tournoi->getDate()->format('Y-m-d'),

                ];
            }
        }
        return $this->json([
            'status' => 'success',
            'tournois ancien' => $data
        ]);
    }


    //Lister les tournois à venir
    #[Route('/tournois/avenir', name: 'tournois_avenir', methods: ['GET'])]
    public function listeTournoiAVenir(TournoiRepository $tournoiRepository): JsonResponse
    {
        $dateActuelle = new \DateTime();
        $tournois = $tournoiRepository->findAll();
        $data = [];

        foreach ($tournois as $tournoi) {
            $tournoiDate = $tournoi->getDate();
            if ($tournoiDate > $dateActuelle) {
                $data[] = [
                    'id' => $tournoi->getId(),
                    'nom' => $tournoi->getNom(),
                    'date' => $tournoi->getDate()->format('Y-m-d'),

                ];
            }
        }
        return $this->json([
            'status' => 'success',
            'tournois à venir' => $data
        ]);
    }
// Lister pokemon par tournoi
    #[Route('/cartes/tournoi/{id}', name: 'liste_cartes_tournoi', methods: ['GET'])]
    public function listeCartesTournoi(
        PokemonRepository $pokemonRepository,
        TournoiRepository $tournoiRepository,
        int $id
    ): JsonResponse
    {
        // Vérifier si le tournoi existe
        $tournoi = $tournoiRepository->find($id);
        // si le tournoi n'existe pas on affiche cette erreur
        if (!$tournoi) {
            return $this->json([
                'status' => 'error',
                'message' => 'Tournoi non trouvé avec l\'id : ' . $id
            ], 404);
        }

        // Récupérer les cartes du tournoi : on prend les cartes et on les filtre grâce à la fonction findByTournoiId
        $cartes = $pokemonRepository->findByTournoiId($id);
// si aucune carte n'est associée au tournoi alors on affiche cette erreur
        if(empty($cartes)){
            return $this->json([
                'status' => 'error',
                'message' => 'Aucune carte n\'est associée au tournoi : ' . $tournoi->getNom()
            ], 404);
        }
// Si le tournoi existe et que des cartes lui sont associés alors on retourne les bonnes cartes
        $data = [];
        foreach ($cartes as $carte) {
            $data[] = [
                'id' => $carte->getId(),
                'nom' => $carte->getNom(),
                'pv' => $carte->getPv(),
                'type' => $carte->getType(),
                'photo' => $carte->getPhoto(),
                'serie' => $carte->getSerie() ? $carte->getSerie()->getNom() : null,
                'energie' => $carte->getEnergie() ? $carte->getEnergie()->getType() : null,
                'tournoi' => $tournoi->getNom()
            ];
        }

        return $this->json([
            'status' => 'success',
            // on précise le tournoi
            'tournoi' => $tournoi->getNom(),
            // on y ajoute les cartes
            'pokemon' => $data
        ]);
    }
    // ---------------------------------ROUTES EN POST : AJOUTER DES DONNÉES----------------------------------

    // Ajouter un tournoi
    #[Route('/tournois', name: 'tournois_post', methods: ['POST'])]
    public function ajoutTournoi(EntityManagerInterface $entityManager, Request $request,
                                 TournoiRepository $tournoiRepository): JsonResponse
    {
        //dd($request->request);
        $tournoi = new Tournoi();
        $tournoi->setNom($request->request->get('nom'));
        $tournoi->setDate(new \DateTime());
        $entityManager->persist($tournoi);
        $entityManager->flush();



            $data = [
                'id' => $tournoi->getId(),
                'nom' => $tournoi->getNom(),
                'date' => $tournoi->getDate(),
            ];

        return $this->json([
            'status' => 'success',
            'tournois ajouté' => $data
        ]);
    }


    //Ajouter un pokemon
    #[Route('/cartes', name: 'cartes_post', methods: ['POST'])]
    public function ajoutCarte(
        EntityManagerInterface $entityManager,
        Request $request,
        PokemonRepository $pokemonRepository): JsonResponse
    {
        //dd($request->request);
        $pokemon = new Pokemon();
        $pokemon->setNom($request->request->get('nom'));
        $entityManager->persist($pokemon);
        $entityManager->flush();



        $data = [
            'id' => $pokemon->getId(),
            'nom' => $pokemon->getNom(),
            'pv' => $pokemon->getPv(),
            'type'=>$pokemon->getType(),
            'photo' => $pokemon->getPhoto(),
            'serie' => $pokemon->getSerie() ? $pokemon->getSerie()->getNom() : null,
            'energie' =>  $pokemon->getEnergie() ? $pokemon->getEnergie()->getType() : null,
        ];

        return $this->json([
            'status' => 'success',
            'pokemon ajouté' => $data
        ]);
    }
    //Créer un échange

    // -------------------------------------ROUTE EN DELETE : SUPPRIMER DES DONNÉES -----------------------------------

    // Supprimer un pokemon grâce à son id
    #[Route('/carte/{id}', name: 'carte_delete', methods: ['DELETE'])]
    public function supprimerCarte(EntityManagerInterface $entityManager, PokemonRepository $pokemonRepository, int $id
    ): JsonResponse
    {
        // Rechercher le pokemon par son id
        $pokemon = $pokemonRepository->find($id);

        // Vérifier si le pokemon existe
        if (!$pokemon) {
            return $this->json([
                'status' => 'error',
                'message' => 'Aucun pokemon trouvé avec l\'id ' . $id
            ], 404);
        }
        try {
            // Supprimer le pokemon
            $entityManager->remove($pokemon);
            $entityManager->flush();

            return $this->json([
                'status' => 'success',
                'message' => 'Pokemon supprimé avec succès'
            ]);

        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }
    // Supprimer un tournoi grâce à son id
    #[Route('/tournoi/{id}', name: 'tournoi_delete', methods: ['DELETE'])]
    public function supprimerTournoi(EntityManagerInterface $entityManager, TournoiRepository $tournoiRepository, int $id
    ): JsonResponse
    {
        // Rechercher le tournoi par son id
        $tournoi = $tournoiRepository->find($id);

        // Vérifier si le pokemon existe
        if (!$tournoi) {
            return $this->json([
                'status' => 'error',
                'message' => 'Aucun pokemon trouvé avec l\'id ' . $id
            ], 404);
        }
        try {
            // Supprimer le pokemon
            $entityManager->remove($tournoi);
            $entityManager->flush();

            return $this->json([
                'status' => 'success',
                'message' => 'Tournoi supprimé avec succès'
            ]);

        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }
}
