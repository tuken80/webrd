<?php

/**
* Fichier contenant la class des controllers de la partie session.
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
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    /**
    * Class contenant les controller de la partie session.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    */
    class Session
    {
        /**
        * Controller pour le formulaire de login.
        *
        * @param Request     $request La requête reçue.
        * @param Application $app     L'application utilisée.
        *
        * @return Response
        */
        public function login(Request $request, Application $app) 
        {
            $form = include __DIR__.'/../forms/login.php';
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                                
                // find the encoder for a UserInterface instance
                //$encoder = $app['security.encoder_factory']->getEncoder($user);
                // compute the encoded password for foo
                //$password = $encoder->encodePassword('foo', $user->getSalt());
                //if (hash_equals($knownString, $userInput)) {
                    // ...
                //}

                die(var_dump($data));
            }

            return new Response(
                $app['twig']->render(
                    'session/login.html', array(
                    'form' => $form->createView()
                    )
                ),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
        }

        /**
        * Controller pour la déconnexion.
        *
        * @return Response
        */
        public function logout() 
        {
            if (null === $user = $app['session']->get('user')) {
                return $app->redirect('/login');
            }

            return "Welcome {$user['username']}!";
        }

        /**
        * Controller pour afficher le compte utilisateur.
        *
        * @return Response
        */
        public function account() 
        {
            if (null === $user = $app['session']->get('user')) {
                return $app->redirect('/login');
            }

            return "Welcome {$user['username']}!";
        }
    }
}