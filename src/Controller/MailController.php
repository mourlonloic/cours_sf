<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function index(\Swift_Mailer $mailer)
    {   
        // Définition de l'expéditeur
        $from = ["yamame59@gmail.com" => "Flandre Scarlet"];
        // $from = "yamame59@gmail.com";

        // Définition du destinataire
        $to = ["rumiakagamine@gmail.com" => "Rumia Kagamine"];

        // Définition de l'objet
        $subject = "Subject";

        // Définition du message

        // Création du message
        $message = new \Swift_Message();
        $message->setSubject($subject)
                ->setFrom($from)
                ->setTo($to);

        // Le message principal (format HTML)
        $message->setBody(
            $this->renderView(
                "mail/index.html.twig"
            ),
            "text/html"
        );

        // Le message alternatif (format TXT)
        $message->addPart(
            $this->renderView(
                "mail/index.txt.twig"
            ),
            "text/plain"
        );

        // ajout de pièce jointe
        // $message->attach()

        $sent = $mailer->send($message);


        return $this->json([
            "is send ?" => $sent? "yes" : "no"
        ]);
    }
}
