<?php

/**
* Ce fichier contient la déclaration de 
* la class role du site.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

use Doctrine\Common\Collections\ArrayCollection;

/**
* Déclaration de la class role du site.
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*
* @Entity(repositoryClass="RoleRepository") @Table(name="roles")
*/
class Role
{
    /**
    * Identifiant utilisateur.
    *
    * @Id  @Column(type="integer") @GeneratedValue
    * @var int
    */
    protected $id;

    /**
    * Nom utilisateur.
    *
    * @Column(type="string")
    * @var                   string
    */
    protected $nom;

    /**
    * Les utilisateurs possedant ce role.
    *
    * @ManyToMany(targetEntity="Role")
    **/
    protected $users;

    public function __construct() 
    {
        $this->users = new ArrayCollection();
    }
}
