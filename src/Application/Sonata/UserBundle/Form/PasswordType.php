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
                ->add('nombreUsuario')
                ->add('url')
                ->add('password')
                ->add('comentario')
                ->add('fechaExpira')
                ->add('fechaCreacion')
                ->add('fechaModificacion')
                ->add('fechaUltimoAcceso')
                ->add('tipoPassword')
                ->add('categorias', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:CategoriaPass',
                    'property' => 'nombreCategoria',
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
