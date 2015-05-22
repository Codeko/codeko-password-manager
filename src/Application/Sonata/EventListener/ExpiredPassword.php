<?php

namespace Application\Sonata\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;
use Application\Sonata\UserBundle\Entity\Password;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Service("request.set_messages_count_listener")
 *
 */
class ExpiredPassword {

    private $security_context;
    private $router;
    private $session;
    private $em;

    public function __construct(Router $router, SecurityContext $security_context, Session $session, EntityManager $entityManager) {
        $this->security_context = $security_context;
        $this->router = $router;
        $this->session = $session;
        $this->em = $entityManager;
    }

    public function onCheckExpired(GetResponseEvent $event) {

        if (($this->security_context->getToken() ) && ( $this->security_context->isGranted('IS_AUTHENTICATED_FULLY') )) {
            $idUsuarioActivo = $this->security_context->getToken()->getUser()->getId();
            $sql = "SELECT titulo, fechaExpira FROM Password WHERE user_id = '" . $idUsuarioActivo . "'";
            $connection = $this->em->getConnection();
            $statement = $connection->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll();

            foreach ($results as $valor) {
                $fecha = $valor["fechaExpira"];
                $segundos = strtotime($fecha) - strtotime('now');
                $diferencia_dias = intval($segundos / 60 / 60 / 24);
                if (!empty($valor["fechaExpira"])) {
                    if ($diferencia_dias <= 0) {
                        $this->session->getFlashBag()->add('sonata_flash_error', 'Su clave  "' . $valor["titulo"] . '" ha caducado');
                    }
                }
            }
        }
    }

}
