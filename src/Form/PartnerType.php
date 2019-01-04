<?php

namespace App\Form;

use App\Entity\Partner;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class PartnerType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('name', TextType::class)
            ->add('surname', TextType::class)
            ->add('email', EmailType::class)
		;
    }
    
	/**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
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