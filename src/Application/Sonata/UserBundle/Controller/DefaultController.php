<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APY\DataGridBundle\Grid\Source\Entity;

class DefaultController extends Controller {

    public function gridAction() {
        $source = new Entity('ApplicationSonataUserBundle:CategoriaPass');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $grid->setSource($source);

        //echo("<script>alert('".$grid->."')</script>");

        return $grid->getGridResponse('ApplicationSonataUserBundle:CategoriaPass:grid.html.twig');
    }
}
