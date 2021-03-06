<?php

namespace UNAM\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GrupoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlumnoRepository extends EntityRepository
{
    public function getPagosPorAlumno($alumno){
        $em = $this->getEntityManager();
            $consulta = $em->createQuery(
                "SELECT p "
                . "FROM UNAMAppBundle:Pago p "
                . "JOIN p.grupo g "
                . "JOIN p.alumno a "
                . "JOIN g.curso c "
                . "JOIN g.maestro m "
                . "JOIN c.nivel n "
                . "WHERE a.id=:alumnoId "
                . "ORDER BY g.grupo ASC");
            $consulta->setParameters(array(
                'alumnoId'=>$alumno->getId()
            ));
       $resultados =  $consulta->getResult();
       return $resultados;
    }
    
    public function getOcupaciones(){
        $em = $this->getEntityManager();
            $consulta = $em->createQuery(
                "SELECT DISTINCT a.ocupacion AS a_ocupacion "
                . "FROM UNAMAppBundle:Alumno a "
                . "ORDER BY a.ocupacion ASC");
       $resultados =  $consulta->getResult();
       return $resultados;
    }
    
    public function getComoSeEnteros(){
        $em = $this->getEntityManager();
            $consulta = $em->createQuery(
                "SELECT DISTINCT a.comoSeEntero AS a_como_se_entero "
                . "FROM UNAMAppBundle:Alumno a "
                . "ORDER BY a.comoSeEntero ASC");
       $resultados =  $consulta->getResult();
       return $resultados;
    }
}
