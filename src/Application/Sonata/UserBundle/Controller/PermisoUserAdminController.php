<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PermisoUserAdminController extends CRUDController {

    public function listAction(Request $request = null) {
        $request = $this->resolveRequest($request);
        $user = $this->get('security.context')->getToken()->getUser();

        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }
        if ($user->isSuperAdmin()) {
            $preResponse = $this->preList($request);
            if ($preResponse !== null) {
                return $preResponse;
            }

            if ($listMode = $request->get('_list_mode')) {
                $this->admin->setListMode($listMode);
            }

            $datagrid = $this->admin->getDatagrid();
            $formView = $datagrid->getForm()->createView();
            $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

            return $this->render($this->admin->getTemplate('list'), array(
                        'action' => 'list',
                        'form' => $formView,
                        'datagrid' => $datagrid,
                        'csrf_token' => $this->getCsrfToken('sonata.batch'),
                            ), null, $request);
        } else {
            return new RedirectResponse($this->container->get('router')->generate('admin_sonata_user_password_list'));
        }
    }
    
    public function editAction($id = null, Request $request = null) {
        $request = $this->resolveRequest($request);
        $user = $this->get('security.context')->getToken()->getUser();

        if ($user->isSuperAdmin()) {
            $templateKey = 'edit';

            $id = $request->get($this->admin->getIdParameter());
            $object = $this->admin->getObject($id);

            if (!$object) {
                throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
            }

            if (false === $this->admin->isGranted('EDIT', $object)) {
                throw new AccessDeniedException();
            }

            $preResponse = $this->preEdit($request, $object);
            if ($preResponse !== null) {
                return $preResponse;
            }

            $this->admin->setSubject($object);

            /** @var $form \Symfony\Component\Form\Form */
            $form = $this->admin->getForm();
            $form->setData($object);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $isFormValid = $form->isValid();

                if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                    try {
                        $object = $this->admin->update($object);

                        if ($this->isXmlHttpRequest($request)) {
                            return $this->renderJson(array(
                                        'result' => 'ok',
                                        'objectId' => $this->admin->getNormalizedIdentifier($object),
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
        } else {
            return new RedirectResponse($this->container->get('router')->generate('admin_sonata_user_password_list'));
        }
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
