<?php

namespace Application\Sonata\UserBundle\Block;

use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Application\Sonata\UserBundle\Controller\DefaultController;

class GridCategoriasBlockService extends BaseBlockService{

    public function getName() {
        return 'Categorias';
    }

    public function getDefaultSettings() {
        return array();
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block) {
        
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block) {
        
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null) {
        // merge settings
        $settings = array_merge($this->getDefaultSettings(), $blockContext->getSettings());       
        
        return $this->renderResponse('ApplicationSonataUserBundle:CategoriaPass:grid.html.twig', array(
                    'block' => $blockContext->getBlock(),
                    'settings' => $settings
                        ), $response);
    }

}
