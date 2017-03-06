<?php

/**
* Ce fichier contient la déclaration de 
* la class utilisateur du site.
*
* PHP Version 7
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
* Déclaration de la class utilisateur du site.
*
* @category PHP
* @package  WebrdFramework
* @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
* @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
* @link     https://github.com/tuken80/webrd.git
*/
class User implements AdvancedUserInterface
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $username;
    protected $password;
    protected $salt;
    protected $dateExpiration;
    protected $lockUser;
    protected $enable;

    public function __construct($nom, $prenom, $email, $username, $salt) 
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->username = $username;
        $this->salt = $salt;
        $this->dateExpiration = null;
        $this->lockUser = true;
        $this->enable = false;
    }

    public function isAccountNonExpired() 
    {
        return date() > $this->dateExpiration;
    }

    public function isAccountNonLocked() 
    {
        return !$this->lock;
    }

    public function isEnabled() 
    {
        return $this->enable;
    }

    public function getRoles() 
    {
        return array();
    }

    public function getPassword() 
    {
        return $this->password;
    }

    public function getSalt() 
    {
        return $this->salt;
    }

    public function getUsername() 
    {
        return $this->username;
    }

    public function isCredentialsNonExpired() 
    {
        return true;
    }

    public function eraseCredentials()
    {

    }

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
     * @param string $nom
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
     * @param string $prenom
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
     * @param string $email
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set dateExpiration
     *
     * @param \DateTime $dateExpiration
     *
     * @return User
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    /**
     * Set lock
     *
     * @param boolean $lock
     *
     * @return User
     */
    public function setLockUser($lock)
    {
        $this->lockUser = $lock;

        return $this;
    }

    /**
     * Get lock
     *
     * @return boolean
     */
    public function getLockUser()
    {
        return $this->lockUser;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return User
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }
}
