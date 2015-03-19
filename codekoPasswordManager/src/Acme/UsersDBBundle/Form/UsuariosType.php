<?php

namespace Acme\UsersDBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UsuariosType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('direccion_ip')
            ->add('email')
        ;
    }

    public function getName()
    {
        return 'acme_usersdbbundle_usuariostype';
    }
}
