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
                ->add('fechaExpira', null, array('class' => 'sonata_type_datetime_picker'))
                ->add('fechaCreacion', null, array('class' => 'sonata_type_datetime_picker'))
                ->add('fechaModificacion', 'hidden', array('class' => 'sonata_type_datetime_picker', 'input' => new \DateTime('now')
                ))
                ->add('fechaUltimoAcceso', null, array('class' => 'sonata_type_datetime_picker'))
                ->add('tipoPassword')
                ->add('category', null, array(
                    'class' => 'ApplicationSonataClassificationBundle:Category',
                    'property' => 'name',
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
