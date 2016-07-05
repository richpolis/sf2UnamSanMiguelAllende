<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAM\AppBundle\Entity\Calificacion;
use UNAM\AppBundle\Form\CalificacionType;

/**
 * Calificacion controller.
 *
 * @Route("/calificaciones")
 */
class CalificacionController extends Controller
{

    /**
     * Lists all Calificacion entities.
     *
     * @Route("/", name="calificaciones")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAMAppBundle:Calificacion')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Calificacion entity.
     *
     * @Route("/", name="calificaciones_create")
     * @Method("POST")
     * @Template("UNAMAppBundle:Calificacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Calificacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Calificacion entity.
     *
     * @param Calificacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Calificacion $entity)
    {
        $form = $this->createForm(new CalificacionType(), $entity, array(
            'action' => $this->generateUrl('calificaciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Calificacion entity.
     *
     * @Route("/new", name="calificaciones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Calificacion();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Calificacion entity.
     *
     * @Route("/{id}", name="calificaciones_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Calificacion entity.
     *
     * @Route("/{id}/edit", name="calificaciones_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
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
    * Creates a form to edit a Calificacion entity.
    *
    * @param Calificacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Calificacion $entity)
    {
        $form = $this->createForm(new CalificacionType(), $entity, array(
            'action' => $this->generateUrl('calificaciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Calificacion entity.
     *
     * @Route("/{id}", name="calificaciones_update")
     * @Method("PUT")
     * @Template("UNAMAppBundle:Calificacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Calificacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Calificacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('calificaciones_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Calificacion entity.
     *
     * @Route("/{id}", name="calificaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAMAppBundle:Calificacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Calificacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('calificaciones'));
    }

    /**
     * Creates a form to delete a Calificacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('calificaciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
