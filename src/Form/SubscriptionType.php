<?php

namespace App\Form;

use App\Entity\Partner;
use App\Entity\Subscription;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SubscriptionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('partner', EntityType::class, ['class' => Partner::class])
            ->add('info', TextType::class)
            ->add('price', NumberType::class)
            ->add('inDate', DateTimeType::class, ['widget' => 'single_text'])
            ->add('outDate', DateTimeType::class, ['widget' => 'single_text'])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
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
