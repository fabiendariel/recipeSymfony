<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
  #[Route('/contact', name: 'contact')]
  public function contact(Request $request, MailerInterface $mailer): Response
  {
    $data = new ContactDTO();
    /*$data->name = 'John Doe';
    $data->email = 'john@doe.fr';
    $data->message = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque quo reprehenderit vero mollitia tempore cumque labore placeat rem nam deserunt sit quasi reiciendis sed veniam, delectus quos ipsa ipsam architecto.';*/
    $form = $this->createForm(ContactType::class, $data);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      try {
        $email = (new TemplatedEmail())
          ->from($data->email)
          ->to($data->service)
          ->subject('RecipeSymfony : Demande de contact')
          ->htmlTemplate('emails/contact.html.twig')
          ->context(['data' => $data]);
      
        $mailer->send($email);
        $this->addFlash(
          'success',
          'Votre demande de contact a bien été envoyée'
        );
        return $this->redirectToRoute('home');
      } catch (\Exception $e) {
        $this->addFlash(
          'danger',
          'Impossible d\'envoyer votre demande de contact'
        );
      }  
    }
    return $this->render('contact/contact.html.twig', [
      'form' => $form
    ]);
  }
}
