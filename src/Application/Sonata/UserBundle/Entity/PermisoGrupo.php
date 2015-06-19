<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoGrupo
 */
class PermisoGrupo {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var Password $password
     */
    private $password;

    /**
     * @var Group $grupo
     */
    private $grupo;

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
     * Set grupo
     *
     * @param $grupo
     * @return PermisoGrupo
     */
    public function setGrupo($grupo) {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return grupo 
     */
    public function getGrupo() {
        return $this->grupo;
    }

    /**
     * Set password
     *
     * @param Password $password
     * @return PermisoGrupo
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return password 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set permisos
     *
     * @param integer $permisos
     * @return PermisoGrupo
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
        if ($this->getPermisos() == 10) {
            return $this->getGrupo() . ' [Ver]';
        } else if ($this->getPermisos() == 11) {
            return $this->getGrupo() . ' [Ver/Modificar]';
        } else {
            return $this->getGrupo() . ' [n/a]';
        }
    }

}
