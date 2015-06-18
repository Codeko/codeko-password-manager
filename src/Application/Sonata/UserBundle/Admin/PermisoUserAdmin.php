<?php

namespace Application\Sonata\UserBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class PermisoUserAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('permisos')
                ->add('user', null, array('label' => 'Usuario'))
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
                ->addIdentifier('user', null, array('label' => 'Usuario'))
                ->add('permisos')
//                ->add('perms')
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
                ->add('permisos', 'hidden')
                ->add('password', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:Password',
                    'label' => 'Contraseña',
                    'required' => true
                ))
                ->add('user', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:User',
                    'label' => 'Usuario',
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
                    'attr' => array('inline' => true)))
        ;
        $formMapper->getFormBuilder()->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $permiso = $event->getData();
            $form = $event->getForm();

            // check if the Product object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "Product"
            if (!$permiso || null === $permiso->getId()) {
                $form->add('perms', 'choice', array(
                    'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false,
                    'mapped' => false,
                    'by_reference' => false,
                    'label' => 'Permisos',
                    'attr' => array('inline' => true)
                ));
            } else {
                if ($permiso->getPermisos() == 11) {
                    $form->add('perms', 'choice', array(
                        'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                        'multiple' => true,
                        'expanded' => true,
                        'required' => false,
                        'mapped' => false,
                        'by_reference' => false,
                        'data' => ['1', '2'],
                        'label' => 'Permisos',
                        'attr' => array('inline' => true)
                    ));
                } else if ($permiso->getPermisos() == 10) {
                    $form->add('perms', 'choice', array(
                        'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                        'multiple' => true,
                        'expanded' => true,
                        'required' => false,
                        'mapped' => false,
                        'by_reference' => false,
                        'data' => ['2'],
                        'label' => 'Permisos',
                        'attr' => array('inline' => true)
                    ));
                }
            }
        });
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
