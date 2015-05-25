<?php

namespace Application\Sonata\UserBundle\Entity;


/**
 * TipoPass
 */
class TipoPass {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var ArrayCollection
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
     * Set nombre
     *
     * @param string $nombre
     * @return TipoPass
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set passwords
     *
     * @param array $passwords
     * @return TipoPass
     */
    public function setPasswords($passwords) {
        $this->passwords = $passwords;

        return $this;
    }

    /**
     * Get passwords
     *
     * @return array 
     */
    public function getPasswords() {
        return $this->passwords;
    }

    public function __construct() {
        $this->passwords = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addPassword(Password $pass) {
        $this->passwords[] = $pass;
    }

    public function removePassword(Password $pass) {
        $this->passwords->removeElement($pass);
    }

    public function __toString() {
        return $this->getNombre() ? : 'n/a';
    }
}
