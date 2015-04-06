<?php

namespace Acme\LoginPrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PrincipalController extends Controller
{
    public function principalAction()
    {
        return $this->render('AcmeLoginPrincipalBundle:Principal:principal.html.twig');
    }
}