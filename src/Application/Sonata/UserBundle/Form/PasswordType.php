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
                ->add('password')
                ->add('comentario')
                ->add('fechaExpira', null, array('class' => 'sonata-medium-date-custom'))
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                ->add('tipoPassword')
                ->add('categorias', null, array(
                    'class' => 'ApplicationSonataUserBundle:CategoriaPass',
                    'property' => 'nombreCategoria',
                    'allow_add' => true,
                    'allow_delete' => true
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Entity\Password'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'application_sonata_userbundle_password';
    }

}
