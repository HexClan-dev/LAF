<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogInForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('username')
            ->add('password',PasswordType::class);

    }

}
