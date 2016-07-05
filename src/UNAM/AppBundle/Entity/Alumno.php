<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Alumno
 *
 * @ORM\Table(name="alumnos")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\AlumnoRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=100)
     */
    private $telefono;
    
    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="text")
     */
    private $domicilio;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inscripcion", type="date", nullable=false)
     */
    private $fechaInscripcion;
    
    /**
     * @var \Booolean
     *
     * @ORM\Column(name="is_has_beca", type="boolean",nullable=true)
     */
    private $isBeca = false;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="integer", length=20)
     */
    private $identificacion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255)
     */
    private $ocupacion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="como_se_entero", type="string", length=255)
     */
    private $comoSeEntero;
    
    /**
     * @ORM\OneToMany(targetEntity="Pago", mappedBy="alumno")
     */
    protected $pagos;
    
    /**
     * @ORM\OneToMany(targetEntity="Calificacion", mappedBy="alumno")
     */
    protected $calificaciones;
    
    /**
     * @ORM\OneToMany(targetEntity="Asistencia", mappedBy="alumno")
     */
    protected $asistencias;
    
    /**
     * @var \Booolean
     *
     * @ORM\Column(name="is_active", type="boolean",nullable=true)
     */
    private $isActive = true;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;
    
    
    

    /*
     * Timestable
     */
    
    /**
     ** @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
          $this->createdAt = new \DateTime();
        }
        if(!$this->getUpdatedAt())
        {
          $this->updatedAt = new \DateTime();
        }
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    
    
    /*** uploads ***/
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->imagen)) {
            // store the old name to delete after the update
            $this->temp = $this->imagen;
            $this->imagen = null;
        } else {
            $this->imagen = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function preUpload()
    {
      if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imagen = $filename.'.'.$this->getFile()->guessExtension();
        }
    }
    
    /**
    * @ORM\PostPersist
    * @ORM\PostUpdate
    */
    public function upload()
    {
      if (null === $this->getFile()) {
            return;
        }
        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->imagen);
        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    
    /**
    * @ORM\PostRemove
    */
    public function removeUpload()
    {
      if ($file = $this->getAbsolutePath()) {
        if(file_exists($file)){
            unlink($file);
        }
      }
    }
    
    protected function getUploadDir()
    {
        return '/uploads/alumnos';
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return null === $this->imagen ? $this->getUploadDir().'/no-user.png' : $this->getUploadDir().'/'.$this->imagen;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->imagen ? null : $this->getUploadRootDir().'/'.$this->imagen;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pagos = new ArrayCollection();
        $this->calificaciones = new ArrayCollection();
        $this->asistencias = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->getNombreCompleto();
    }
    
    public function getNombreCompleto(){
        return $this->nombre . " " . $this->apellidoPadre . " " . $this->apellidoMadre;
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
     * Set imagen
     *
     * @param string $imagen
     * @return Alumno
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
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
     * Set telefono
     *
     * @param string $telefono
     * @return Alumno
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
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
     * Set fechaInscripcion
     *
     * @param \DateTime $fechaInscripcion
     * @return Alumno
     */
    public function setFechaInscripcion($fechaInscripcion)
    {
        $this->fechaInscripcion = $fechaInscripcion;

        return $this;
    }

    /**
     * Get fechaInscripcion
     *
     * @return \DateTime 
     */
    public function getFechaInscripcion()
    {
        return $this->fechaInscripcion;
    }

    /**
     * Set isBeca
     *
     * @param boolean $isBeca
     * @return Alumno
     */
    public function setIsBeca($isBeca)
    {
        $this->isBeca = $isBeca;

        return $this;
    }

    /**
     * Get isBeca
     *
     * @return boolean 
     */
    public function getIsBeca()
    {
        return $this->isBeca;
    }

    /**
     * Set identificacion
     *
     * @param integer $identificacion
     * @return Alumno
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return integer 
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     * @return Alumno
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string 
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set comoSeEntero
     *
     * @param string $comoSeEntero
     * @return Alumno
     */
    public function setComoSeEntero($comoSeEntero)
    {
        $this->comoSeEntero = $comoSeEntero;

        return $this;
    }

    /**
     * Get comoSeEntero
     *
     * @return string 
     */
    public function getComoSeEntero()
    {
        return $this->comoSeEntero;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Alumno
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Alumno
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Alumno
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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

    /**
     * Add calificaciones
     *
     * @param \UNAM\AppBundle\Entity\Calificacion $calificaciones
     * @return Alumno
     */
    public function addCalificacione(\UNAM\AppBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones[] = $calificaciones;

        return $this;
    }

    /**
     * Remove calificaciones
     *
     * @param \UNAM\AppBundle\Entity\Calificacion $calificaciones
     */
    public function removeCalificacione(\UNAM\AppBundle\Entity\Calificacion $calificaciones)
    {
        $this->calificaciones->removeElement($calificaciones);
    }

    /**
     * Get calificaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCalificaciones()
    {
        return $this->calificaciones;
    }

    /**
     * Add asistencias
     *
     * @param \UNAM\AppBundle\Entity\Asistencia $asistencias
     * @return Alumno
     */
    public function addAsistencia(\UNAM\AppBundle\Entity\Asistencia $asistencias)
    {
        $this->asistencias[] = $asistencias;

        return $this;
    }

    /**
     * Remove asistencias
     *
     * @param \UNAM\AppBundle\Entity\Asistencia $asistencias
     */
    public function removeAsistencia(\UNAM\AppBundle\Entity\Asistencia $asistencias)
    {
        $this->asistencias->removeElement($asistencias);
    }

    /**
     * Get asistencias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAsistencias()
    {
        return $this->asistencias;
    }
}