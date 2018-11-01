<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'edit']);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('username', TextType::class, 
                    [
                        'label'=>'Username'
                    ]
                )
                ->add('password', RepeatedType::class, 
                    [
                        'type' => PasswordType::class,
                        'invalid_message' => 'The password fields must match.',
                        'options' => ['attr' => ['class' => 'password-field']],
                        'required' => true,
                        'first_options'  => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repite Contraseña'),
                        
                    ]
                )
            ->end()
        ;
    }

    public function preValidate($entity)
    {
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $entity->setPassword(password_hash($entity->getPassword(), PASSWORD_BCRYPT, ['cost' => 4]));   
        $em->persist($entity);
        $em->flush();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username', null, 
                [
                    'show_filter' => true, 
                    'label' => 'Username' 
                ]
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username', null, 
                [
                    'label' => 'Username',
                    'header_style' => 'width: 150px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('password', 'boolean', 
                [
                    'label' => 'Contraseña',
                ]
            )
            ->add('role', 'choice', 
                [
                    'choices' => [
                        '999' => 'SUPER ADMIN',
                    ],
                    'label' => 'Rol',
                    'header_style' => 'width: 200px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('_action', 'actions', 
                [
                    'actions' => 
                    [
                        'edit' => []
                    ],
                    'header_style' => 'width: 100px; text-align: center',
                ]
            )
        ;
    }

    public function toString($object)
    {
        return $object instanceof Admin ? $object->getUsername() : 'Admin';
    }
}