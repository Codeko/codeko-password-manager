<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use FOS\UserBundle\Model\UserManagerInterface;
use Application\Sonata\ClassificationBundle\Entity\Category;
use Sonata\ClassificationBundle\Model\CategoryManagerInterface;

class PasswordAdmin extends Admin {

    public $supportsPreviewMode = true;

    protected $categoryManager;

    
    /**
     * @param string                   $code
     * @param string                   $class
     * @param string                   $baseControllerName
     * @param Pool                     $pool
     * @param CategoryManagerInterface $categoryManager
     */
//    public function __construct($code, $class, $baseControllerName, Pool $pool, CategoryManagerInterface $categoryManager) {
//        parent::__construct($code, $class, $baseControllerName);
//
//        $this->pool = $pool;
//
//        $this->categoryManager = $categoryManager;
//    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('titulo')
                ->add('user')
                ->add('usernamePass')
                ->add('url', 'url')
                ->add('password')
                ->add('comentario')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                ->add('category')
                ->add('tipoPassword')

        ;
    }

    // AQUI!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper) {

        $parameters = parent::getPersistentParameters();
        
        $options = array(
            'choices' => array()
        );
//
//        foreach ($this->pool->getContexts() as $name => $context) {
//            $options['choices'][$name] = $name;
//        }

        $filterMapper
                ->add('titulo')
                ->add('user')
                ->add('usernamePass')
                ->add('url')
                ->add('comentario')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                // CONSEGUIR ENLAZAR CATEGORIAS CON PASSWORD!!!!!!!
                ->add('category', null, array(
                    'show_filter' => false,
                ))
                ->add('tipoPassword')
        ;
    }

    /**
     * {@inheritdoc}
     */
//    public function getPersistentParameters() {
//        $parameters = parent::getPersistentParameters();
//
//        if (!$this->hasRequest()) {
//            return $parameters;
//        }
//
//        $filter = $this->getRequest()->get('filter');
//        if ($filter && array_key_exists('context', $this->getRequest()->get('filter'))) {
//            $context = $filter['context']['value'];
//        } else {
//            $context = $this->getRequest()->get('context', $this->pool->getDefaultContext());
//        }
//
//        $providers = $this->pool->getProvidersByContext($context);
//        $provider = $this->getRequest()->get('provider');
//
//        // if the context has only one provider, set it into the request
//        // so the intermediate provider selection is skipped
//        if (count($providers) == 1 && null === $provider) {
//            $provider = array_shift($providers)->getName();
//            $this->getRequest()->query->set('provider', $provider);
//        }
//
//        $categoryId = $this->getRequest()->get('category');
//
//        if (!$categoryId) {
//            $categoryId = $this->categoryManager->getRootCategory($context)->getId();
//        }
//
//        return array_merge($parameters, array(
//            'context' => $context,
//            'category' => $categoryId,
//            'hide_context' => (bool) $this->getRequest()->get('hide_context')
//        ));
//    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->with('General')
                ->add('titulo')
                ->add('user')
                ->add('usernamePass')
                ->add('url')
                ->add('password')
                ->add('comentario')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                ->add('category')
                ->add('tipoPassword')
                ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('General')
                ->add('titulo')
                ->add('user', null, array('required' => true))
                ->add('usernamePass', null, array('required' => false))
                ->add('url', null, array('required' => false))
                ->add('password')
                ->add('comentario', null, array('required' => false))
                ->add('fechaExpira', null, array('required' => false, 'format' => 'dd MMM yyyy', 'widget' => 'choice'))
                ->add('fechaCreacion', null, array('required' => false))
                ->add('fechaModificacion', null, array('required' => false))
                ->add('fechaUltimoAcceso', null, array('required' => false))
                ->add('tipoPassword', null, array('required' => false))
                ->end()
                ->with('Categorias')
                ->add('category', null, array('label' => 'Categorias', 'expanded' => true, 'by_reference' => false, 'multiple' => true, 'required' => false))
                ->end()

        ;
    }

}
