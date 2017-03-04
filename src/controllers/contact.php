<?php

/**
* Fichier contenant la class des controllers de la partie contact.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

namespace Controller
{
    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    /**
    * Class contenant les controller de la partie contact.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class Contact
    {
        /**
        * Controller du formulaire de contact.
        *
        * @param Request     $request La requête reçue.
        * @param Application $app     L'application utilisée.
        *
        * @return Response
        */
        public function formulaire(Request $request, Application $app) 
        {
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
            
                $app['session']->getFlashBag()->add(
                    'application', 
                    'Votre message a bien était envoyé.'
                );

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
    }
}