<?php

use Symfony\Component\HttpFoundation\Request;

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';

require __DIR__.'/../config/prod.php';
require __DIR__.'/../src/controllers.php';

Request::enableHttpMethodParameterOverride();

$app['http_cache']->run();
