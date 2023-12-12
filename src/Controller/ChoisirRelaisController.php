<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoisirRelaisController extends AbstractController
{
    #[Route('/choisirRelais', name: 'app_choisir_relais')]
    public function index(): Response
    {
        return $this->render('client/choisirRelais.html.twig', [
            'controller_name' => 'ChoisirRelaisController',
        ]);
    }
}
