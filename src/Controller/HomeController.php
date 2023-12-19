<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RelaisRepository;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RelaisRepository $relaisRepository): Response
    {
        $lesRelais = $relaisRepository->findAll(); // Assurez-vous que cette méthode récupère correctement les relais depuis la base de données

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'lesRelais' => $lesRelais,
        ]);
    }
}
