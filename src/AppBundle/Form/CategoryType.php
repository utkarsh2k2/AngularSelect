<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('categoryname', ChoiceType::class, array(
            'choices' => array(
                'choose a category' => null,
                'standard' => 1,
                'premium' => 2,
                'gold' => 3,
            ),
            'choices_as_values' => true,
            'expanded' => false,
            'multiple' => false,
            'label' => 'Choose Category',
        ));
        $builder->add('tags', CollectionType::class, array(
            'entry_type' => TagType::class,
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category',
        ));
    }

}
