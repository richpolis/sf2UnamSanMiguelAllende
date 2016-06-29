<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    
    protected function getFilters() {
        return $this->get('session')->get('filters', array());
    }
    
    protected function setFilters($filtros) {
        $this->get('session')->set('filters', $filtros);
    }
    
    public function getNombreMes($month) {
        switch ($month) {
            case 1: return "Enero";
            case 2: return "Febrero";
            case 3: return "Marzo";
            case 4: return "Abril";
            case 5: return "Mayo";
            case 6: return "Junio";
            case 7: return "Julio";
            case 8: return "Agosto";
            case 9: return "Septiembre";
            case 10: return "Octubre";
            case 11: return "Noviembre";
            case 12: return "Diciembre";
        }
    }
    
    protected function setSecurePassword(&$entity) {
        // encoder
        $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
        $passwordCodificado = $encoder->encodePassword(
                    $entity->getPassword(),
                    $entity->getSalt()
        );
        $entity->setPassword($passwordCodificado);
    }
    
    protected function enviarCambioHorarioEmail($grupo, $nuevo_horario, $body) {
        $asunto = 'Cambio de horario de curso:  ' . $grupo->getCurso();
        $cuerpo = '<p>' . $body . '</p>';
        $isNew = true;
        $message = \Swift_Message::newInstance()
                ->setSubject($asunto)
                ->setFrom($this->container->getParameter('richpolis.emails.to_email'))
                ->setTo($this->getArrayEmailAlumnos($grupo->getPagos()))
                ->setBody(
                $this->renderView('UNAMAppBundle:Default:enviarCorreo.html.twig', 
                        compact('asunto','cuerpo','nuevo_horario')), 
                'text/html'
                );
        $this->get('mailer')->send($message);
    }
    
    protected function getArrayEmailAlumnos($pagos){
        $emails = array();
        foreach($pagos as $pago){
            $email = $pago->getAlumno()->getEmail();
            $emails[]=$email;
        }
        return $emails;
    }
}