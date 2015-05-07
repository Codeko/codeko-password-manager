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

class PasswordAdmin extends Admin {

    public $supportsPreviewMode = true;

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('titulo')
                ->add('usernamePass')
                ->add('password')
                ->add('url', 'url')
                ->add('comentario')
                ->add('tipoPassword')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
//                ->add('category')
                ->add('user')

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
                ->add('fechaExpira','doctrine_orm_datetime', array('field_type'=>'sonata_type_datetime_picker'))
                ->add('fechaCreacion','doctrine_orm_datetime', array('field_type'=>'sonata_type_datetime_picker'))
                ->add('fechaModificacion','doctrine_orm_datetime', array('field_type'=>'sonata_type_datetime_picker'))
                ->add('fechaUltimoAcceso','doctrine_orm_datetime', array('field_type'=>'sonata_type_datetime_picker'))
                ->add('category', null, array(
                    'show_filter' => false,
                ))
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
                ->with('Contraseña:')
                ->add('titulo')
                ->add('user', null, array('required' => true))
                ->add('usernamePass', null, array('required' => false))
                ->add('url', null, array('required' => false))
                ->add('password')
                ->add('comentario', null, array('required' => false))
                ->add('fechaExpira', 'sonata_type_datetime_picker', array('required' => false))
                ->add('tipoPassword', null, array('required' => false))
                ->end()
                ->with('Categorias')
                ->add('category', null, array('label' => 'Categorias', 'expanded' => true, 'by_reference' => false, 'multiple' => true, 'required' => false))
                ->end()

        ;
    }

}
