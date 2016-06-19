<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Grupo
 *
 * @ORM\Table(name="grupos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\GrupoRepository")
 */
class Grupo
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
     * @var integer
     *
     * @ORM\Column(name="grupo", type="string", length=30)
     */
    private $grupo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime")
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=150)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="horario", type="string", length=150)
     */
    private $horario;
    
    /**
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="grupo")
     */
    protected $cursos;
    
    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="grupo")
     */
    protected $pagos;
    
    /**
     * @ORM\ManyToOne(targetEntity="Maestro", inversedBy="grupos")
     * @ORM\JoinColumn(name="maestro_id", referencedColumnName="id")
     */
    protected $maestro;
    
   
    public function __toString() {
        return "Grupo:".$this->numero." - ".$this->nivel." - ".$this->fechaInicio->format('Y-m-d')."";
    }

}
