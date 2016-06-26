<?php

namespace UNAM\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GrupoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GrupoRepository extends EntityRepository
{
    public function getPagosPorGrupo($grupo, $year){
        $em = $this->getEntityManager();
            $consulta = $em->createQuery(
                "SELECT p "
                . "FROM UNAMAppBundle:Pago p "
                . "JOIN p.grupo g "
                . "JOIN p.alumno a "
                . "JOIN g.curso c "
                . "JOIN g.maestro m "
                . "JOIN c.nivel n "
                . "WHERE g.grupo=:grupo "
                . "AND YEAR(g.fechaInicio)>=:year "
                . "ORDER BY g.grupo ASC");
            $consulta->setParameters(array(
                'grupo'=>$grupo,
                'year'=>$year
            ));
       $resultados =  $consulta->getResult();
       return $resultados;
    }
    
    public function getGruposPorNombre(){
        $em = $this->getEntityManager();
            $consulta = $em->createQuery(
                "SELECT DISTINCT g.grupo "
                . "FROM UNAMAppBundle:Grupo g "
                . "ORDER BY g.grupo ASC");
       $resultados =  $consulta->getResult();
       return $resultados;
    }
}
