<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PermisoCategoriaGrupoAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('permisos')
                ->add('grupo', null, array('label' => 'Grupo'))
                ->add('categoria', null, array('label' => 'Categoría'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('categoria', null, array('label' => 'Categoría'))
                ->addIdentifier('grupo', null, array('label' => 'Grupo'))
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
                ->add('grupo', 'sonata_type_model', array(
                    'label' => 'Grupo',
                    'expanded' => false,
                    'by_reference' => false,
                    'multiple' => false,
                    'required' => false,
                    'btn_add' => false
                ))
                ->add('categoria', 'sonata_type_model', array(
                    'label' => 'Categoría',
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
                ->add('grupo')
                ->add('categoria')
        ;
    }

}
