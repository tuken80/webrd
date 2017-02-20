<?php

// src/app.php
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\CsrfServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\RememberMeServiceProvider;

$app = new Application();

$app->register(new TwigServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new LocaleServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new CsrfServiceProvider());
$app->register(new HttpCacheServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new RememberMeServiceProvider());

return $app;