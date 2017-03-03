<?php

/**
 * Ce fichier contient la déclaration du formulaire de login du site.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;

$form = $app['form.factory']->createBuilder(FormType::class)
    ->add(
        'Login', TextType::class, array(
            'constraints' => array(new Assert\NotBlank())
        )
    )
    ->add(
        'Password', TextType::class, array(
            'constraints' => new Assert\NotBlank()
        )
    )
    ->getForm();

return $form;
