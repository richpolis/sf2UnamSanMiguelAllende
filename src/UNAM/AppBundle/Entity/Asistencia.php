<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencias")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\AsistenciaRepository")
 */
class Asistencia
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
     * @ORM\ManyToOne(targetEntity="Alumno", inversedBy="asistencias")
     * @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     */
    protected $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="asistencias")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    protected $grupo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_asistencia", type="date")
     */
    private $fechaAsistencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_asistencia", type="time")
     */
    private $timeAsistencia;


    

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
     * Set fechaAsistencia
     *
     * @param \DateTime $fechaAsistencia
     * @return Asistencia
     */
    public function setFechaAsistencia($fechaAsistencia)
    {
        $this->fechaAsistencia = $fechaAsistencia;

        return $this;
    }

    /**
     * Get fechaAsistencia
     *
     * @return \DateTime 
     */
    public function getFechaAsistencia()
    {
        return $this->fechaAsistencia;
    }

    /**
     * Set timeAsistencia
     *
     * @param \DateTime $timeAsistencia
     * @return Asistencia
     */
    public function setTimeAsistencia($timeAsistencia)
    {
        $this->timeAsistencia = $timeAsistencia;

        return $this;
    }

    /**
     * Get timeAsistencia
     *
     * @return \DateTime 
     */
    public function getTimeAsistencia()
    {
        return $this->timeAsistencia;
    }

    /**
     * Set alumno
     *
     * @param \UNAM\AppBundle\Entity\Alumno $alumno
     * @return Asistencia
     */
    public function setAlumno(\UNAM\AppBundle\Entity\Alumno $alumno = null)
    {
        $this->alumno = $alumno;

        return $this;
    }

    /**
     * Get alumno
     *
     * @return \UNAM\AppBundle\Entity\Alumno 
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * Set grupo
     *
     * @param \UNAM\AppBundle\Entity\Grupo $grupo
     * @return Asistencia
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
}
