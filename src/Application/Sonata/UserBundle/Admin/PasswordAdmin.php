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
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Route\RouteCollection;
use Application\Sonata\UserBundle\Form\PermisoUserType;
use Application\Sonata\UserBundle\Form\PermisoGrupoType;

class PasswordAdmin extends Admin {

    public $supportsPreviewMode = true;

    public function createQuery($context = 'list') {

        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
        $userId = $user->getId();
        $connection = $GLOBALS['kernel']->getContainer()->get('doctrine')->getManager()->getConnection();

        /*

            Leer y escribir - 11
            Leer y no escribir - 10
            No leer y no escribir - 0

        */
        
        //Permisos del usuario actual [Lectura|Escritura] --------------------------------------------------
        $permisosUser = $this->getUserPermits($userId, $connection);
        foreach ($permisosUser as $valor) {
//            echo "<script>console.log('Permisos usuario | " . $valor["permisos"] ."')</script>";
        }

        //Permisos del grupo actual [Lectura|Escritura] -----------------------------------------------------
        $permisosGrupos = $this->getGroupPermits($userId, $connection);
        foreach ($permisosGrupos as $valor) {
//            echo "<script>console.log('Permisos grupo " . $valor["group_id"] . " | " . $valor["permisos"] ."')</script>";
        }

        //Creacion de query--------------------------------------------------------------
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

    protected function getUserPermits($userId, $connection) {
        $sql = "SELECT * FROM PermisoUser WHERE user_id = '" . $userId . "'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    protected function getGroupPermits($userId, $connection) {
        $sql = "SELECT PermisoGrupo.grupo_id, PermisoGrupo.password_id, PermisoGrupo.permisos, fos_user_user_group.user_id, fos_user_user_group.group_id FROM PermisoGrupo INNER JOIN fos_user_user_group ON fos_user_user_group.user_id=" . $userId . " WHERE fos_user_user_group.group_id=PermisoGrupo.grupo_id";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
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
    public function getExportFields() {
        // avoid security field to be exported
        return array_filter(parent::getExportFields(), function($v) {
            return !in_array($v, array('password', 'salt'));
        });
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
                ->add('permisosUser', null, array('label' => 'Permisos de Usuarios'))
                ->add('permisosGrupo', null, array('label' => 'Permisos de Grupos'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
                        'clipboard' => array(),
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
                ->add('permisosUser', null, array('label' => 'Permisos de Usuarios'))
                ->add('permisosGrupo', null, array('label' => 'Permisos de Grupos'))
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
                ->add('password', 'password', array('label' => 'Contraseña'))
                ->add('comentario', 'text')
                ->add('fechaExpira')
                ->add('category')
                ->add('category.enabled')
                ->add('tipoPassword')
                ->add('enabled')
                ->add('files', null, array('label' => 'Archivos', 'associated_property' => 'getName'))
                ->add('permisosUser', null, array('label' => 'Permisos de Usuarios'))
                ->add('permisosGrupo', null, array('label' => 'Permisos de Grupos'))
                ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $user = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();

        $formMapper
                ->tab('General')
                ->with('Contraseña:', array('class' => 'col-md-6'))
                ->add('titulo');
        if ($user->isSuperAdmin()) {
            $formMapper->add('user', null, array('required' => true));
        }
        $formMapper
                ->add('usernamePass', null, array('required' => false))
                ->add('url', null, array('required' => false))
                ->add('plainPassword', 'password', array('label' => 'Contraseña',
                    'required' => false,
                    'attr' => array('class' => 'campoPass')
                ))
                ->add('comentario', 'textarea', array('required' => false))
                ->add('fechaExpira', 'sonata_type_datetime_picker', array('required' => false))
                ->end()
                ->with('Categorias y tipos', array('class' => 'col-md-6'))
                ->add('category', 'sonata_type_model', array('label' => 'Categorias', 'expanded' => false, 'by_reference' => false, 'multiple' => true, 'required' => false))
                ->add('tipoPassword', 'sonata_type_model', array('required' => false))
                ->add('enabled', null, array('required' => false, 'data' => true))
                ->end()
                ->with('Archivos', array('class' => 'col-md-6'))
                ->add('files', 'sonata_type_model', array(
                    'label' => 'Archivos',
                    'by_reference' => false,
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ))
                ->end()
                ->end()
                // PERMISOS 
                ->tab('Permisos')
                ->with('Permisos de Usuario', array('class' => 'col-md-6'))
                ->add('permisosUser', 'collection', array(
                    'type' => new PermisoUserType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label' => 'Permisos de usuario',
                    'by_reference' => false))
                ->end()
                ->with('Permisos de Grupo', array('class' => 'col-md-6'))
                ->add('permisosGrupo', 'collection', array(
                    'type' => new PermisoGrupoType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label' => 'Permisos de grupo',
                    'by_reference' => false))
                ->end()
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

        $request = Request::createFromGlobals();

        $valorCat = $request->query->get('idCat');
        if ($valorCat !== null) {
            $entityManager = $this->getModelManager()->getEntityManager('Application\Sonata\ClassificationBundle\Entity\Category');
            $reference = $entityManager->getReference('Application\Sonata\ClassificationBundle\Entity\Category', $valorCat);

            $instance->addCategory($reference);
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
        if ($pass->getPlainPassword() !== null) {
            $pass->setPassword($this->getConfigurationPool()->getContainer()->get('nzo_url_encryptor')->encrypt($pass->getPlainPassword()));
        } else {
            $pass->setPassword($this->getConfigurationPool()->getContainer()->get('nzo_url_encryptor')->encrypt($pass->getPassword()));
        }
        $this->getModelManager()->getEntityManager('Application\Sonata\UserBundle\Entity\Password')->persist($pass);
        $this->getModelManager()->getEntityManager('Application\Sonata\UserBundle\Entity\Password')->flush();
        // CATEGORIA DEFAULT SI NO SE SELECCIONA NINGUNA EN EL FORMULARIO
        if (count($pass->getCategory()) === 0) {
            $pass->addCategory($this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository('Application\Sonata\ClassificationBundle\Entity\Category')->find(1));
        }

        $pass->setFiles($pass->getFiles());
        $pass->setPermisosUser($pass->getPermisosUser());
    }

    public function prePersist($pass) {
        // AÑADIENDO HTTP DELANTE DE URL
        if (substr($pass->getUrl(), 0, 4) !== 'http' && $pass->getUrl() !== null) {
            $url = $pass->getUrl();
            $pass->setUrl('http://' . $url);
        }

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
