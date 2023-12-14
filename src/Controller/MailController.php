<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Form\MailType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route("/send-mail")]
    public function sendMail(Request $request, MailerInterface $mailer): Response
    {
        // Get the currently logged-in user
        $user = $this->getUser();

        // Create a Mail entity
        $mail = new Mail();
        $mail->setEnvoyeur($user);

        // Create the form
        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);

        // If the form is submitted and valid, proceed
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the Mail entity to the database
            $this->entityManager->persist($mail);
            $this->entityManager->flush();

            // Create and send the email
            $email = (new \Symfony\Component\Mime\Email())
                ->from(new \Symfony\Component\Mime\Address($mail->getEnvoyeur()->getEmail(), 'Sender Name'))
                ->to('licos@gmail.com')
                ->subject($mail->getsujet())
                ->text($mail->getContenue());

            $mailer->send($email);

            return new Response('Email sent and saved to the database!');
        }

        // Render the form
        return $this->render('mail/send_mail.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
