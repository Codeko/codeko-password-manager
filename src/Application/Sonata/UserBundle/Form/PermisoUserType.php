<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PermisoUserType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//->add('permisos')
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
                    'attr' => array('inline' => true)
                ))
        ;

        $builder->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
        if (null != $event->getData()) {}
        });
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
