<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class PermisoGrupoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('permisos', 'hidden')
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
                    'by_reference' => false,
                    'label' => 'Permisos',
                    'attr' => array('inline' => true)
                ))
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $permiso = $event->getData();
            $form = $event->getForm();

            // check if the Product object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "Product"
            if (!$permiso || null === $permiso->getId()) {
                
            } else {
                if ($permiso->getPermisos() == 11) {
                    $form->add('perms', 'choice', array(
                        'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                        'multiple' => true,
                        'expanded' => true,
                        'required' => false,
                        'mapped' => false,
                        'by_reference' => false,
                        'data' => ['1', '2'],
                        'label' => 'Permisos',
                        'attr' => array('inline' => true)
                    ));
                } else if ($permiso->getPermisos() == 10) {
                    $form->add('perms', 'choice', array(
                        'choices' => array('1' => 'Escritura', '2' => 'Lectura'),
                        'multiple' => true,
                        'expanded' => true,
                        'required' => false,
                        'mapped' => false,
                        'by_reference' => false,
                        'data' => ['2'],
                        'label' => 'Permisos',
                        'attr' => array('inline' => true)
                    ));
                }
            }
        });
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
