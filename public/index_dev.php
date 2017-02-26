<?php

/**
 * Boostrap de l'application pour le développement.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Yaml\Yaml;

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file.');
}

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = include __DIR__.'/../src/app.php';
$parameters = Yaml::parse(file_get_contents(__DIR__.'/../config/parameters.yml'));

require __DIR__.'/../config/dev.php';
require __DIR__.'/../src/controllers.php';

Request::enableHttpMethodParameterOverride();
Request::setTrustedProxies(array('127.0.0.1', '::1'));

$app->run();
