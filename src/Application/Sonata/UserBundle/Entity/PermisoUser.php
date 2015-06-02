<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoUser
 */
class PermisoUser {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var ArrayCollection $passwords
     */
    private $passwords;

    /**
     * @var ArrayCollection $users
     */
    private $users;

    /**
     * @var integer
     */
    private $permisos;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set password
     *
     * @param \stdClass $password
     * @return PermisoUser
     */
    public function setPasswords(Password $password) {
        $this->passwords = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return \stdClass 
     */
    public function getPasswords() {
        return $this->passwords;
    }

    /*
     * 
     */

    public function addPassword(Password $password) {
        $password->setPermisosUser($this);
        $this->passwords[] = $password;
        return $this;
    }

    /*
     * 
     */

    public function removePassword(Password $password) {
        $this->passwords->removeElement($password);
    }

    /**
     * Set user
     *
     * @param \stdClass $user
     * @return PermisoUser
     */
    public function setUsers(User $user) {
        $this->users = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \stdClass 
     */
    public function getUsers() {
        return $this->users;
    }

    /*
     * 
     */

    public function addUsers(User $user) {
        $user->setPermisos($this);
        $this->users[] = $user;
        return $this;
    }

    /*
     * 
     */

    public function removeUsers(User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Set permisos
     *
     * @param integer $permisos
     * @return PermisoUser
     */
    public function setPermisos($permisos) {
        $this->permisos = $permisos;

        return $this;
    }

    /**
     * Get permisos
     *
     * @return integer 
     */
    public function getPermisos() {
        return $this->permisos;
    }

}
