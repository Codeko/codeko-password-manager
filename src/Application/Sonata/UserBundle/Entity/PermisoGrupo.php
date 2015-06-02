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
     * @var ArrayCollection $passwords
     */
    private $passwords;

    /**
     * @var ArrayCollection $grupos
     */
    private $grupos;

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
     * Set user
     *
     * @param \stdClass $grupo
     * @return PermisoGrupo
     */
    public function setGrupos(Group $grupo) {
        $this->grupos = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \stdClass 
     */
    public function getGrupos() {
        return $this->grupos;
    }

    /*
     * 
     */

    public function addGrupos(Group $grupo) {
        $grupo->setPermisos($this);
        $this->grupos[] = $grupo;
        return $this;
    }

    /*
     * 
     */

    public function removeGrupos(Group $grupo) {
        $this->grupos->removeElement($grupo);
    }

    /**
     * Set password
     *
     * @param \stdClass $password
     * @return PermisoGrupo
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

}
