<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\ClassificationBundle\Entity\Category;

/**
 * PermisoCategoriaGrupo
 */
class PermisoCategoriaGrupo {

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
     * @var Group $grupo
     */
    private $grupo;

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
     * @return PermisoCategoriaGrupo
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

    function getGrupo() {
        return $this->grupo;
    }

    /*
     * 
     */

    function setCategoria(Category $categoria) {
        $this->categoria = $categoria;
    }

    /*
     * 
     */

    function setGrupo(Group $grupo) {
        $this->grupo = $grupo;
    }

    /*
     * 
     */

    public function __toString() {
        return '(' . $this->getCategoria() . ')(' . $this->getGrupo() . ')(' . $this->getPermisos() . ')' ? : 'n/a';
    }

}
