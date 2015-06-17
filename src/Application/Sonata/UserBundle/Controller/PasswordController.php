<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;

class PasswordController extends Controller {

    public function batchActionClone(ProxyQueryInterface $query) {

        $request = $this->get('request');
        $modelManager = $this->admin->getModelManager();
        $ids = $request->get('idx');
        $cantidad = count($ids);
        $user = $this->get('security.context')->getToken()->getUser();

        if ($cantidad > 0) {
            for ($i = 0; $i < $cantidad; $i++) {
                $target = $modelManager->find($this->admin->getClass(), $ids[$i]);

                if ($target === null) {
                    $this->addFlash('sonata_flash_error', 'No se selecciono ningun elemento');
                    return new RedirectResponse($this->admin->generateUrl('list'));
                }

                $passOrigen = $target->getPassword();
                $passDecript = $this->get('nzo_url_encryptor')->decrypt($passOrigen);
                $clonedObject = clone $target;
                $clonedObject->setPermisosUser(array());
                $clonedObject->setPermisosGrupo(array());
                $permsUser = $target->getPermisosUser();
                foreach ($permsUser as $perm) {
                    $clonedPerm = clone $perm;
                    $clonedObject->addPermisosUser($clonedPerm);
                }
                $permsGrupo = $target->getPermisosGrupo();
                foreach ($permsGrupo as $perm) {
                    $clonedPerm = clone $perm;
                    $clonedObject->addPermisosGrupo($clonedPerm);
                }
                $clonedObject->setPassword($passDecript);
                $clonedObject->setUser($user);
                $clonedObject->setTitulo($target->getTitulo() . " (Copia)");

                $this->admin->create($clonedObject);
            }
            $this->addFlash('sonata_flash_success', 'Elementos han sido duplicados');
        } else {
            $this->addFlash('sonata_flash_error', 'No se selecciono ningun elemento');
        }

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    public function editAction($id = null, Request $request = null) {

        $request = $this->resolveRequest($request);
        $templateKey = 'edit';
        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_EDITAR_ENTIDAD', $object)) {
            $this->addFlash('sonata_flash_error', 'No tienes permiso para acceder a esa url');
            return new RedirectResponse($this->container->get('router')->generate('admin_sonata_user_password_list'));
        }

        if (false === $this->admin->isGranted('EDIT', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);
        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);

        if ($this->getRestMethod($request) == 'POST') {
            $form->submit($request);
            $isFormValid = $form->isValid();

            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                try {
                    $object = $this->admin->update($object);
                    if ($this->isXmlHttpRequest($request)) {
                        return $this->renderJson(array(
                                    'result' => 'ok',
                                    'objectId' => $this->admin->getNormalizedIdentifier($object)
                                        ), 200, array(), $request);
                    }
                    $this->addFlash(
                            'sonata_flash_success', $this->admin->trans(
                                    'flash_edit_success', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                    return $this->redirectTo($object, $request);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);
                    $isFormValid = false;
                }
            }

            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest($request)) {
                    $this->addFlash(
                            'sonata_flash_error', $this->admin->trans(
                                    'flash_edit_error', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                }
            } elseif ($this->isPreviewRequested($request)) {
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }
        $view = $form->createView();
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'edit',
                    'form' => $view,
                    'object' => $object,
                        ), null, $request);
    }

    public function showAction($id = null, Request $request = null) {

        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);
        $user = $this->get('security.context')->getToken()->getUser();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        $this->admin->setSubject($object);

        if ($user->isSuperAdmin()) {
            return $this->render($this->admin->getTemplate('show'), array(
                        'action' => 'show',
                        'object' => $object,
                        'elements' => $this->admin->getShow(),
                        'editable' => 1,
                            ), null, $request);
        } else {
            return $this->render($this->admin->getTemplate('show'), array(
                        'action' => 'show',
                        'object' => $object,
                        'elements' => $this->admin->getShow(),
                            ), null, $request);
        }
    }

    protected function getActiveUser() {
        return $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
    }

    public function listAction(Request $request = null) {

        $request = $this->resolveRequest($request);

        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        if ($listMode = $request->get('_list_mode')) {
            $this->admin->setListMode($listMode);
        }

        $datagrid = $this->admin->getDatagrid();
        $filters = $request->get('filter');

        if (!$filters || !array_key_exists('context', $filters)) {
            $context = $this->admin->getPersistentParameter('context', 'default');
        } else {
            $context = $filters['context']['value'];
        }

        $datagrid->setValue('context', null, $context);
        $category = $this->container->get('sonata.classification.manager.category')->getRootCategory($context);

        if (!$filters) {
            $datagrid->setValue('category', null, $category->getId());
        }

        if ($request->get('category')) {
            $contextInCategory = $this->container->get('sonata.classification.manager.category')->findBy(array(
                'id' => (int) $request->get('category'),
                'context' => $context
            ));

            if (!empty($contextInCategory)) {
                $datagrid->setValue('category', null, $request->get('category'));
            } else {
                $datagrid->setValue('category', null, $category->getId());
            }
        }

        $formView = $datagrid->getForm()->createView();
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
                    'action' => 'list',
                    'form' => $formView,
                    'datagrid' => $datagrid,
                    'root_category' => $category,
                    'csrf_token' => $this->getCsrfToken('sonata.batch')
        ));
    }

    public function deleteAction($id, Request $request = null) {

        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_BORRAR_ENTIDAD', $object)) {
            $this->addFlash('sonata_flash_error', 'No tienes permiso para borrar esta clave');
            return new RedirectResponse($this->container->get('router')->generate('admin_sonata_user_password_list'));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        if ($this->getRestMethod($request) == 'DELETE') {

            $this->validateCsrfToken('sonata.delete', $request);
            $objectName = $this->admin->toString($object);

            try {

                $this->admin->delete($object);

                if ($this->isXmlHttpRequest($request)) {
                    return $this->renderJson(array('result' => 'ok'), 200, array(), $request);
                }
                $this->addFlash(
                        'sonata_flash_success', $this->admin->trans(
                                'flash_delete_success', array('%name%' => $this->escapeHtml($objectName)), 'SonataAdminBundle'
                        )
                );
            } catch (ModelManagerException $e) {

                $this->handleModelManagerException($e);

                if ($this->isXmlHttpRequest($request)) {
                    return $this->renderJson(array('result' => 'error'), 200, array(), $request);
                }

                $this->addFlash(
                        'sonata_flash_error', $this->admin->trans(
                                'flash_delete_error', array('%name%' => $this->escapeHtml($objectName)), 'SonataAdminBundle'
                        )
                );
            }

            return $this->redirectTo($object, $request);
        }

        return $this->render($this->admin->getTemplate('delete'), array(
                    'object' => $object,
                    'action' => 'delete',
                    'csrf_token' => $this->getCsrfToken('sonata.delete')
                        ), null, $request);
    }

    public function batchActionDelete(ProxyQueryInterface $query) {

        if (false === $this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }

        $request = $this->get('request');
        $modelManager = $this->admin->getModelManager();
        $ids = $request->get('idx');
        $cantidad = count($ids);
        $mensaje = false;

        try {
            if ($cantidad > 0) {
                for ($i = 0; $i < $cantidad; $i++) {
                    $target = $modelManager->find($this->admin->getClass(), $ids[$i]);

                    if (false === $this->get('security.context')->isGranted('ROLE_BORRAR_ENTIDAD', $target)) {
                        $this->addFlash('sonata_flash_error', 'No tienes permiso para borrar el elemento ' . $target->getTitulo() . '.');
                    } else {
                        $this->admin->delete($target);
                        $mensaje = true;
                    }
                }
                if ($mensaje) {
                    $this->addFlash('sonata_flash_success', 'Elementos han sido eliminados');
                }
                return new RedirectResponse($this->admin->generateUrl('list'));
            } else {
                $this->addFlash('sonata_flash_error', 'No se selecciono ningun elemento');
                return new RedirectResponse($this->admin->generateUrl('list'));
            }
        } catch (ModelManagerException $e) {
            $this->handleModelManagerException($e);
            $this->addFlash('sonata_flash_error', 'flash_batch_delete_error');
        }

        return new RedirectResponse($this->admin->generateUrl('list', array('filter' => $this->admin->getFilterParameters())));
    }

    /**
     * @internal
     */
    private function resolveRequest(Request $request = null) {
        if (null === $request) {
            return $this->getRequest();
        }
        return $request;
    }

}
