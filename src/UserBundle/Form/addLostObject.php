<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class addLostObject extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // Type is the objects that the schools is responsible for

        $builder->add('type', ChoiceType::class, array(
            'choices'  => array(
                'Select one Option' => null,
                'Wallet' => "Wallet",
                'Clothes' => "Clothes")
            ))
            ->add("lostPlace",TextareaType::class)
            ->add("date", DateTimeType::class)
            ->add("description", TextareaType::class);

        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return $resolver->setDefaults(array('data_class'=>"UserBundle\Entity\LostObject"));
    }

    public function getBlockPrefix()
    {
        return 'user_bundleadd_lost_object';
    }
}
