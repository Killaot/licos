<?php

namespace App\Controller;

use App\Entity\Colis;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsulterColisController extends AbstractController
{
    #[Route('/consulterColis', name: 'app_consulter_colis')]
    public function index(): Response
    {
        return $this->render('home/consulterColis.html.twig', [
            'controller_name' => 'ConsulterColisController',
        ]);
    }
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/aller_recap', name: 'app_aller_recap')]
    public function allerRecap(Request $request): Response
    {
        $numeroColis = $request->request->get('numero_colis');

        // Vérifier si le numéro de colis existe dans la base de données
        $colis = $this->entityManager->getRepository(Colis::class)->findOneBy(['numeroColis' => $numeroColis]);

        if ($colis) {
            // Si le colis est trouvé, afficher les informations du colis
            return $this->render('home/recapitulatifFini.html.twig', [
                'colis' => $colis,
            ]);
        } else {
            return $this->render('home/consulterColis.html.twig');
        }
    }

    #[Route('/traitement-consulter-colis', name: 'app_traitement_consulter_colis')]
    public function traitementConsulterColis(Request $request): Response
    {
        $numeroColis = $request->request->get('numero_colis');

        // Redirigez vers la page récapitulative avec les données récupérées
        return $this->redirectToRoute('app_recapituler', ['idColis' => $numeroColis]);
    }
}
