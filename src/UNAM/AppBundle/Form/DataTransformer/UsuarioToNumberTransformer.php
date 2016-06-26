<?php 

namespace UNAM\AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use UNAM\AppBundle\Entity\Usuario;

class UsuarioToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($usuario)
    {
        if (null === $usuario) {
            return "";
        }
        return $usuario->getId();
    }
    /**
     * Transforms a string (number) to an object (usuario).
     *
     * @param  string $number
     *
     * @return Comentario|null
     *
     * @throws TransformationFailedException if object (usuario) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }
        $usuario = $this->om
            ->getRepository('UNAMAppBundle:Usuario')
            ->find($number);
        ;
        if (null === $usuario) {
            throw new TransformationFailedException(sprintf(
                'An Residencial with id "%s" does not exist!',
                $number
            ));
        }
        return $usuario;
    }

}