<?php

/**
 * Ce fichier active le mode de production de l'application,
 * il s'agit d'un fichier de configuration qui active plusieurs services.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

// Configuration de doctrine DBAL
$app['db.options'] = array(
    'driver'    => $parameters['database']['driver'],
    'host'      => $parameters['database']['host'],
    'dbname'    => $parameters['database']['dbname'],
    'user'      => $parameters['database']['user'],
    'password'  => $parameters['database']['password'],
    'charset'   => $parameters['database']['charset'],
);

// Configuration du firewall
$app['security.firewalls'] = array(
    'secured_area' => array(
        'pattern' => '^/admin',
        'anonymous' => true,
        'remember_me' => array(
            'key'                => 'Choose_A_Unique_Random_Key_Like_This',
            'always_remember_me' => true,
            'secure' => true,
            'httponly' => false,
        ),
        'form' => true,
        'logout' => true,
    ),  
    'unsecured' => array(
        'pattern' => '^.*$',
        'anonymous' => true,
    ),  
);

$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN' => array('ROLE_USER', 'ROLE_ALLOWED_TO_SWITCH'),
);
/*
$app['security.access_rules'] = array(
    array('^/admin', 'ROLE_ADMIN', 'http'),
);
*/
// Configuration de SwiftMailer
$app['swiftmailer.options'] = array(
    'host' => $parameters['mailer']['host'],
    'port' => $parameters['mailer']['port'],
    'username' => $parameters['mailer']['username'],
    'password' => $parameters['mailer']['password'],
    'encryption' => $parameters['mailer']['encryption'],
    'auth_mode' => $parameters['mailer']['auth_mode']
);

// Configuration des locales
$app['locale'] = $parameters['locale']['locale'];
$app['locale_fallbacks'] = $parameters['locale']['locales'];

// Configuration du service de traduction
$app['translator.domains'] = array();

// Configuration de twig
$app['twig.path'] = __DIR__.'/../src/templates';
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');

// Configuration des assets
$app['assets.version'] = 'v1';
$app['assets.version_format'] = '%s?version=%s';
$app['assets.named_packages'] = array(
    'css' => array('version' => 'css2', 'base_path' => '/assets/css/'),
    'js' => array('base_path' => '/assets/js/'),
    'img' => array('base_path' => '/assets/images/'),
    'font' => array('base_path' => '/assets/fonts/'),
);

// HTTP cache
$app['http_cache.cache_dir'] = __DIR__.'/../var/cache/';
$app['http_cache.esi'] = null;