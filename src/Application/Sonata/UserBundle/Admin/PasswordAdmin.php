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

class PasswordAdmin extends Admin {

    public $supportsPreviewMode = true;
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('titulo')
                ->add('user')
                ->add('usernamePass')
                ->add('url','url')
                ->add('password')
                ->add('comentario')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                ->add('categorias')
                ->add('tipoPassword')
                
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper) {
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
                ->add('categorias')
                ->add('tipoPassword')
        ;
    }

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
                ->add('categorias')
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
                ->add('fechaExpira', null, array('required' => false, 'format' =>  'dd MMM yyyy','widget' => 'choice'))
                ->add('fechaCreacion', null, array('required' => false))
                ->add('fechaModificacion', null, array('required' => false))
                ->add('fechaUltimoAcceso', null, array('required' => false))
                ->add('tipoPassword', null, array('required' => false))
                ->end()
                ->with('Categorias')
                ->add('categorias', null, array('label' => 'Categorias', 'expanded' => true, 'by_reference' => false, 'multiple' => true, 'required' => false))
                ->end()

        ;
    }

}
