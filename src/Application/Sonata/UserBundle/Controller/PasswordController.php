<?php

namespace Application\Sonata\UserBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManager; 

/**
 * Password controller.
 *
 */
class PasswordController extends Controller {

//    public function listAction()
//    {
//        // get a Post instance
//        $post = null;
//
//        // keep in mind, this will call all registered security voters
//        if (false === $this->get('security.authorization_checker')->isGranted('view', $post)) {
//            throw new AccessDeniedException('Unauthorised access!');
//        }
//
////        return new Response('<h1>'.$post->getName().'</h1>');
//        return new Response('<h1>prueba</h1>');
//    }
        public function listAction()
    {

//            $prj = $this->getDoctrine()->getRepository('AppBundle:Project')->findOneById($id);
//     if (false === $this->get('security.authorization_checker')->isGranted('responsible', $prj)) {
//        throw new AccessDeniedException('Unauthorised access!');
//    }
        
        
//        {% if is_granted('view') %}<a href="#">Ver</a>{% endif %}
        
        
//        if (false === $this->get('security.authorization_checker')->isGranted('view', $post)) {
//            throw new AccessDeniedException('Unauthorised access!');
//        }
            
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }
        
//        if (false === $this->get('security.authorization_checker')->isGranted('view')) {
//            throw new AccessDeniedException('Unauthorised access!');
//        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));
    }
}
