<?php

/**
 * Ce fichier contient la déclaration de 
 * la class utilisateur du site.
 *
 * PHP version 7
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 */

/**
 * Déclaration de la class utilisateur du site.
 *
 * @category PHP
 * @package  WebrdFramework
 * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
 * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
 * @link     https://github.com/tuken80/webrd.git
 *
 * @Entity(repositoryClass="UserRepository") @Table(name="users")
 */
class User
{
    /**
     * Identifiant utilisateur.
     *
     * @Id  @GeneratedValue @Column(type="integer")
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
     * Prénom utilisateur.
     *
     * @Column(type="string")
     * @var                   string
     */
    protected $prenom;

    /**
     * Adresse email utilisateur.
     *
     * @Column(type="string")
     * @var                   string
     */
    protected $email;

    /**
     * Login utilisateur.
     *
     * @Column(type="string")
     * @var                   string
     */
    protected $login;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom Le nouveau nom de l'utilisateur.
     *  
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom Le nouveau prénom de l'utilisateur.
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email La nouvelle adresse email de l'utilisateur.
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set login
     *
     * @param string $login Le nouveau login de l'utilisateur.
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
}
