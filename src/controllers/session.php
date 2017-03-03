<?php

namespace Controller
{
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    class Session
    {
        public function login(Request $request, Application $app) 
        {
            $form = include __DIR__.'/../forms/login.php';
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
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

        public function logout() 
        {
            if (null === $user = $app['session']->get('user')) {
                return $app->redirect('/login');
            }

            return "Welcome {$user['username']}!";
        }

        public function account() 
        {
            if (null === $user = $app['session']->get('user')) {
                return $app->redirect('/login');
            }

            return "Welcome {$user['username']}!";
        }
    }
}