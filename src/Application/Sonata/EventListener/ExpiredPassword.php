<?php

namespace Application\Sonata\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Service("request.set_messages_count_listener")
 *
 */
class ExpiredPassword {

    private $security_context;
    private $router;
    private $session;

    public function __construct(Router $router, SecurityContext $security_context, Session $session) {
        $this->security_context = $security_context;
        $this->router = $router;
        $this->session = $session;
    }

    public function onCheckExpired(GetResponseEvent $event) {
//        if (($this->security_context->getToken() ) && ( $this->security_context->isGranted('IS_AUTHENTICATED_FULLY') )) {
//            
//            /* Comprobacion de fecha de caducidad */
//            
//                $today = new \DateTime();
//                $expira = $this->security_context->getToken()->getUser()->getPasswordChangedAt()->diff($today);
//                //$expira = $this->security_context->getToken()->getUser()->getPasswordChangedAt()->diff($today);
//                
//                if ($expira->format('%a') < 0) {
//                    
//                    $this->session->getFlashBag()->add('sonata_flash_error', 'Su clave ha caducado');
//                    
//                }
//        }
    }

}
