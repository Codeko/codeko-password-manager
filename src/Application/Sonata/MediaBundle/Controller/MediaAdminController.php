<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\MediaBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MediaAdminController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function createAction(Request $request = null) {
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        if (!$request->get('provider') && $request->isMethod('get')) {
            return $this->render('SonataMediaBundle:MediaAdmin:select_provider.html.twig', array(
                        'providers' => $this->get('sonata.media.pool')->getProvidersByContext($this->get('request')->get('context', $this->get('sonata.media.pool')->getDefaultContext())),
                        'base_template' => $this->getBaseTemplate(),
                        'admin' => $this->admin,
                        'action' => 'create'
            ));
        }

        return parent::createAction();
    }

    public function batchActionDelete(ProxyQueryInterface $query) {
        if (false === $this->admin->isGranted('DELETE')) {
            throw new AccessDeniedException();
        }

        $request = $this->get('request');
        $modelManager = $this->admin->getModelManager();
        $ids = $request->get('idx');
        $cantidad = count($ids);
        $connection = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager()->getConnection();

        if ($cantidad > 0) {
            for ($i = 0; $i < $cantidad; $i++) {
                $sql = "DELETE FROM media__media WHERE id = " . $ids[$i];
                $statement = $connection->prepare($sql);
                $statement->execute();
                $this->addFlash('sonata_flash_success', 'flash_batch_delete_success');
            }
        } else {
            $this->addFlash('sonata_flash_error', 'flash_batch_delete_error');
        }

        return new RedirectResponse($this->admin->generateUrl(
                        'list', array('filter' => $this->admin->getFilterParameters())
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function render($view, array $parameters = array(), Response $response = null, Request $request = null) {
        $parameters['media_pool'] = $this->container->get('sonata.media.pool');
        $parameters['persistent_parameters'] = $this->admin->getPersistentParameters();

        return parent::render($view, $parameters, $response, $request);
    }

    /**
     * {@inheritdoc}
     */
    public function listAction(Request $request = null) {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        if ($listMode = $request->get('_list_mode')) {
            $this->admin->setListMode($listMode);
        }

        $datagrid = $this->admin->getDatagrid();

        $filters = $request->get('filter');

        // set the default context
        if (!$filters || !array_key_exists('context', $filters)) {
            $context = $this->admin->getPersistentParameter('context', $this->get('sonata.media.pool')->getDefaultContext());
        } else {
            $context = $filters['context']['value'];
        }

        $datagrid->setValue('context', null, $context);

        // retrieve the main category for the tree view
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

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
                    'action' => 'list',
                    'form' => $formView,
                    'datagrid' => $datagrid,
                    'root_category' => $category,
                    'csrf_token' => $this->getCsrfToken('sonata.batch'),
                    'no_action' => true,
        ));
    }

    /**
     * Delete action
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function deleteAction($id, Request $request = null) {
        $request = $this->resolveRequest($request);
        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('DELETE', $object)) {
            throw new AccessDeniedException();
        }

        $preResponse = $this->preDelete($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }

        if ($this->getRestMethod($request) === 'DELETE') {
            // check the csrf token
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
                    'csrf_token' => $this->getCsrfToken('sonata.delete'),
                        ), null, $request);
    }

    /**
     * Edit action
     *
     * @param int|string|null $id
     * @param Request         $request
     *
     * @return Response|RedirectResponse
     *
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function editAction($id = null, Request $request = null) {
        $request = $this->resolveRequest($request);
        // the key used to lookup the template
        $templateKey = 'edit';

        $id = $request->get($this->admin->getIdParameter());
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->get('security.context')->isGranted('ROLE_EDITAR_MULTIMEDIA', $object)) {
            //Controlar Voters
            throw new AccessDeniedException('No eres el propietario para editar este archivo');
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

            // persist if the form was valid and if in preview mode the preview was approved
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

                    // redirect to edit mode
                    return $this->redirectTo($object, $request);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest($request)) {
                    $this->addFlash(
                            'sonata_flash_error', $this->admin->trans(
                                    'flash_edit_error', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                }
            } elseif ($this->isPreviewRequested($request)) {
                // enable the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'edit',
                    'form' => $view,
                    'object' => $object,
                        ), null, $request);
    }

    /**
     * To keep backwards compatibility with older Sonata Admin code.
     *
     * @internal
     */
    private function resolveRequest(Request $request = null) {
        if (null === $request) {
            return $this->getRequest();
        }
        return $request;
    }

}
