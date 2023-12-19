<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Colis;
use App\Entity\Relais;

class RecapitulerController extends AbstractController
{
    #[Route('/recapituler/{idColis}', name: 'app_recapituler')]
    public function index(EntityManagerInterface $entityManager, int $idColis): Response
    {
        // Récupérez le colis et le relais depuis la base de données
        $colis = $entityManager->getRepository(Colis::class)->find($idColis);
        
        if (!$colis) {
            throw $this->createNotFoundException('Colis non trouvé');
        }

        $relais = $colis->getLeRelais(); // Récupérez le relais associé au colis

        return $this->render('home/recapitulatif.html.twig', [
            'colis' => $colis,
            'relais' => $relais,
        ]);
    }
}
