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
 
    
}
