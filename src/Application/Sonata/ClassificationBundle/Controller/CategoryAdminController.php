<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Page Admin Controller
 *
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class CategoryAdminController extends Controller {

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request = null) {
        $user = $this->admin->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        if (!$request->get('filter') && !$request->get('filters')) {
            return new RedirectResponse($this->admin->generateUrl('tree'));
        }

        if ($listMode = $request->get('_list_mode')) {
            $this->admin->setListMode($listMode);
        }

        $datagrid = $this->admin->getDatagrid();

        if ($this->admin->getPersistentParameter('context')) {
            $datagrid->setValue('context', null, $this->admin->getPersistentParameter('context'));
        }

        $formView = $datagrid->getForm()->createView();

        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        if ($user->isSuperAdmin()) {
            return $this->render($this->admin->getTemplate('list'), array(
                        'action' => 'list',
                        'form' => $formView,
                        'datagrid' => $datagrid,
                        'csrf_token' => $this->getCsrfToken('sonata.batch'),
            ));
        } else {
            return $this->render($this->admin->getTemplate('list'), array(
                        'action' => 'list',
                        'form' => $formView,
                        'datagrid' => $datagrid,
                        'csrf_token' => $this->getCsrfToken('sonata.batch'),
                        'borrarDisable' => '1',
            ));
        }
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function treeAction(Request $request) {
        $categoryManager = $this->get('sonata.classification.manager.category');

        $currentContext = false;
        if ($context = $request->get('context')) {
            $currentContext = $this->get('sonata.classification.manager.context')->find($context);
        }

        $rootCategories = $categoryManager->getRootCategories(false);

        if (!$currentContext) {
            $mainCategory = current($rootCategories);
            $currentContext = $mainCategory->getContext();
        } else {
            foreach ($rootCategories as $category) {
                if ($currentContext->getId() != $category->getContext()->getId()) {
                    continue;
                }

                $mainCategory = $category;

                break;
            }
        }

        $datagrid = $this->admin->getDatagrid();

        if ($this->admin->getPersistentParameter('context')) {
            $datagrid->setValue('context', ChoiceType::TYPE_EQUAL, $this->admin->getPersistentParameter('context'));
        }

        $formView = $datagrid->getForm()->createView();

        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render('SonataClassificationBundle:CategoryAdmin:tree.html.twig', array(
                    'action' => 'tree',
                    'main_category' => $mainCategory,
                    'root_categories' => $rootCategories,
                    'current_context' => $currentContext,
                    'form' => $formView,
                    'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));
    }

}
