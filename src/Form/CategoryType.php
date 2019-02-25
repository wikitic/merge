<?php
namespace App\Form;

use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('alias', TextType::class)
            ->add('description', TextareaType::class)

            ->add('metatitle', TextType::class)
            ->add('metadesc', TextType::class)
            ->add('metakey', TextType::class)
            ->add('metaimage', TextType::class)

            ->add('active', NumberType::class)
            ->add('ordering', NumberType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'csrf_protection' => false
        ]);
    }
    
    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
