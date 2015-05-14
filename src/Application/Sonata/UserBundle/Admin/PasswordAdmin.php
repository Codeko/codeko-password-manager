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
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class PasswordAdmin extends Admin {

    public $supportsPreviewMode = true;

    public function createQuery($context = 'list') {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        if (!$user->isSuperAdmin()) {
            $query = parent::createQuery($context);
            $query->andWhere(
               $query->expr()->eq($query->getRootAliases()[0] . '.user', ':user')
            );
            $query->setParameter(':user', $user);
        } else {
            $query = parent::createQuery($context);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        unset($this->listModes['mosaic']);

        $listMapper
                ->addIdentifier('titulo')
                ->add('usernamePass')
                ->add('url', 'url', array('hide_protocol' => true))
                ->add('comentario')
                ->add('tipoPassword')
                ->add('fechaExpira')
                ->add('category')
                ->add('user')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper) {

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $filterMapper
                ->add('titulo');
        if ($user->isSuperAdmin()) {
            $filterMapper->add('user');
        }
        $filterMapper
                ->add('usernamePass')
                ->add('url')
                ->add('comentario')
                ->add('fechaExpira', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range',))
                ->add('fechaCreacion', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range',))
                ->add('fechaModificacion', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range',))
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
                ->add('category')
                ->add('tipoPassword')
                ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $formMapper
                ->with('Contraseña', array('class' => 'col-md-6'))
                ->add('titulo');
        if (!$user->isSuperAdmin()) {
            $formMapper->add('user', null, array('required' => true));
        }
        $formMapper
                ->add('usernamePass', null, array('required' => false))
                ->add('url', null, array('required' => false))
                ->add('password', 'password', array('attr' => array('class' => 'password', 'input' => 'password'),'required' => false))
                ->add('comentario', null, array('required' => false))
                ->add('fechaExpira', 'sonata_type_datetime_picker', array('required' => false))
                ->add('tipoPassword', null, array('required' => false))
                ->end()
                ->with('Categorias', array('class' => 'col-md-6'))
                ->add('category', 'sonata_type_model', array('label' => 'Categorias', 'expanded' => true, 'by_reference' => false, 'multiple' => true, 'required' => false))
                ->end()

        ;
    }

    public function getNewInstance() {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        if (!$user->isSuperAdmin()) {
            $instance = parent::getNewInstance();
            $instance->setUser($this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser());
        } else {
            $instance = parent::getNewInstance();
        }

        return $instance;
    }

}
