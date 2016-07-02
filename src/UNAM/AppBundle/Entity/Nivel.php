<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Nivel
 *
 * @ORM\Table(name="niveles")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\NivelRepository")
 */
class Nivel
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
     * @ORM\Column(name="nivel", type="string", length=30)
     */
    private $nivel;
    
    /**
     * @ORM\OneToMany(targetEntity="Curso", mappedBy="nivel")
     */
    protected $cursos;
 
    /**
     * @ORM\OneToMany(targetEntity="Alumno", mappedBy="nivel")
     */
    protected $alumnos;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_ingles", type="boolean")
     */
    private $isIngles;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursos = new ArrayCollection();
        $this->alumnos = new ArrayCollection();
        $this->isIngles = true;
    }
    
    public function __toString(){
        if($this->isIngles){
            return "Nivel de ingles " . $this->getNumeroRomano();
        }else{
            return $this->nivel;
        }
    }
    
    public function getNumeroRomano(){
        switch($this->getNivel()){
            case 1: return 'I';
            case 2: return 'II';
            case 3: return 'III';
            case 4: return 'IV';
            case 5: return 'V';
            case 6: return 'VI';
            case 7: return 'VII';
            case 8: return 'VIII';
            case 9: return 'IX';
            case 10: return 'X';
            case 11: return 'XI';
            case 12: return 'XII';
            case 13: return 'XIII';
            case 14: return 'XIV';
            case 15: return 'XI';
            case 16: return 'XVI';
            case 17: return 'XVII';
            case 18: return 'XVIII';
            case 19: return 'XIX';
            case 20: return 'XX';
            case 21: return 'XXI';    
            default:
                return $this->getNivel();
        }
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
     * Set nivel
     *
     * @param string $nivel
     * @return Nivel
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set isIngles
     *
     * @param boolean $isIngles
     * @return Nivel
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
     * Add cursos
     *
     * @param \UNAM\AppBundle\Entity\Curso $cursos
     * @return Nivel
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

    /**
     * Add alumnos
     *
     * @param \UNAM\AppBundle\Entity\Alumno $alumnos
     * @return Nivel
     */
    public function addAlumno(\UNAM\AppBundle\Entity\Alumno $alumnos)
    {
        $this->alumnos[] = $alumnos;

        return $this;
    }

    /**
     * Remove alumnos
     *
     * @param \UNAM\AppBundle\Entity\Alumno $alumnos
     */
    public function removeAlumno(\UNAM\AppBundle\Entity\Alumno $alumnos)
    {
        $this->alumnos->removeElement($alumnos);
    }

    /**
     * Get alumnos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlumnos()
    {
        return $this->alumnos;
    }
    
    
}
