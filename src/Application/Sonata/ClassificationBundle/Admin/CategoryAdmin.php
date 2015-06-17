<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Sonata Project <https://github.com/sonata-project/SonataClassificationBundle/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\ClassificationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\ClassificationBundle\Entity\ContextManager;
use Application\Sonata\UserBundle\Form\PermisoCategoriaUserType;
use Application\Sonata\UserBundle\Form\PermisoCategoriaGrupoType;
use Sonata\AdminBundle\Exception\ModelManagerException;

class CategoryAdmin extends Admin {

    public $supportsPreviewMode = true;
    protected $formOptions = array(
        'cascade_validation' => true
    );
    protected $contextManager;

    /**
     * @param string         $code
     * @param string         $class
     * @param string         $baseControllerName
     * @param ContextManager $contextManager
     */
    public function __construct($code, $class, $baseControllerName, ContextManager $contextManager) {
        parent::__construct($code, $class, $baseControllerName);

        $this->contextManager = $contextManager;
    }

    /**
     * {@inheritdoc}
     */
    public function configureRoutes(RouteCollection $routes) {
        $routes->add('tree', 'tree');
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance() {
        $instance = parent::getNewInstance();

        if ($contextId = $this->getPersistentParameter('context')) {
            $context = $this->contextManager->find($contextId);

            if (!$context) {
                $context = $this->contextManager->create();
                $context->setEnabled(true);
                $context->setId($context);
                $context->setName($context);

                $this->contextManager->save($context);
            }

            $instance->setContext($context);
        }

        return $instance;
    }

    protected function getActiveUser() {
        return $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $user = $this->getActiveUser();

        $formMapper
                ->tab('General')
                ->with('General', array('class' => 'col-md-6'))
                ->add('name')
                ->add('description', 'textarea', array('required' => false))
        ;

        if ($this->hasSubject()) {
            if ($this->getSubject()->getParent() !== null || $this->getSubject()->getId() === null) { // root category cannot have a parent
                $formMapper
                        ->add('parent', 'sonata_category_selector', array(
                            'category' => $this->getSubject() ? : null,
                            'model_manager' => $this->getModelManager(),
                            'class' => $this->getClass(),
                            'required' => true,
                            'context' => $this->getSubject()->getContext()
                ));
            }
        }

        $formMapper->end()
                ->with('Options', array('class' => 'col-md-6'))
                ->add('enabled', null, array('required' => false, 'data' => true))
                ->end();
        if ($user->isSuperAdmin()) {
            $formMapper->end();
            $formMapper
                    ->tab('Permisos')
                    ->with('Permisos de Usuario', array('class' => 'col-md-6'))
                    ->add('permisosUser', 'collection', array(
                        'type' => new PermisoCategoriaUserType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'required' => false,
                        'label' => 'Permisos de usuario', 
                        'by_reference' => false))
                    ->end()
                    ->with('Permisos de Grupo', array('class' => 'col-md-6'))
                    ->add('permisosGrupo', 'collection', array(
                        'type' => new PermisoCategoriaGrupoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'required' => false,
                        'label' => 'Permisos de grupo',
                        'by_reference' => false))
                    ->end()
                    ->end();
        } else {
            $formMapper
                    ->with('Permisos de Usuario', array('class' => 'invisible'))
                    ->add('permisosUser', 'collection')
                    ->end()
                    ->with('Permisos de Grupo', array('class' => 'invisible'))
                    ->add('permisosGrupo', 'collection')
                    ->end()
                    ->end();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $options = array();
        if ($this->getPersistentParameter('hide_context') === 1) {
            $options['disabled'] = true;
        }

        $datagridMapper
                ->add('name')
                ->add('enabled')
                ->add('permisosUser', null, array('label' => 'Permisos de Usuarios'))
                ->add('permisosGrupo', null, array('label' => 'Permisos de Grupos'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        unset($this->listModes['mosaic']);
        $user = $this->getActiveUser();

        $listMapper
                ->addIdentifier('name')
                ->add('slug')
                ->add('description')
                ->add('enabled', null, array('editable' => true))
                ->add('parent');
        if ($user->isSuperAdmin()) {
            $listMapper
                    ->add('permisosUser', null, array('label' => 'Permisos de Usuarios'))
                    ->add('permisosGrupo', null, array('label' => 'Permisos de Grupos'));
        }
        ;
    }

    public function preUpdate($categoria) {
        $this->getModelManager()->getEntityManager('Application\Sonata\ClassificationBundle\Entity\Category')->persist($categoria);
        $this->getModelManager()->getEntityManager('Application\Sonata\ClassificationBundle\Entity\Category')->flush();

        // PERMISOS USER 
        $form = $this->getForm()->get('permisosUser');

        if ($form->count() > 0) {
            foreach ($form->all() AS $fi) {
                $perms = $fi->get('perms');
                $escr = $perms[0]->getData();
                $lect = $perms[1]->getData();
                $user = $fi->get('user')->getData();
                if ($escr == 1 && $lect == 1) {
                    for ($j = 0; $j < $categoria->getPermisosUser()->count(); $j++) {
                        if ($categoria->getPermisosUser()[$j]->getUser() == $user) {
                            $categoria->getPermisosUser()[$j]->setPermisos(11);
                        }
                    }
                } elseif ($escr == 0 && $lect == 1) {
                    for ($j = 0; $j < $categoria->getPermisosUser()->count(); $j++) {
                        if ($categoria->getPermisosUser()[$j]->getUser() == $user) {
                            $categoria->getPermisosUser()[$j]->setPermisos(10);
                        }
                    }
                } elseif ($escr == 0 && $lect == 0) {
                    for ($j = 0; $j < $categoria->getPermisosUser()->count(); $j++) {
                        if ($categoria->getPermisosUser()[$j]->getUser() == $user) {
                            $categoria->getPermisosUser()[$j]->setPermisos(0);
                        }
                    }
                } else {
                    throw new ModelManagerException('Debe disponer de permisos de lectura para poder escribir/editar');
                }
            }
        }

// PERMISOS GRUPOS 
        $form2 = $this->getForm()->get('permisosGrupo');

        if ($form2->count() > 0) {
            foreach ($form2->all() AS $fi) {
                $perms = $fi->get('perms');
                $escr = $perms[0]->getData();
                $lect = $perms[1]->getData();
                $grupo = $fi->get('grupo')->getData();

                if ($escr == 1 && $lect == 1) {
                    for ($j = 0; $j < $categoria->getPermisosGrupo()->count(); $j++) {
                        if ($categoria->getPermisosGrupo()[$j]->getGrupo() == $grupo) {
                            $categoria->getPermisosGrupo()[$j]->setPermisos(11);
                        }
                    }
                } elseif ($escr == 0 && $lect == 1) {
                    for ($j = 0; $j < $categoria->getPermisosGrupo()->count(); $j++) {
                        if ($categoria->getPermisosGrupo()[$j]->getGrupo() == $grupo) {
                            $categoria->getPermisosGrupo()[$j]->setPermisos(10);
                        }
                    }
                } elseif ($escr == 0 && $lect == 0) {
                    for ($j = 0; $j < $categoria->getPermisosGrupo()->count(); $j++) {
                        if ($categoria->getPermisosGrupo()[$j]->getGrupo() == $grupo) {
                            $categoria->getPermisosGrupo()[$j]->setPermisos(0);
                        }
                    }
                } else {
                    throw new ModelManagerException('Debe disponer de permisos de lectura para poder escribir/editar');
                }
            }
        }

        $categoria->setPermisosUser($categoria->getPermisosUser());
        $categoria->setPermisosGrupo($categoria->getPermisosGrupo());
    }

    public function prePersist($categoria) {

        $this->preUpdate($categoria);
    }

    /**
     * {@inheritdoc}
     */
    public function getPersistentParameters() {
        $parameters = array(
            'context' => '',
            'hide_context' => $this->hasRequest() ? (int) $this->getRequest()->get('hide_context', 0) : 0
        );

        if ($this->getSubject()) {
            $parameters['context'] = $this->getSubject()->getContext() ? $this->getSubject()->getContext()->getId() : '';

            return $parameters;
        }

        if ($this->hasRequest()) {
            $parameters['context'] = $this->getRequest()->get('context');

            return $parameters;
        }

        return $parameters;
    }

}
