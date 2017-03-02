<?php

/**
 * Ce fichier contient les différentes commandes personnelles, 
 * déclaration et code à éxécuter, disponible avec bin/console.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

$console = new Application('Webrd Application', 'n/a');
$console->getDefinition()->addOption(
    new InputOption(
        '--env', 
        '-e', 
        InputOption::VALUE_REQUIRED, 
        'The Environment name.', 'dev'
    )
);
$console->setDispatcher($app['dispatcher']);

$console
    ->register('clear')
    ->setDefinition(array())
    ->setDescription('The command clear caches.')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {
            $dir = __DIR__."/../var/cache";

            $output->writeln("Removing all files and folders in var/cache.");

            $finder = new Finder();
            $files = $finder->in($dir)->exclude('.gitkeep');
            $fs = new Filesystem();
            $fs->remove($files);

            $output->writeln("Done.");
        }
    );

$console
    ->register('check')
    ->setDefinition(array())
    ->setDescription('The command check the security issues of the application.')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {
            if (!file_exists("/usr/local/bin/security-checker")) {
                $output->writeln('Téléchargement de security-checker.phar.');
                shell_exec('wget "http://get.sensiolabs.org/security-checker.phar"');
                $output->writeln(
                    'Déplacement dans /usr/local/bin sous security-checker.'
                );
                shell_exec(
                    'sudo mv security-checker.phar /usr/local/bin/security-checker'
                );
                $output->writeln(
                    'Ajout du droit d\'éxécution.'
                );
                shell_exec('sudo chmod +x /usr/local/bin/security-checker');
            }

            $output->writeln(
                'Exécution de l\'analyse de sécurité sur composer.lock.'
            );
            $alerts = shell_exec(
                'security-checker security:check '.__DIR__.'/../composer.lock'
            );
            $output->write($alerts);
        }
    );

$console
    ->register('assets:dump')
    ->setDefinition(array())
    ->setDescription('The command compress js and css to one file.')
    ->setCode(
        function (InputInterface $input, OutputInterface $output) use ($app) {
            $cssDir = __DIR__."/../public/assets/css";
            $jsDir = __DIR__."/../public/assets/js";

            $finder = new Finder();
            $cssFiles = $finder->in($cssDir);
            $jsFiles = $finder->in($jsDir);

            $runCss = "node_modules/.bin/uglifycss ";
            foreach ($cssFiles as $cssfile) {
                if (is_file($cssfile)) {
                    $runCss.=$cssfile." ";
                }
            }
            $runCss.=" > public/assets/css/compiled/compiled.css";

            $runJs = "node_modules/.bin/uglifyjs ";
            foreach ($jsFiles as $jsfile) {
                if (is_file($jsfile)) {
                    $runJs.=$jsfile." ";
                }
            }
            $runJs.="> public/assets/js/compiled/compiled.js";
            
            shell_exec($runCss);    
            shell_exec($runJs);    
        
        }
    );

return $console;
