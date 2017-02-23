<?php

/**
 * Ce fichier permet l'utilisation de doctrine en ligne de commande.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */
 
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Yaml\Yaml;

// replace with file to your own project bootstrap
$app = include __DIR__.'/src/app.php';
$parameters = Yaml::parse(file_get_contents(__DIR__.'/config/parameters.yml'));
require __DIR__.'/config/dev.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app['db.em'];

return ConsoleRunner::createHelperSet($entityManager);
