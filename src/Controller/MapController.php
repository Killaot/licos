<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function trouverRelais(Request $request): Response
    {
        $addressGps = null;

        if ($request->isMethod('POST')) {
            $address = $request->request->get('address');
            $addressGps = str_replace(" ", "+", $address);
        }

        return $this->render('map/trouverRelais.html.twig', [
            'addressGps' => $addressGps,
        ]);
    }
}
