<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Relais;
use App\Repository\RelaisRepository;
use Doctrine\ORM\EntityManagerInterface;

class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(): Response
    {
        return $this->render('map/index.html.twig', [
            'controller_name' => 'MapController',

        ]);
    }
    
    #[Route(path: '/trouverRelais', name: 'app_trouverRelais')]
    public function trouverRelais(Request $request, EntityManagerInterface $entityManager,RelaisRepository $relaisRepository): Response
    {
        $addressGps = null;
        
        $lesrelais = $relaisRepository->findAll();
        if ($request->isMethod('POST')) {
            $address = $request->request->get('address');
            $addressGps = str_replace(" ", "+", $address);
        }
    
        // Récupérer les coordonnées depuis la base de données
        $repository = $entityManager->getRepository(Relais::class);
        $relaisEntities = $repository->findAll();
    
        // Créer un tableau pour stocker les coordonnées des adresses
        $addressCoordinates = [];
        foreach ($relaisEntities as $relais) {
            $addressCoordinates[] = [
                'nom' => $relais->getNom(),
                'address' => $relais->getAdresse(),
                'lat' => $relais->getLat(),
                'lng' => $relais->getLng(),
            ];
        }
    
        return $this->render('rappel/trouverRelais.html.twig', [
            'addressGps' => $addressGps,
            'addressCoordinates' => $addressCoordinates,
            'lesrelais' => $lesrelais,
        ]);
    }
}
