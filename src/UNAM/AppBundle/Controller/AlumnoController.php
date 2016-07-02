<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use UNAM\AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAM\AppBundle\Entity\Alumno;
use UNAM\AppBundle\Form\AlumnoType;

/**
 * Alumno controller.
 *
 * @Route("/alumnos")
 */
class AlumnoController extends BaseController
{

    /**
     * Lists all Alumno entities.
     *
     * @Route("/", name="alumnos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAMAppBundle:Alumno')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Alumno entity.
     *
     * @Route("/", name="alumnos_create")
     * @Method("POST")
     * @Template("UNAMAppBundle:Alumno:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Alumno();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('alumnos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'ocupaciones' => $this->getOcupaciones($em),
            'como_se_enteros' => $this->getComoSeEnteros($em)
        );
    }

    /**
     * Creates a form to create a Alumno entity.
     *
     * @param Alumno $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Alumno $entity)
    {
        $form = $this->createForm(new AlumnoType(), $entity, array(
            'action' => $this->generateUrl('alumnos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Alumno entity.
     *
     * @Route("/new", name="alumnos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Alumno();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'ocupaciones' => $this->getOcupaciones($em),
            'como_se_enteros' => $this->getComoSeEnteros($em)
        );
    }

    /**
     * Finds and displays a Alumno entity.
     *
     * @Route("/{id}", name="alumnos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Alumno entity.
     *
     * @Route("/{id}/edit", name="alumnos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'ocupaciones' => $this->getOcupaciones($em),
            'como_se_enteros' => $this->getComoSeEnteros($em)
        );
    }

    /**
    * Creates a form to edit a Alumno entity.
    *
    * @param Alumno $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Alumno $entity)
    {
        $form = $this->createForm(new AlumnoType(), $entity, array(
            'action' => $this->generateUrl('alumnos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Alumno entity.
     *
     * @Route("/{id}", name="alumnos_update")
     * @Method("PUT")
     * @Template("UNAMAppBundle:Alumno:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Alumno')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Alumno entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('alumnos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'ocupaciones' => $this->getOcupaciones($em),
            'como_se_enteros' => $this->getComoSeEnteros($em)
        );
    }
    /**
     * Deletes a Alumno entity.
     *
     * @Route("/{id}", name="alumnos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAMAppBundle:Alumno')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Alumno entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('alumnos'));
    }

    /**
     * Creates a form to delete a Alumno entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumnos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    private function getOcupaciones(&$em){
        $ocupacionesDefault = array(
            'ESTUDIANTE',
            'MAESTRO',
            'COMERCIANTE',
            'CONTADOR'
        );
        $ocupaciones = $em->getRepository('UNAMAppBundle:Alumno')->getOcupaciones();
        $ocupacionesArray = array();
        foreach($ocupaciones as $ocupacion){
            if(strlen($ocupacion['a_ocupacion'])>0)
                $ocupacionesArray[]=$ocupacion['a_ocupacion'];
        }
        $aOcupaciones = array_merge($ocupacionesArray, $ocupacionesDefault);
        sort($aOcupaciones);
        return array_unique($aOcupaciones);
        
    }
    
    private function getComoSeEnteros(&$em){
        $ocupacionesDefault = array(
            'RADIO',
            'PERIODICO',
            'INTERNET',
            'FACEBOOK'
        );
        $ocupaciones = $em->getRepository('UNAMAppBundle:Alumno')->getComoSeEnteros();
        $ocupacionesArray = array();
        foreach($ocupaciones as $ocupacion){
            if(strlen($ocupacion['a_como_se_entero'])>0)
                $ocupacionesArray[]=$ocupacion['a_como_se_entero'];
        }
        $aOcupaciones = array_merge($ocupacionesArray, $ocupacionesDefault);
        sort($aOcupaciones);
        return array_unique($aOcupaciones);
        
    }
}
