<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Ps\PdfBundle\Annotation\Pdf;

class DefaultController extends Controller
{
    /**
     * Lists all Curso entities.
     *
     * @Route("/", name="homepage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cursos = $em->getRepository('UNAMAppBundle:Curso')->findAll();
        $grupos = $em->getRepository('UNAMAppBundle:Grupo')->findAll();
        $maestros = $em->getRepository('UNAMAppBundle:Maestro')->findAll();
        $alumnos = $em->getRepository('UNAMAppBundle:Alumno')->findAll();
        
        $registros = array(
            'cursos' => $cursos,
            'grupos' => $grupos,
            'maestros' => $maestros,
            'alumnos' => $alumnos,
        );
        
        return array(
            'registros' => $registros,
        );
    }
    
    /**
     * Reporte de pagos por curso.
     *
     * @Route("/reporte/por/curso", name="reporte_por_curso")
     * @Method("GET")
     */
    public function reportePorCursoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //agregando funciones especiales de fecha para MySQL
        $emConfig = $em->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        
        $datos = $request->query->all();
        $curso = $em->getRepository('UNAMAppBundle:Curso')->find($datos['cursoId']);
        if($curso != null){
            $pagos = $this->getDoctrine()->getRepository('UNAMAppBundle:Curso')
                      ->getPagosPorCurso($curso, $datos['year']);
            
            $response = $this->render(
                'UNAMAppBundle:Default:list.xls.twig', array('entities' => $pagos)
            );
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="export-pagos.xls"');
            return $response;
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
        
    }
    
    /**
     * Reporte de pagos por grupo.
     *
     * @Route("/reporte/por/grupo", name="reporte_por_grupo")
     * @Method("GET")
     */
    public function reportePorGrupoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //agregando funciones especiales de fecha para MySQL
        $emConfig = $em->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        
        $datos = $request->query->all();
        $grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($datos['grupoId']);
        if($grupo != null){
            $pagos = $this->getDoctrine()->getRepository('UNAMAppBundle:Grupo')
                      ->getPagosPorGrupo($grupo, $datos['year']);
            
            $response = $this->render(
                'UNAMAppBundle:Default:list.xls.twig', array('entities' => $pagos)
            );
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="export-pagos.xls"');
            return $response;
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    
    /**
     * Reporte de pagos por maestro.
     *
     * @Route("/reporte/por/maestro", name="reporte_por_maestro")
     * @Method("GET")
     */
    public function reportePorMaestroAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //agregando funciones especiales de fecha para MySQL
        $emConfig = $em->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        
        $datos = $request->query->all();
        $maestro = $em->getRepository('UNAMAppBundle:Maestro')->find($datos['maestroId']);
        if($maestro != null){
            $pagos = $this->getDoctrine()->getRepository('UNAMAppBundle:Maestro')
                      ->getPagosPorMaestro($maestro, $datos['year']);
            
            $response = $this->render(
                'UNAMAppBundle:Default:list.xls.twig', array('entities' => $pagos)
            );
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="export-pagos.xls"');
            return $response;
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    
    /**
     * Reporte de pagos por alumno.
     *
     * @Route("/reporte/por/alumno", name="reporte_por_alumno")
     * @Method("GET")
     */
    public function reportePorAlumnoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $datos = $request->query->all();
        $alumno = $em->getRepository('UNAMAppBundle:Alumno')->find($datos['alumnoId']);
        if($alumno != null){
            $pagos = $this->getDoctrine()->getRepository('UNAMAppBundle:Alumno')
                      ->getPagosPorAlumno($alumno);
            
            $response = $this->render(
                'UNAMAppBundle:Default:list.xls.twig', array('entities' => $pagos)
            );
            $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
            $response->headers->set('Content-Disposition', 'attachment; filename="export-pagos.xls"');
            return $response;
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
	
    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        // obtiene el error de inicio de sesión si lo hay
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render(
            'UNAMAppBundle:Default:login.html.twig',
            array(
                // último nombre de usuario ingresado
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
                'ruta'          => 'login_check',
            )
        );
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }
	
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }
    
    /**
     * @Route("/curso/precio", name="curso_precio")
     * @Method("GET")
     */
    public function precioCursoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           $data = $request->query->all();
           $em = $this->getDoctrine()->getManager();
           $grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($data['grupoId']);
           if($grupo == null){
               $datos = array('status'=>'not');
           }else{
               $curso = $grupo->getCurso();
               $datos = array(
                  'status' => 'Ok', 
                  'curso'  => $curso->getNombreCursoCompleto(),
                  'precio' => $curso->getPrecio()->getPrecio()     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
    
    /**
     * @Route("/curso/por/alumno", name="cursos_alumno")
     * @Method("GET")
     */
    public function cursosPorAlumnoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           $data = $request->query->all();
           $em = $this->getDoctrine()->getManager();
           $alumno = $em->getRepository('UNAMAppBundle:Alumno')->find($data['alumnoId']);
           if($alumno == null){
               $datos = array('status'=>'not');
           }else{
               $datos = array();
               foreach($alumno->getPagos() as $pago){
                   $gpo = array();
                   $grupo = $pago->getGrupo();
                   $curso = $grupo->getCurso();
                   $gpo['id'] = $grupo->getId();
                   $gpo['nombre'] = $grupo->getNombreGrupoCompleto() . " - " . $curso->getNombreCursoCompleto();
                   $datos[] = $gpo;
               }
               $datos = array(
                  'status' => 'Ok', 
                  'grupos'  => $datos     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
	
	/**
     * @Route("/grupo/por/curso", name="grupos_curso")
     * @Method("POST")
     */
    public function gruposPorCursoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           $data = $request->query->all();
           $em = $this->getDoctrine()->getManager();
           $curso = $em->getRepository('UNAMAppBundle:Curso')->find($data['cursoId']);
           if($curso == null){
               $datos = array('status'=>'not');
           }else{
               $datos = array();
			   $grupos = $em->getRepository('UNAMAppBundle:Grupo')->getGruposPorCurso($curso);
               foreach($grupos as $grupo){
                   $gpo['id'] = $grupo->getId();
                   $gpo['nombre'] = $grupo->getNombreGrupoCompleto() . " - " . $grupo->getCurso()->getNombreCursoCompleto();
                   $datos[] = $gpo;
               }
               $datos = array(
                  'status' => 'Ok', 
                  'grupos'  => $datos     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
    
    /**
     * @Route("/alumno/por/grupo", name="alumnos_grupo")
     * @Method("GET")
     */
    public function alumnosPorGrupoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           $data = $request->query->all();
           $em = $this->getDoctrine()->getManager();
           $grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($data['grupoId']);
           if($grupo == null){
               $datos = array('status'=>'not');
           }else{
               $datos = array();
               foreach($grupo->getPagos() as $pago){
                   $alu = array();
                   $alumno = $pago->getAlumno();
                   $alu['id'] = $alumno->getId();
                   $alu['nombre'] = $alumno->getNombreCompleto();
                   $datos[] = $alu;
               }
               $datos = array(
                  'status' => 'Ok', 
                  'alumnos'  => $datos     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
	
	/**
     * @Route("/alumno/por/no/grupo", name="alumnos_no_grupo")
     * @Method("GET")
     */
    public function alumnosPorNoGrupoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           $data = $request->query->all();
           $em = $this->getDoctrine()->getManager();
           $grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($data['grupoId']);
           if($grupo == null){
               $datos = array('status'=>'not');
           }else{
			   $alumnos = $em->getRepository('UNAMAppBundle:Grupo')->getAlumnosPorNoGrupo($grupo);
               $datos = array();
               foreach($alumnos as $alumno){
                   $alu['id'] = $alumno->getId();
                   $alu['nombre'] = $alumno->getNombreCompleto();
                   $datos[] = $alu;
               }
               $datos = array(
                  'status' => 'Ok', 
                  'alumnos'  => $datos     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
	
	/**
     * @Route("/asignacion/grupo/alumno", name="asingacion_grupo_alumno")
     * @Method("POST")
     */
    public function asignacionGrupoAlumnoAction(Request $request)
    {
        if($request->getMethod()=='GET'){
           	$data = $request->query->all();
           	$em = $this->getDoctrine()->getManager();
           	$grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($data['grupoId']);
			$alumno = $em->getRepository('UNAMAppBundle:Alumno')->find($data['alumnoId']);
           if($grupo == null && $alumno == null){
               $datos = array('status'=>'not');
           }else{
				
				$pago = new Pago();
			   $pago->setGrupo($grupo);
			   $pago->setAlumno($alumno);
			   $pago->setPrecio($grupo->getCurso()->getPrecio());
			 
				
               $datos = array(
                  'status' => 'Ok', 
                  'alumnos'  => $datos     
                );
           }
           $response = new JsonResponse($datos);
           return $response;
        }
    }
    
    /**
     * Pdf de constancia de esudios por alumno.
     *
     * @Route("/pdf/constancia/alumno", name="constancia_por_alumno")
     * @Pdf()
     */
    public function constanciaPorAlumnoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $datos = $request->query->all();
        $alumno = $em->getRepository('UNAMAppBundle:Alumno')->find($datos['alumnoId']);
        $curso = $em->getRepository('UNAMAppBundle:Curso')->find($datos['cursoId']);
        if($alumno != null && $curso != null){
            
            $datos = array(
                'alumno'=>$alumno,
                'curso'=>$curso
            );
            $format = $this->get('request')->get('_format');
            return $this->render(sprintf('UNAMAppBundle:Default:constanciaPorAlumno.%s.twig',$format), $datos
            );
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    
    /**
     * Pdf diploma de esudios por alumno.
     *
     * @Route("/pdf/diploma/alumno", name="diploma_por_alumno")
     * @Pdf()
     */
    public function diplomaPorAlumnoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $datos = $request->query->all();
        $alumno = $em->getRepository('UNAMAppBundle:Alumno')->find($datos['alumnoId']);
        $curso = $em->getRepository('UNAMAppBundle:Curso')->find($datos['cursoId']);
        if($alumno != null && $curso != null){
            
            $datos = array(
                'alumno'=>$alumno,
                'curso'=>$curso
            );
            $format = $this->get('request')->get('_format');
            return $this->render(sprintf('UNAMAppBundle:Default:diplomaPorAlumno.%s.twig',$format), $datos
            );
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
    
    /**
     * Pdf diplomas por grupo.
     *
     * @Route("/pdf/diploma/grupo", name="diplomas_por_grupo")
     * @Pdf()
     */
    public function diplomaPorGrupoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $datos = $request->query->all();
        $grupo = $em->getRepository('UNAMAppBundle:Grupo')->find($datos['grupoId']);
        if($grupo != null){
            
            $datos = array(
                'pagos'=>$grupo->getPagos(),
                'grupo'=>$grupo,
                'curso'=>$grupo->getCurso()
            );
            $format = $this->get('request')->get('_format');
            $response = $this->render(sprintf('UNAMAppBundle:Default:diplomaPorGrupo.%s.twig',$format), $datos
            );
            return $response;
        }else{
            return $this->redirect($this->generateUrl('homepage'));
        }
    }
}
