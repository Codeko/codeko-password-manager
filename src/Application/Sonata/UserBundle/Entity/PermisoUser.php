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
     * @var Password $password
     */
    private $password;

    /**
     * @var User $user
     */
    private $user;

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
     * Get password
     *
     * @return \stdClass 
     */
    public function getPassword() {
        return $this->password;
    }

    /*
     * 
     */

    function setPassword($password) {
        $this->password = $password;
    }

    /*
     * 
     */

    function setUser($user) {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return \stdClass 
     */
    public function getUser() {
        return $this->user;
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

    /*
     * 
     */

    public function __toString() {
        if($this->getPermisos()==10){
            return $this->getUser() . ' [Lectura]';
        } else if($this->getPermisos()==11) {
            return $this->getUser() . ' [Lectura/Escritura]';
        } else {
            return $this->getUser() . ' [n/a]';
        }
    }

}
