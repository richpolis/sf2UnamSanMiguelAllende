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
    protected $precios;
    
    public function __construct() {
        $this->isIngles = true;
    }
    
    public function __toString(){
        return $this->getNombreCurso() . " nivel " . $this->getNivel();
    }
    
}
