<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Entity;

use Sonata\ClassificationBundle\Entity\BaseCategory as BaseCategory;
use Application\Sonata\UserBundle\Entity\Password;
use Application\Sonata\UserBundle\Entity\PermisoCategoriaUser;
use Application\Sonata\UserBundle\Entity\PermisoCategoriaGrupo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( https://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class Category extends BaseCategory {

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var ArrayCollection $passwords
     */
    private $passwords;
    /*
     * 
     */
    protected $context;
    /*
     * 
     */
    protected $children;
    /*
     * 
     */
    private $permisosUser;
    /*
     * 
     */
    private $permisosGrupo;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    /*
     * 
     */

    public function setId($id) {
        $this->id = $id;
    }

    /*
     * 
     */

    function getPasswords() {
        return $this->passwords;
    }

    /*
     * 
     */

    public function __construct() {
        $this->passwords = new \Doctrine\Common\Collections\ArrayCollection();
        $this->permisosUser = new ArrayCollection();
        $this->permisosGrupo = new ArrayCollection();
    }

    /*
     * 
     */

    public function addPassword($password) {
        $this->passwords[] = $password;
    }

    /*
     * 
     */

    public function removePassword($password) {
        $this->passwords->removeElement($password);
    }

    /*
     * 
     */

    public function getClass() {
        return $this . get_class();
    }

    /*
     * 
     */

    function getPermisosUser() {
        return $this->permisosUser;
    }

    /*
     * 
     */

    function setPermisosUser($permiso) {

        $this->permisosUser = $permiso;

        return $this;
    }

    /*
     * 
     */

    public function addPermisosUser($permiso) {
        $permiso->setCategoria($this);
        $this->permisosUser[] = $permiso;
        return $this;
    }

    /*
     * 
     */

    public function removePermisosUser($permiso) {
        $this->permisosUser->removeElement($permiso);
        $permiso->setCategoria(null);
        $permiso->setUser(null);
    }

    /*
     * 
     */

    function getPermisosGrupo() {
        return $this->permisosGrupo;
    }

    /*
     * 
     */

    function setPermisosGrupo($permiso) {

        $this->permisosGrupo = $permiso;

        return $this;
    }

    /*
     * 
     */

    public function addPermisosGrupo($permiso) {
        $permiso->setCategoria($this);
        $this->permisosGrupo[] = $permiso;
        return $this;
    }

    /*
     * 
     */

    public function removePermisosGrupo($permiso) {
        $this->permisosGrupo->removeElement($permiso);
        $permiso->setCategoria(null);
        $permiso->setGrupo(null);
    }

}
