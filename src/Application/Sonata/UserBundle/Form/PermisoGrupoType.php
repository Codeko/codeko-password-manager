<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermisoGrupoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('permisos')
                ->add('grupo', 'entity', array(
                    'class' => 'ApplicationSonataUserBundle:Group',
                    'label' => 'Grupo',
                    'required' => true
                ))
                ->add('perms', 'choice', array(
                    'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false,
                    'mapped' => false,
                    'attr' => array('inline' => true)
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Entity\PermisoGrupo'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'application_sonata_userbundle_permisogrupo';
    }

}
