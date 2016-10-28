<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TagType extends AbstractType {

    protected $tag;

    public function __construct(array $tag = array()) {
        $this->tag = $tag;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('tagname', EntityType::class, array(
            'class' => 'AppBundle:Tag',
            'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('t')
                  ->orderBy('t.id', 'ASC');
    },
            'choice_label' => 'tagname',
            'expanded' => false,
            'multiple' => true,
            'label' => 'Tags',
            'data' => $this->tag,
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tag',
        ));
    }
}
