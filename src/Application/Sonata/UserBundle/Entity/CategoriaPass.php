<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaPass
 */
class CategoriaPass {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreCategoria;

    /**
     * @var ArrayCollection $passwords
     */
    private $passwords;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombreCategoria
     *
     * @param string $nombreCategoria
     * @return CategoriaPass
     */
    public function setNombreCategoria($nombreCategoria) {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }

    /**
     * Get nombreCategoria
     *
     * @return string 
     */
    public function getNombreCategoria() {
        return $this->nombreCategoria;
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

    public function __toString() {
        return $this->getNombreCategoria();
    }

}
