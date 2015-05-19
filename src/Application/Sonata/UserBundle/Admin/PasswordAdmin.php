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
use Application\Sonata\ClassificationBundle\Entity\Category;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Route\RouteCollection;
use Hackzilla\Bundle\PasswordGeneratorBundle\Form\Type\OptionType;
use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;

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

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('clone', $this->getRouterIdParameter() . '/clone');
    }

    private function buildRoutes() {
        if ($this->loaded['routes']) {
            return;
        }

        $this->loaded['routes'] = true;

        $this->routes = new RouteCollection(
                $this->getBaseCodeRoute(), $this->getBaseRouteName(), $this->getBaseRoutePattern(), $this->getBaseControllerName()
        );

        $this->routeBuilder->build($this, $this->routes);

        $this->configureRoutes($this->routes);

        foreach ($this->getExtensions() as $extension) {
            $extension->configureRoutes($this, $this->routes);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        unset($this->listModes['mosaic']);
        $listMapper
                ->addIdentifier('titulo')
                ->add('usernamePass')
                ->add('url', 'url', array(
                    'hide_protocol' => true
                ))
                ->add('comentario', 'text')
                ->add('tipoPassword')
                ->add('fechaExpira')
                ->add('category', null, array('associated_property' => 'getName'))
                ->add('enabled', null, array('editable' => true))
                ->add('user')
                ->add('files', null, array('label' => 'Archivos', 'associated_property' => 'getName'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'Clone' => array(
                            'template' => 'SonataAdminBundle:CRUD:list__action_clone.html.twig'
                        ),
                        'clipboard' => array()
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
                ->add('enabled')
                ->add('category.enabled')
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
                ->add('comentario', 'text')
                ->add('fechaExpira')
                ->add('category')
                ->add('category.enabled')
                ->add('tipoPassword')
                ->add('enabled')
                ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        // AQUII!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        $formMapper
                ->with('Contraseña:', array('class' => 'col-md-6'))
                ->add('titulo');
        if ($user->isSuperAdmin()) {
            $formMapper->add('user', null, array('required' => true));
        }
        $formMapper
                ->add('usernamePass', null, array('required' => false))
                ->add('url', null, array('required' => false))
                ->add('password', 'password', array('required' => false, 'attr' => array('class' => 'password', 'input' => 'password')))
                ->add('comentario', 'textarea', array('required' => false))
                ->add('fechaExpira', 'sonata_type_datetime_picker', array('required' => false))
                ->add('tipoPassword', 'sonata_type_model', array('required' => false))
                ->end()
                ->with('Categorias', array('class' => 'col-md-6'))
                ->add('category', 'sonata_type_model', array('label' => 'Categorias', 'expanded' => true, 'by_reference' => false, 'multiple' => true, 'required' => true))
                ->add('enabled', null, array('required' => false, 'data' => true))
                ->end()
                ->with('Generador', array('class' => 'col-md-6'))
                ->end()
                ->with('Archivos', array('class' => 'col-md-6'))
                ->add('files', 'sonata_type_collection')
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

    public function preUpdate($pass) {
        // AÑADIENDO HTTP DELANTE DE URL
        if (substr($pass->getUrl(), 0, 4) !== 'http' && $pass->getUrl() !== null) {
            $url = $pass->getUrl();
            $pass->setUrl('http://' . $url);
        }

        // CODIFICANDO CONTRASEÑAS
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $plainPassword = $pass->getPassword();
        $encoded = $encoder->encodePassword($pass, $plainPassword);
        $pass->setPassword($encoded);


        // CATEGORIA DEFAULT SI NO SE SELECCIONA NINGUNA EN EL FORMULARIO
        if (count($pass->getCategory()) === 0) {
            $pass->addCategory($this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository('Application\Sonata\ClassificationBundle\Entity\Category')->find(1));
        }

        $pass->setFiles($pass->getFiles());
    }

    public function prePersist($pass) {
        // AÑADIENDO HTTP DELANTE DE URL
        if (substr($pass->getUrl(), 0, 4) !== 'http' && $pass->getUrl() !== null) {
            $url = $pass->getUrl();
            $pass->setUrl('http://' . $url);
        }

        // CODIFICANDO CONTRASEÑAS
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $plainPassword = $pass->getPassword();
        $encoded = $encoder->encodePassword($pass, $plainPassword);
        $pass->setPassword($encoded);


        // CATEGORIA DEFAULT SI NO SE SELECCIONA NINGUNA EN EL FORMULARIO
        if (count($pass->getCategory()) === 0) {
            $pass->addCategory($this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository('Application\Sonata\ClassificationBundle\Entity\Category')->find(1));
        }

        $this->preUpdate($pass);
    }

    public function getBatchActions() {
        // retrieve the default (currently only the delete action) actions
        $actions = parent::getBatchActions();

        // check user permissions
        $actions['clone'] = [
            'label' => 'Duplicar',
            'ask_confirmation' => false, // If true, a confirmation will be asked before performing the action
        ];

        return $actions;
    }

}
