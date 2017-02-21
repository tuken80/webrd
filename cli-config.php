<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Symfony\Component\Yaml\Yaml;

// replace with file to your own project bootstrap
$app = require __DIR__.'/src/app.php';
$parameters = Yaml::parse(file_get_contents(__DIR__.'/config/parameters.yml'));
require __DIR__.'/config/dev.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app['db.em'];

return ConsoleRunner::createHelperSet($entityManager);

