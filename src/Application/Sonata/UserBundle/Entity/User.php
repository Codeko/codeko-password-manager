<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Application\Sonata\MediaBundle\Entity\Media;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class User extends BaseUser {

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var ArrayCollection $passwords
     */
    protected $passwords;

    /**
     * @var ArrayCollection $files
     */
    protected $files;

    /*
     * @var ArrayCollection $permisos
     */
    protected $permisos;

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

    public function addPassword(Password $password) {
        $this->passwords[] = $password;
    }

    /*
     * 
     */

    public function removePassword(Password $password) {
        $this->passwords->removeElement($password);
    }

    /*
     * 
     */

    public function addFile(Media $file) {
        $this->files[] = $file;
    }

    /*
     * 
     */

    public function removeFile(Media $file) {
        $this->files->removeElement($file);
    }

    /*
     * 
     */

    public function __toString() {
        return $this->getUsername() ? : 'n/a';
    }

    /*
     * 
     */

    function getPermisos() {
        return $this->permisos;
    }

    /*
     * 
     */

    public function addPermisos(PermisoUser $permiso) {
        $permiso->setUser($this);
        $this->permisos[] = $permiso;
        return $this;
    }

    /*
     * 
     */

    public function removePermisos(PermisoUser $permiso) {
        $this->permisos->removeElement($permiso);
    }

}
