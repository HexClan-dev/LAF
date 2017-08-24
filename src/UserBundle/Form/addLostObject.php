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

        $builder->add('type')
            ->add("lostPlace",TextareaType::class)
            ->add("date", DateTimeType::class,array(
                'label'=>'Lost Date',
                'attr'   =>  array(
                    'class'   => ''),
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                )))
            ->add("description", TextareaType::class,[
                'attr'=> array(
                    'height'=> '50px'
                )
            ]);

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
