<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PermisoUserAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('permisos')
                ->add('user',null, array('label' => 'Usuario'))
                ->add('password',null, array('label' => 'Contraseña'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper                
                ->addIdentifier('password', null, array('label' => 'Contraseña'))
                ->addIdentifier('user', null, array('label' => 'Usuario'))
                ->add('permisos')
                
                ->add('_action', 'actions', array(
                    'label' => 'Acciones',
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('permisos')
                ->add('user', 'sonata_type_model', array(
                    'label' => 'Usuario',
                    'expanded' => false,
                    'by_reference' => false,
                    'multiple' => false,
                    'required' => false,
                    'btn_add' => false
                ))
                ->add('password', 'sonata_type_model', array(
                    'label' => 'Contraseña',
                    'expanded' => false,
                    'by_reference' => false,
                    'multiple' => false,
                    'required' => false,
                    'btn_add' => false
                ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('permisos')
                ->add('user')
                ->add('password')
        ;
    }

}
