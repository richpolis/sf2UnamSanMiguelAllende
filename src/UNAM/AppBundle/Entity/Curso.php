<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\CursoRepository")
 */
class Curso
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
     * @ORM\Column(name="nombre_curso", type="string", length=140)
     */
    private $nombreCurso;

    /**
     * @var integer
     *
     * @ORM\Column(name="nota", type="integer")
     */
    private $nota;
    
    /**
     * @ORM\ManyToOne(targetEntity="Nivel", inversedBy="cursos")
     * @ORM\JoinColumn(name="nivel_id", referencedColumnName="id")
     */
    protected $nivel;
   
    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="cursos")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_ingles", type="boolean")
     */
    private $isIngles;
    
    /**
     * @ORM\ManyToOne(targetEntity="Precio", inversedBy="cursos")
     * @ORM\JoinColumn(name="precio_id", referencedColumnName="id")
     */
    protected $precio;
    
    public function __construct() {
        $this->isIngles = true;
    }
    
    public function __toString(){
        return $this->getNombreCurso() . " nivel " . $this->getNivel();
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
     * Set nombreCurso
     *
     * @param string $nombreCurso
     * @return Curso
     */
    public function setNombreCurso($nombreCurso)
    {
        $this->nombreCurso = $nombreCurso;

        return $this;
    }

    /**
     * Get nombreCurso
     *
     * @return string 
     */
    public function getNombreCurso()
    {
        return $this->nombreCurso;
    }

    /**
     * Set nota
     *
     * @param integer $nota
     * @return Curso
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return integer 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set isIngles
     *
     * @param boolean $isIngles
     * @return Curso
     */
    public function setIsIngles($isIngles)
    {
        $this->isIngles = $isIngles;

        return $this;
    }

    /**
     * Get isIngles
     *
     * @return boolean 
     */
    public function getIsIngles()
    {
        return $this->isIngles;
    }

    /**
     * Set nivel
     *
     * @param \UNAM\AppBundle\Entity\Nivel $nivel
     * @return Curso
     */
    public function setNivel(\UNAM\AppBundle\Entity\Nivel $nivel = null)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \UNAM\AppBundle\Entity\Nivel 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set grupo
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupo
     * @return Curso
     */
    public function setGrupo(\UNAM\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \UNAM\AppBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set precios
     *
     * @param \UNAM\AppBundle\Entity\Precio $precio
     * @return Curso
     */
    public function setPrecio(\UNAM\AppBundle\Entity\Precio $precio = null)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precios
     *
     * @return \UNAM\AppBundle\Entity\Precio 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}
