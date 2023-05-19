<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ValidatorInterface $validator, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $errors = $validator->validate($contact);
          if(count($errors) > 0){
            $this->addFlash(
              'errors',
              $errors
            );
          }
          else {
            $email = (new Email())
            ->from($contact->getEmail())
            ->to($this->getParameter('contact_email'))
            ->subject('Prise de contact de ' . $contact->getName())
            ->text($contact->getMessage());
            try {
              $sentEmail = $mailer->send($email);
              $this->addFlash(
                'success',
                'Votre message a bien été envoyé. Je reviendrai vers vous le plus rapidement possible.'
              );
            } catch (\Exception $e) {
              $this->addFlash(
                'danger',
                "Un problème est survenu, votre message n'a pas pu être envoyé. Merci de réessayer."
              );
            }
          }
        }
        return $this->render('contact/index.html.twig', [
          "form" => $form->createView()
        ]);
    }
}
