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
    protected $roles;

    public function __construct() 
    {
        $this->users = new ArrayCollection();
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
     * @return Role
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
     * Add role.
     *
     * @param \Role $role
     *
     * @return Role
     */
    public function addRole(\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role.
     *
     * @param \Role $role
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRole(\Role $role)
    {
        return $this->roles->removeElement($role);
    }

    /**
     * Get roles.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
