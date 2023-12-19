<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class InfoEnvoieController extends AbstractController
{
    #[Route('/infoEnvoie', name: 'app_infoEnvoie')]
    public function index(): Response
    {
        return $this->render('home/infoEnvoie.html.twig', [
            'controller_name' => 'InfoEnvoieController',
        ]);
    }

    #[Route('/traitement-formulaire', name: 'traitement_formulaire')]
public function traitementFormulaire(Request $request): Response
{
    if ($request->isMethod('POST')) {
        // Récupération des données du formulaire
        $nomUtilisateur = $request->request->get('nomUtilisateur');
        $volume = $request->request->get('volume');
        $poids = $request->request->get('poids');
        $destination = $request->request->get('destination');

        $nbrColis = $request->request->get('nbrColis'); // Assurez-vous que 'nbrColis' correspond au nom de votre champ de formulaire

        // Stockage temporaire des données dans la session
        $request->getSession()->set('colis_info', [
            'nomUtilisateur' => $nomUtilisateur,
            'volume' => $volume,
            'poids' => $poids,
            'destination' => $destination,
            'nbrColis' => $nbrColis,
        ]);

        return $this->redirectToRoute('choisir_relais');
    }

    return $this->render('home/infoEnvoie.html.twig');
}
}