<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\ClassificationBundle\Entity\Category;

/**
 * PermisoCategoriaUser
 */
class PermisoCategoriaUser {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $permisos;

    /**
     * @var Category $categoria
     */
    private $categoria;

    /**
     * @var User $user
     */
    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set permisos
     *
     * @param integer $permisos
     * @return PermisoCategoriaUser
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

    function getCategoria() {
        return $this->categoria;
    }

    /*
     * 
     */

    function getUser() {
        return $this->user;
    }

    /*
     * 
     */

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    /*
     * 
     */

    function setUser($user) {
        $this->user = $user;
    }

    /*
     * 
     */

    public function __toString() {
        if ($this->getPermisos() == 10) {
            return $this->getUser() . ' [Ver]';
        } else if ($this->getPermisos() == 11) {
            return $this->getUser() . ' [Ver/Modificar]';
        } else {
            return $this->getUser() . ' [n/a]';
        }
    }

}
