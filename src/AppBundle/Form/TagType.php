<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('tagname');
        $builder->add('tagname', ChoiceType::class, array(
            'choices' => array(
                'wifi' => 1,
                'cable' => 2,
                'television' => 3,
                'geyser' => 4,
                'fridge' => 5,
                'sofa' => 6,
                'lift' => 7,
                'winston' => 8,
                'west' => 9,
            ),
            'choices_as_values' => true,
            'expanded' => false,
            'multiple' => true,
            'label' => 'Choose Tags',
            'empty_value' => 'Choose Tags',
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tag',
        ));
    }
}