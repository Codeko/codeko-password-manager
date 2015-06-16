<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PermisoGrupoAdminController extends CRUDController {

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
