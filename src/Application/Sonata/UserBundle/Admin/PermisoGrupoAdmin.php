<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Exception\ModelManagerException;

class PermisoGrupoAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('permisos')
                ->add('grupo', null, array('label' => 'Grupo'))
                ->add('password', null, array('label' => 'Contraseña'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        unset($this->listModes['mosaic']);
        $listMapper
                ->addIdentifier('password', null, array('label' => 'Contraseña'))
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
                //->add('permisos')
                ->add('permisos','hidden')
                ->add('grupo', 'entity', array(
                    'label' => 'Grupo',
                    'class' => 'ApplicationSonataUserBundle:Group',
                    'required' => true
                ))
                ->add('perms', 'choice', array(
                    'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false,
                    'mapped' => false,
                    'by_reference' => false,
                    'label' => 'Permisos',
                    'attr' => array('inline' => true)
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
                ->add('password')
        ;
    }

    public function preUpdate($permiso) {

        $escr = $this->getForm()->get('perms')[0]->getData();
        $lect = $this->getForm()->get('perms')[1]->getData();

        if ($escr == 1 && $lect == 1) {
            $permiso->setPermisos(11);
        } elseif ($escr == 0 && $lect == 1) {
            $permiso->setPermisos(10);
        } elseif ($escr == 0 && $lect == 0) {
            $permiso->setPermisos(0);
        } else {
            throw new ModelManagerException('Debe disponer de permisos de lectura para poder escribir/editar');
        }
    }

    public function prePersist($permiso) {
        $escr = $this->getForm()->get('perms')[0]->getData();
        $lect = $this->getForm()->get('perms')[1]->getData();

        if ($escr == 1 && $lect == 1) {
            $permiso->setPermisos(11);
        } elseif ($escr == 0 && $lect == 1) {
            $permiso->setPermisos(10);
        } elseif ($escr == 0 && $lect == 0) {
            $permiso->setPermisos(0);
        } else {
            throw new ModelManagerException('Debe disponer de permisos de lectura para poder escribir/editar');
        }

        $this->preUpdate($permiso);
    }

}
