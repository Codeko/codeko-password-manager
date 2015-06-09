<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermisoUserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('permisos')
                ->add('user', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:User',
                    'label' => 'Usuario'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Entity\PermisoUser'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'application_sonata_userbundle_permisouser';
    }

}
