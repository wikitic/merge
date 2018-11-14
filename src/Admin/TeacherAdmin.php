<?php

namespace App\Admin;

use App\Entity\Teacher;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class TeacherAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'id',
    ];

    public function toString($object)
    {
        return $object instanceof Teacher ? $object->getName() : 'Teacher';
    }   

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);
        return $actions;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'create', 'edit']);
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, 
                [ 'show_filter' => true, 'label' => 'Nombre' ]
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, 
                [
                    'label' => '#id',
                    'header_style' => 'width: 50px; text-align: center;',
                    'row_align' => 'center'
                ]
            )
            ->add('name', null, 
                [
                    'label' => 'Nombre',
                ]
            )
            ->add('email', null, 
                [
                    'label' => 'Email',
                    'header_style' => 'width: 200px;',
                ]
            )
            ->add('active', 'boolean', 
                [
                    //'editable' => true, 
                    'label' => 'Estado',
                    'header_style' => 'width: 100px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            /*
            ->add('cdate', 'datetime', 
                [
                    'format' => 'd-m-Y H:i',
                    'label' => 'Creado',
                    'header_style' => 'width: 140px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            */
            ->add('mdate', 'datetime', 
                [
                    'format' => 'd-m-Y H:i',
                    'label' => 'Modificado',
                    'header_style' => 'width: 140px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('_action', 'actions', 
                [
                    'actions' => 
                    [
                        'edit' => [],
                    ],
                    'header_style' => 'width: 90px; text-align: center',
                    'row_align' => 'center'
                ]
            )
        ;
    }



    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $er = $em->getRepository($this->getClass());

        $formMapper
            ->with('General', ['class' => 'col-md-8']) 
                ->add('name', TextType::class, 
                    [
                        'label'=>'Nombre'
                    ]
                )
                ->add('description', TextareaType::class, 
                    [
                        'label'=>'Descripción'
                    ]
                )
                ->add('email', EmailType::class, 
                    [
                        'label'=>'Email', 
                    ]
                )
                ->add('password', RepeatedType::class, 
                    [
                        'type' => PasswordType::class,
                        'invalid_message' => 'The password fields must match.',
                        'options' => ['attr' => ['class' => 'password-field']],
                        'first_options'  => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repite Contraseña'),
                        
                    ]
                )
            ->end()
        ;

        $formMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('active', ChoiceType::class, 
                    [
                        'choices' => [
                            'Activado' => true,
                            'Desactivado' => false,
                        ],
                        'label' => 'Estado'
                    ]
                )
                ->add('image', TextType::class, 
                    [
                        'label' => 'Imagen'
                    ]
                )
                ->add('social', TextareaType::class, 
                    [
                        'label' => 'RRSS'
                    ]
                )
            ->end()
        ;
    }

}