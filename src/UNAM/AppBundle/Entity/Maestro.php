<?php

namespace UNAM\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maestro
 *
 * @ORM\Table(name="maestros")
 * @ORM\Entity(repositoryClass="UNAM\AppBundle\Repository\MaestroRepository")
 */
class Maestro
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
     * @ORM\Column(name="nombre", type="string", length=150)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoPaterno", type="string", length=150)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidoMaterno", type="string", length=150)
     */
    private $apellidoMaterno;

    /**
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="maestro")
     */
    protected $grupos;
    
}
