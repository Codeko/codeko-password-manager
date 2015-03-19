<?php

namespace Acme\PruebaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('AcmePruebaBundle:Default:index.html.twig');
    }
}
