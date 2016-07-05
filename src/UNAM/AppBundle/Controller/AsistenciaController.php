<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAM\AppBundle\Entity\Asistencia;
use UNAM\AppBundle\Form\AsistenciaType;

/**
 * Asistencia controller.
 *
 * @Route("/asistencias")
 */
class AsistenciaController extends Controller
{

    /**
     * Lists all Asistencia entities.
     *
     * @Route("/", name="asistencias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAMAppBundle:Asistencia')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Asistencia entity.
     *
     * @Route("/", name="asistencias_create")
     * @Method("POST")
     * @Template("UNAMAppBundle:Asistencia:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Asistencia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('asistencias_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Asistencia entity.
     *
     * @param Asistencia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Asistencia $entity)
    {
        $form = $this->createForm(new AsistenciaType(), $entity, array(
            'action' => $this->generateUrl('asistencias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Asistencia entity.
     *
     * @Route("/new", name="asistencias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Asistencia();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Asistencia entity.
     *
     * @Route("/{id}", name="asistencias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Asistencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asistencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Asistencia entity.
     *
     * @Route("/{id}/edit", name="asistencias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Asistencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asistencia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Asistencia entity.
    *
    * @param Asistencia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Asistencia $entity)
    {
        $form = $this->createForm(new AsistenciaType(), $entity, array(
            'action' => $this->generateUrl('asistencias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Asistencia entity.
     *
     * @Route("/{id}", name="asistencias_update")
     * @Method("PUT")
     * @Template("UNAMAppBundle:Asistencia:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Asistencia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Asistencia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('asistencias_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Asistencia entity.
     *
     * @Route("/{id}", name="asistencias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAMAppBundle:Asistencia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Asistencia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('asistencias'));
    }

    /**
     * Creates a form to delete a Asistencia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('asistencias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
