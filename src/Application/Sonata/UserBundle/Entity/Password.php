<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Password
 */
class Password {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titulo;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var string
     */
    private $usernamePass;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \DateTime
     */
    private $fechaExpira;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     */
    private $fechaModificacion;

    /**
     * @var \DateTime
     */
    private $fechaUltimoAcceso;
    private $tipoPassword;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Password
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Password
     */
    public function setUser(User $user) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser() {
        return $this->user;
    }

    function getUsernamePass() {
        return $this->usernamePass;
    }

    function setUsernamePass($usernamePass) {
        $this->usernamePass = $usernamePass;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Password
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Password
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return Password
     */
    public function setComentario($comentario) {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario() {
        return $this->comentario;
    }

    /**
     * Set fechaExpira
     *
     * @param \DateTime $fechaExpira
     * @return Password
     */
    public function setFechaExpira($fechaExpira) {
        $this->fechaExpira = $fechaExpira;

        return $this;
    }

    /**
     * Get fechaExpira
     *
     * @return \DateTime 
     */
    public function getFechaExpira() {
        return $this->fechaExpira;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Password
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Password
     */
    public function setFechaModificacion($fechaModificacion) {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    /**
     * Set fechaUltimoAcceso
     *
     * @param \DateTime $fechaUltimoAcceso
     * @return Password
     */
    public function setFechaUltimoAcceso($fechaUltimoAcceso) {
        $this->fechaUltimoAcceso = $fechaUltimoAcceso;

        return $this;
    }

    /**
     * Get fechaUltimoAcceso
     *
     * @return \DateTime 
     */
    public function getFechaUltimoAcceso() {
        return $this->fechaUltimoAcceso;
    }

    function getTipoPassword() {
        return $this->tipoPassword;
    }

    function setTipoPassword($tipoPassword) {
        $this->tipoPassword = $tipoPassword;
    }

    public function __toString() {
        return $this->getTitulo() ? : 'n/a';
    }

}
