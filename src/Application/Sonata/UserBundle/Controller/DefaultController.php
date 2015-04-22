<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Action\DeleteMassAction;

class DefaultController extends Controller {

    public function gridAction() {
        $source = new Entity('ApplicationSonataUserBundle:CategoriaPass');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $grid->setSource($source);

        // Set the selector of the number of items per page
        $grid->setLimits(array(5, 10, 15));

        // Set the default page
        $grid->setDefaultPage(1);

        // Add a delete mass action
        $grid->addMassAction(new DeleteMassAction());

        $grid->setRouteUrl($this->generateUrl('application_sonata_user_manageCategories_grid'));

        //echo("<script>alert('".$grid->."')</script>");

        return $grid->getGridResponse('ApplicationSonataUserBundle:CategoriaPass:grid.html.twig', array(
                    'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
                    'admin_pool' => $this->container->get('sonata.admin.pool')
        ));
    }

    public function grid2Action() {
        $source = new Entity('ApplicationSonataUserBundle:Password');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $grid->setSource($source);

        // Set the selector of the number of items per page
        $grid->setLimits(array(5, 10, 15));

        // Set the default page
        $grid->setDefaultPage(1);

        // Add a delete mass action
        $grid->addMassAction(new DeleteMassAction());

        $grid->setRouteUrl($this->generateUrl('application_sonata_user_managePasswords_grid'));

        //echo("<script>alert('".$grid->."')</script>");

        return $grid->getGridResponse('ApplicationSonataUserBundle:Password:grid.html.twig', array(
                    'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
                    'admin_pool' => $this->container->get('sonata.admin.pool')
        ));

    
        /* , array(
          'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
          'admin_pool' => $this->container->get('sonata.admin.pool') */
    }
    
    public function grid3Action() {
        $source = new Entity('ApplicationSonataUserBundle:Password');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $grid->setSource($source);

        // Set the selector of the number of items per page
        $grid->setLimits(array(5, 10, 15));

        // Set the default page
        $grid->setDefaultPage(1);

        // Add a delete mass action
        $grid->addMassAction(new DeleteMassAction());

        $grid->setRouteUrl($this->generateUrl('application_sonata_user_managePasswords_grid2'));

        //echo("<script>alert('".$grid->."')</script>");

        return $grid->getGridResponse('ApplicationSonataUserBundle:Password:grid2.html.twig', array(
                    'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
                    'admin_pool' => $this->container->get('sonata.admin.pool')
        ));
    }
}
