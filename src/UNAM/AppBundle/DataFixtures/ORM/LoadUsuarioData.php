<?php

/*
 * Modificado por Ricardo Alcantara <richpolis@gmail.com>
 */

namespace UNAM\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UNAM\AppBundle\Entity\Usuario;

/**
 * Fixtures de la entidad Usuario.
 */
class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 10;
    }
    
	private $container;
	
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
	public function load(ObjectManager $manager)
    {
       
        // Superadmin
        $superadmin = new Usuario();
        
        //$superadmin->setUsername('admin');
        $superadmin->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $passwordEnClaro = 'D3m3s1s1';
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($superadmin);
        $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $superadmin->getSalt());
        $superadmin->setPassword($passwordCodificado);
        $superadmin->setNombre("Ricardo");
		$superadmin->setApellido("Alcantara Gomez");
        $superadmin->setEmail('richpolis@gmail.com');
        $manager->persist($superadmin);
		
        $manager->flush();
    }
    
}