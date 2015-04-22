<?php

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Application\Sonata\UserBundle\Entity\Password;
use Application\Sonata\UserBundle\Form\PasswordType;

/**
 * Password controller.
 *
 */
class PasswordController extends Controller
{

    /**
     * Lists all Password entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ApplicationSonataUserBundle:Password')->findAll();

        return $this->render('ApplicationSonataUserBundle:Password:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Password entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Password();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('managePass_show', array('id' => $entity->getId())));
        }

        return $this->render('ApplicationSonataUserBundle:Password:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Password entity.
     *
     * @param Password $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Password $entity)
    {
        $form = $this->createForm(new PasswordType(), $entity, array(
            'action' => $this->generateUrl('managePass_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Password entity.
     *
     */
    public function newAction()
    {
        $entity = new Password();
        $form   = $this->createCreateForm($entity);

        return $this->render('ApplicationSonataUserBundle:Password:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Password entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:Password')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Password entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplicationSonataUserBundle:Password:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Password entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:Password')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Password entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ApplicationSonataUserBundle:Password:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Password entity.
    *
    * @param Password $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Password $entity)
    {
        $form = $this->createForm(new PasswordType(), $entity, array(
            'action' => $this->generateUrl('managePass_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Password entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ApplicationSonataUserBundle:Password')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Password entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('managePass_edit', array('id' => $id)));
        }

        return $this->render('ApplicationSonataUserBundle:Password:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Password entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ApplicationSonataUserBundle:Password')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Password entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('managePass'));
    }

    /**
     * Creates a form to delete a Password entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('managePass_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
