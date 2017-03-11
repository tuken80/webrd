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
    use User;

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
    
                $user = $app['db']->fetchAssoc(
                    "SELECT * FROM users WHERE username = ?", 
                    array(
                        (string) $data['Login']
                    )
                );

                $encoder = $app['security.encoder_factory']->getEncoder($user);

                $password = $encoder->encodePassword(
                    $data['Password'], 
                    $user->getSalt()
                );

                if (hash_equals($password, $user->getPassword())) {
                    die('password ok');
                }

                die(var_dump($data));
            }

            return new Response(
                $app['twig']->render(
                    'session/login.html.twig', array(
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
        * Controller pour le formulaire d'inscription.
        *
        * @param Request     $request La requête reçue.
        * @param Application $app     L'application utilisée.
        *
        * @return Response
        */
        public function inscription(Request $request, Application $app) 
        {
            $form = include __DIR__.'/../forms/inscription.php';
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();

                // Tester si username ou email déja existant

                $salt = base64_encode(random_bytes(10));
                
                $user = new User(
                    $data['Nom'],
                    $data['Prenom'],
                    $data['Email'],
                    $data['Login'],
                    $salt
                );

                $encoder = $app['security.encoder_factory']->getEncoder($user);
                $password = $encoder->encodePassword(
                    $data['Password'], 
                    $user->getSalt()
                );

                $user->setPassword($password);
                        
                $app['db']->insert(
                    'users', 
                    array(
                        'nom' => (string)$user->getNom(),
                        'prenom' => (string)$user->getPrenom(),
                        'email' => (string)$user->getEmail(),
                        'username' => (string)$user->getUsername(),
                        'password' => (string)'password',
                        'salt' => (string)'salt',
                        'lock_user' => (int)$user->getLockUser() ? 1 : 0,
                        'enable' => (int)$user->getEnable() ? 1 : 0,
                        'date_expiration' => null
                    )
                );

            }

            return new Response(
                $app['twig']->render(
                    'session/inscription.html.twig', array(
                    'form' => $form->createView()
                    )
                ),
                200,
                array('Cache-Control' => 's-maxage=5, public')
            );
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
