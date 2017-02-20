<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
$app = require __DIR__.'/src/app.php';
require __DIR__.'/config/dev.php';

$app->boot();

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $app['db.em'];

return ConsoleRunner::createHelperSet($entityManager);

