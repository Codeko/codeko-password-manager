<?php

namespace Application\Sonata\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermisoCategoriaGrupoType extends AbstractType {

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

        // $transformer = new PermisosUserTransformer($array);
        // add a normal text field, but add your transformer to it
        //        $builder->add(
        //                $builder->create('issue', 'text')
        //                        ->addModelTransformer($transformer)
        //        );

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            if (null != $event->getData()) {
                //                var_dump($event->getData());
                //                exit();
            }
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Application\Sonata\UserBundle\Entity\PermisoCategoriaGrupo'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'application_sonata_userbundle_permisocategoriagrupo';
    }

}
