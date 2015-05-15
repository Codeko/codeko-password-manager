<?php

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\Sonata\UserBundle\Entity\TipoPass;
use Application\Sonata\UserBundle\Form\TipoPassType;

/**
 * TipoPass controller.
 *
 */
class TipoPassController extends Controller
{

    /**
     * Lists all TipoPass entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplicationSonataUserBundle:TipoPass')->findAll();

        return $this->render('ApplicationSonataUserBundle:TipoPass:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TipoPass entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TipoPass();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipopass_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplicationSonataUserBundle:TipoPass:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TipoPass entity.
     *
     * @param TipoPass $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoPass $entity)
    {
        $form = $this->createForm(new TipoPassType(), $entity, array(
            'action' => $this->generateUrl('tipopass_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoPass entity.
     *
     */
    public function newAction()
    {
        $entity = new TipoPass();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplicationSonataUserBundle:TipoPass:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TipoPass entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:TipoPass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoPass entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplicationSonataUserBundle:TipoPass:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TipoPass entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:TipoPass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoPass entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplicationSonataUserBundle:TipoPass:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TipoPass entity.
    *
    * @param TipoPass $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoPass $entity)
    {
        $form = $this->createForm(new TipoPassType(), $entity, array(
            'action' => $this->generateUrl('tipopass_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoPass entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:TipoPass')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoPass entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipopass_edit', array('id' => $id)));
        }

        return $this->render('ApplicationSonataUserBundle:TipoPass:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TipoPass entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplicationSonataUserBundle:TipoPass')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoPass entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipopass'));
    }

    /**
     * Creates a form to delete a TipoPass entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipopass_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
