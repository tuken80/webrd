<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$contact = $app['controllers_factory'];

// Contact index
$contact->match(
    '/', function (Request $request) use ($app) {
        $form = include __DIR__.'/../forms/contact.php';

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = \Swift_Message::newInstance()
            ->setSubject($data['Sujet'])
            ->setFrom(array($data['Email']))
            ->setTo(array('romain.duquesne.mail@gmail.com'))
            ->setBody(
                $app['twig']->render(
                    'emails/mail-contact.html',
                    array(
                            'mail_from' => $data['Email'],
                            'mail_content' => $data['Contenu']
                            )
                ),
                'text/html'
            );

            $app['mailer']->send($message);
        
            $app['session']->getFlashBag()->add('application', 'Votre message a bien était envoyé.');

            return $app->redirect('/contact');
        }
    
        return new Response(
            $app['twig']->render(
                'contact.html', array(
                'form' => $form->createView()
                )
            ),
            200,
            array('Cache-Control' => 's-maxage=5, public')
        );
    }
)
->bind('contact')
->method('GET|POST');

return $contact;
