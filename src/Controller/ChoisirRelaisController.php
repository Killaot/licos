<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Relais;
use App\Repository\RelaisRepository;
use App\Entity\Colis;
use App\Entity\Casier;
use App\Entity\Commande;
use DateTimeImmutable;

class ChoisirRelaisController extends AbstractController
{
    #[Route('/choisirRelais', name: 'app_choisir_relais')]
    public function index(RelaisRepository $relaisRepository): Response
    {
        $lesRelais = $relaisRepository->findAll(); // Assurez-vous que cette méthode récupère correctement les relais depuis la base de données

        return $this->render('home/choisirRelais.html.twig', [
            'controller_name' => 'ChoisirRelaisController',
            'lesRelais' => $lesRelais,
        ]);
    }

    #[Route('/traitement-point-relais', name: 'traitement_point_relais')]
public function traitementPointRelais(Request $request, EntityManagerInterface $entityManager): Response
{
    if ($request->isMethod('POST')) {
        $idRelais = $request->request->get('relais');
        $colisInfo = $request->getSession()->get('colis_info');

        $nbrColis = $request->request->get('nbrColis'); // Assurez-vous que 'nbrColis' correspond au nom de votre champ de formulaire
        $nbrColisInt = $nbrColis !== null ? (int) $nbrColis : 0; // Utilisez une valeur par défaut si $nbrColis est null

        if ($colisInfo !== null) {
            $Commande = new Commande();
            $date = new DateTimeImmutable();
            $Commande->setDate($date);
            $Commande->setNbrColis($nbrColisInt);
            $entityManager->persist($Commande);

            $Casier = new Casier();
            $entityManager->persist($Casier);

            $colis = new Colis();
            $colis->setDestinataire($colisInfo['nomUtilisateur']);
            $colis->setVolume((float) $colisInfo['volume']);
            $colis->setPoids($colisInfo['poids']);
            $colis->setDestination($colisInfo['destination']);

            // Générer un numéro de colis unique
            $formattedNumber = $this->generateUniqueRandomNumber($entityManager);
            $colis->setNumeroColis($formattedNumber);

            // Récupérer le Relais depuis la base de données
            $relais = $entityManager->getRepository(Relais::class)->find($idRelais);
            $colis->setLeRelais($relais);

            $colis->setLaCommande($Commande);
            $colis->setLeCasier($Casier);

            $entityManager->persist($colis);
            $entityManager->flush();

            $request->getSession()->remove('colis_info');

            $idColis = $colis->getId();

            return $this->redirectToRoute('app_recapituler', ['idColis' => $idColis]);
        }
    }

    return $this->redirectToRoute('app_infoEnvoie');
}

    // Méthode pour générer un numéro de colis unique
    public function generateUniqueRandomNumber(EntityManagerInterface $entityManager): string
    {
        $maxAttempts = 10;
        $attempt = 0;

        do {
            $randomNumber = rand(1, 999999);
            $formattedNumber = sprintf('%06d', $randomNumber);

            $existingColis = $entityManager->getRepository(Colis::class)->findOneBy(['numeroColis' => $formattedNumber]);

            if (!$existingColis) {
                return $formattedNumber;
            }

            $attempt++;
        } while ($attempt < $maxAttempts);

        throw new \Exception('Impossible de générer un numéro de colis unique après plusieurs tentatives.');
    }
}
