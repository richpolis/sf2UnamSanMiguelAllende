<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Alumno
 *
 * @ORM\Table(name="alumnos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\AlumnoRepository")
 */
class Alumno

{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidopadre", type="string", length=30)
     */
    private $apellidoPadre;
     /**
     * @var string
     *
     * @ORM\Column(name="apellidomadre", type="string", length=30)
     */
    private $apellidoMadre;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=100)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="integer", length=20, unique=true)
     */
    private $identificacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="alumno")
     */
    protected $pagos;
    
    
    
    
    public function __construct()
    {
        $this->cursos = new ArrayCollection();
    }
    
    


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
     * Set nombre
     *
     * @param string $nombre
     * @return Alumno
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidoPadre
     *
     * @param string $apellidoPadre
     * @return Alumno
     */
    public function setApellidoPadre($apellidoPadre)
    {
        $this->apellidoPadre = $apellidoPadre;

        return $this;
    }

    /**
     * Get apellidoPadre
     *
     * @return string 
     */
    public function getApellidoPadre()
    {
        return $this->apellidoPadre;
    }

    /**
     * Set apellidoMadre
     *
     * @param string $apellidoMadre
     * @return Alumno
     */
    public function setApellidoMadre($apellidoMadre)
    {
        $this->apellidoMadre = $apellidoMadre;

        return $this;
    }

    /**
     * Get apellidoMadre
     *
     * @return string 
     */
    public function getApellidoMadre()
    {
        return $this->apellidoMadre;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Alumno
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     * @return Alumno
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string 
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Add cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     * @return Alumno
     */
    public function addCurso(\UNAM\AppBundle\Entity\Curso $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }

    /**
     * Remove cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     */
    public function removeCurso(\UNAM\AppBundle\Entity\Curso $cursos)
    {
        $this->cursos->removeElement($cursos);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCursos()
    {
        return $this->cursos;
    }
    
    function getIdentificacion() {
        return $this->identificacion;
    }

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }
    
    public function __toString() {
        return $this->apellidoPadre." ".$this->nombre." Nº ". $this->identificacion;
    }




    /**
     * Add pagos
     *
     * @param \UNAM\AppBundle\Entity\Pago $pagos
     * @return Alumno
     */
    public function addPago(\UNAM\AppBundle\Entity\Pago $pagos)
    {
        $this->pagos[] = $pagos;

        return $this;
    }

    /**
     * Remove pagos
     *
     * @param \UNAM\AppBundle\Entity\Pago $pagos
     */
    public function removePago(\UNAM\AppBundle\Entity\Pago $pagos)
    {
        $this->pagos->removeElement($pagos);
    }

    /**
     * Get pagos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPagos()
    {
        return $this->pagos;
    }
}
