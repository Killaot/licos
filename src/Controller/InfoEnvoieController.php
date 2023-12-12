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
        return $this->render('client/infoEnvoie.html.twig', [
            'controller_name' => 'InfoEnvoieController',
        ]);
    }

    #[Route('/traitement-formulaire', name: 'traitement_formulaire')]
    public function traitementFormulaire(Request $request): Response
    {
        $nomUtilisateur = $request->request->get('nomUtilisateur');
        $ville = $request->request->get('ville');
        $adresse = $request->request->get('adresse');
        $codePostal = $request->request->get('codePostal');

        // Faire quelque chose avec ces données (par exemple, les afficher)
        dump($nomUtilisateur, $ville, $adresse, $codePostal);

        // Rediriger vers une autre page après la soumission du formulaire
        return $this->redirectToRoute('choisir_relais'); // Redirection vers la route choisir_relais
    }
}