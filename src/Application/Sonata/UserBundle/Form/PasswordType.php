<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PasswordType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('titulo')
                ->add('user', null, array(
                    'class' => 'ApplicationSonataUserBundle:User',
                    'property' => 'user',
                    'allow_add' => true,
                    'allow_delete' => true))
                ->add('nombreUsuario')
                ->add('url')
                ->add('password', 'password', array(
                    'type' => 'password',
                    'required' => false,
                    'attr' => array(
                        'class' => 'password',
                        'input' => 'password',
                    )
                ))
                ->add('comentario')
                ->add('fechaExpira', null, array('class' => 'sonata_type_datetime_picker'))
                ->add('tipoPassword')
                ->add('category', null, array(
                    'class' => 'ApplicationSonataClassificationBundle:Category',
                    'property' => 'name',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => true,
                ))

                // PERMISOS 
                ->add('permisosUser', 'collection', array(
                    'type' => new PermisoUserType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label' => 'Permisos de usuario',
                    'by_reference' => false))
                ->add('permisosGrupo', 'collection', array(
                    'type' => new PermisoGrupoType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false,
                    'label' => 'Permisos de grupo',
                    'by_reference' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Entity\Password',
            'allow_extra_fields' => true
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'application_sonata_userbundle_password';
    }

}
