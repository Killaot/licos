<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavBarController extends AbstractController
{
    #[Route('/navBar', name: 'app_nav_bar')]
    public function index(): Response
    {
        return $this->render('nav_bar/index.html.twig', [
            'controller_name' => 'NavBarController',
        ]);
    }

    #[Route('/consult', name: 'app_consult')]
    public function consult(): Response
    {
        // Redirection vers la route 'app_consulter_colis' qui pointe vers le contrôleur 'ConsulterColisController' et sa méthode 'index'
        return $this->redirectToRoute('app_consulter_colis');
    }
}
