<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaPass
 */
class CategoriaPass
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombreCategoria;

    private $passwords;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreCategoria
     *
     * @param string $nombreCategoria
     * @return CategoriaPass
     */
    public function setNombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }

    /**
     * Get nombreCategoria
     *
     * @return string 
     */
    public function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }
    
    function getPasswords() {
        return $this->passwords;
    }

    function setPasswords($passwords) {
        $this->passwords = $passwords;
    }

    public function __construct() {
        $this->passwords = new \Doctrine\Common\Collections\ArrayCollection();
    }
}
