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

namespace Model {

    use Symfony\Component\Security\Core\User\AdvancedUserInterface;

    /**
    * Déclaration de la class utilisateur du site.
    *
    * @category PHP
    * @package  WebrdFramework
    * @author   Romain Duquesne <romain.duquesne.mail@gmail.com>
    * @license  https://github.com/tuken80/webrd/blob/master/LICENCE MIT License
    * @link     https://github.com/tuken80/webrd.git
    *
    * @Entity(repositoryClass="UtilisateurRepository") @Table(name="users")
    */
    class Utilisateur implements AdvancedUserInterface
    {
        /**
        * Identifiant utilisateur.
        *
        * @Id  @GeneratedValue @Column(type="integer")
        * @var int
        */
        private $_id;

        /**
        * Nom utilisateur.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_nom;

        /**
        * Prénom utilisateur.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_prenom;

        /**
        * Adresse email utilisateur.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_email;

        /**
        * Login utilisateur.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_username;

        /**
        * Password utilisateur.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_password;

        /**
        * Salt of the user.
        *
        * @Column(type="string")
        * @var                   string
        */
        private $_salt;

        /**
        * Date d'expiration du compte.
        *
        * @Column(type="date")
        * @var                 date
        */
        private $_date_expiration;

        /**
        * Bool to lock account
        *
        * @Column(type="bool")
        * @var                 bool
        */
        private $_lock;

        /**
        * Bool to enable account after mail registration.
        *
        * @Column(type="bool")
        * @var                 bool
        */
        private $_enable;

        public function isAccountNonExpired() 
        {
            return date() > $this->_date_expiration;
        }

        public function isAccountNonLocked() 
        {
            return !$this->_lock;
        }

        public function isEnabled() 
        {
            return $this->_enable;
        }

        public function getRoles() 
        {
            return array();
        }

        public function getPassword() 
        {
            return $this->_password;
        }

        public function getSalt() 
        {
            return $this->_salt;
        }

        public function getUsername() 
        {
            return $this->_username;
        }

        public function isCredentialsNonExpired() 
        {
            return true;
        }

        public function eraseCredentials()
        {

        }
    }
}