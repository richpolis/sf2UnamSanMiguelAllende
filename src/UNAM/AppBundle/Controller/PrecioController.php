<?php

namespace UNAM\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UNAM\AppBundle\Entity\Precio;
use UNAM\AppBundle\Form\PrecioType;

/**
 * Precio controller.
 *
 * @Route("/precios")
 */
class PrecioController extends Controller
{

    /**
     * Lists all Precio entities.
     *
     * @Route("/", name="precios")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UNAMAppBundle:Precio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Precio entity.
     *
     * @Route("/", name="precios_create")
     * @Method("POST")
     * @Template("UNAMAppBundle:Precio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Precio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('precios_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Precio entity.
     *
     * @param Precio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Precio $entity)
    {
        $form = $this->createForm(new PrecioType(), $entity, array(
            'action' => $this->generateUrl('precios_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Precio entity.
     *
     * @Route("/new", name="precios_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Precio();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Precio entity.
     *
     * @Route("/{id}", name="precios_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Precio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Precio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Precio entity.
     *
     * @Route("/{id}/edit", name="precios_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Precio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Precio entity.');
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
    * Creates a form to edit a Precio entity.
    *
    * @param Precio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Precio $entity)
    {
        $form = $this->createForm(new PrecioType(), $entity, array(
            'action' => $this->generateUrl('precios_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Precio entity.
     *
     * @Route("/{id}", name="precios_update")
     * @Method("PUT")
     * @Template("UNAMAppBundle:Precio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UNAMAppBundle:Precio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Precio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('precios_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Precio entity.
     *
     * @Route("/{id}", name="precios_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UNAMAppBundle:Precio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Precio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('precios'));
    }

    /**
     * Creates a form to delete a Precio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('precios_delete', array('id' => $id)))
            ->setMethod('DELETE')
            //->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
