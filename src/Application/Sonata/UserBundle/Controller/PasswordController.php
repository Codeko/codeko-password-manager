<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManager;

/**
 * Password controller.
 *
 */
class PasswordController extends Controller {

    // ¿¿¿¿¿¿¿¿¿¿¿COMO MOSTRAMOS DIRECTAMENTE VISTA ESTILO MEDIA ????????????
//    /**
//     * {@inheritdoc}
//     */
//    public function render($view, array $parameters = array(), Response $response = null, Request $request = null) {
//        $parameters['media_pool'] = $this->container->get('sonata.media.pool');
//        $parameters['persistent_parameters'] = $this->admin->getPersistentParameters();
//
//        return parent::render($view, $parameters, $response, $request);
//    }

    // DEBERIA CONTROLAR EL LISTADO DE PASSWORD EN RELACION A SUS CATEGORIAS!!!!!!!!!!!!!!!!
    /**
     * {@inheritdoc}
     */
    public function listAction(Request $request = null) {

        $request = $this->resolveRequest($request);

        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        if ($listMode = $request->get('_list_mode', 'mosaic')) {
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
        ));
    }

    // FUNCION PRIVADA DE SONATAADMIN-CRUDCONTROLLER, HAY QUE LLAMARLA DESDE AQUI
    
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

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
////    public function listAction()
////    {
////        // get a Post instance
////        $post = null;
////
////        // keep in mind, this will call all registered security voters
////        if (false === $this->get('security.authorization_checker')->isGranted('view', $post)) {
////            throw new AccessDeniedException('Unauthorised access!');
////        }
////
//////        return new Response('<h1>'.$post->getName().'</h1>');
////        return new Response('<h1>prueba</h1>');
////    }
//        public function listAction()
//    {
//
////            $prj = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneById($id);
////     if (false === $this->get('security.authorization_checker')->isGranted('responsible', $prj)) {
////        throw new AccessDeniedException('Unauthorised access!');
////    }
//        
//        
////        {% if is_granted('view') %}<a href="#">Ver</a>{% endif %}
//        
//        
////        if (false === $this->get('security.authorization_checker')->isGranted('view', $post)) {
////            throw new AccessDeniedException('Unauthorised access!');
////        }
//            
//        if (false === $this->admin->isGranted('LIST')) {
//            throw new AccessDeniedException();
//        }
//        
////        if (false === $this->get('security.authorization_checker')->isGranted('view')) {
////            throw new AccessDeniedException('Unauthorised access!');
////        }
//
//        $datagrid = $this->admin->getDatagrid();
//        $formView = $datagrid->getForm()->createView();
//
//        // set the theme for the current Admin Form
//        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());
//
//        return $this->render($this->admin->getTemplate('list'), array(
//            'action'     => 'list',
//            'form'       => $formView,
//            'datagrid'   => $datagrid,
//            'csrf_token' => $this->getCsrfToken('sonata.batch'),
//        ));
//    }
}
