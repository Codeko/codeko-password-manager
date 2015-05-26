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
    protected $parent;
    protected $context;
    protected $children;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    function getPasswords() {
        return $this->passwords;
    }

    public function __construct() {
        $this->passwords = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addPassword(Password $password) {
        $this->passwords[] = $password;
    }

    public function removePassword(Password $password) {
        $this->passwords->removeElement($password);
    }

    public function getClass() {
        return $this . get_class();
    }
}
