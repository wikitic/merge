<?php

namespace App\Admin;

use App\Entity\Partner;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PartnerAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'cdate',
    ];

    public function toString($object)
    {
        return $object instanceof Partner ? $object->getCode().': '.$object->getName().' '.$object->getSurname() : 'Socio';
    }   

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);
        return $actions;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'show', 'create', 'edit', 'delete']);
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('code', null, 
                [ 'show_filter' => true, 'label' => 'Código' ]
            )
            ->add('name', null, 
                [ 'show_filter' => true, 'label' => 'Nombre' ]
            )
            ->add('email', null, 
                [ 'show_filter' => true, 'label' => 'Email' ]
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('code', null, 
                [
                    'label' => 'Código',
                    'header_style' => 'width: 100px;',
                ]
            )
            ->add('name', null, 
                [
                    'label' => 'Nombre',
                    'header_style' => 'width: 250px;',
                ]
            )
            ->add('surname', null, 
                [
                    'label' => 'Apellidos',
                    'header_style' => 'width: 250px;',
                ]
            )
            ->add('email', null, 
                [
                    'label' => 'Email',
                    'header_style' => 'width: 250px;',
                ]
            )
            ->add('role', 'choice', 
                [
                    'choices' => [
                        '0' => 'User',
                        '1' => 'Premium',
                    ],
                    'label' => 'Rol',
                    'header_style' => 'width: 100px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('active', 'boolean', 
                [
                    //'editable' => true, 
                    'label' => 'Habilitado',
                    'header_style' => 'width: 100px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('cdate', 'datetime', 
                [
                    'format' => 'd-m-Y H:i',
                    'label' => 'Creado',
                    'header_style' => 'width: 140px; text-align: center',
                    'row_align' => 'center'
                ]
            )
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
                        'show' => [],
                        'edit' => []
                    ],
                    'header_style' => 'width: 180px; text-align: center',
                    'row_align' => 'center'
                ]
            )
        ;
    }



    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General', ['class' => 'col-md-8'])
                ->add('code', null, 
                    [
                        'label' => 'Código',
                    ]
                )
                ->add('name', null, 
                    [
                        'label' => 'Nombre',
                    ]
                )
                ->add('surname', null, 
                    [
                        'label' => 'Apellidos',
                    ]
                )
                ->add('email', null, 
                    [
                        'label' => 'Email',
                    ]
                )
            ->end()
        ;

        $showMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('role', 'choice', 
                    [
                        'choices' => [
                            '0' => 'User',
                            '1' => 'Premium',
                        ],
                        'label' => 'Rol',
                    ]
                )
                ->add('active', 'boolean', 
                    [
                        'label' => 'Habilitado',
                    ]
                )
                ->add('cdate', 'datetime', 
                    [
                        'format' => 'd-m-Y H:i',
                        'label' => 'Creado',
                    ]
                )
                ->add('mdate', 'datetime', 
                    [
                        'format' => 'd-m-Y H:i',
                        'label' => 'Modificado',
                    ]
                )
            ->end()
        ;
    }



    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $er = $em->getRepository($this->getClass());

        $code = $object->getCode() ? $object->getCode() : $er->findUniqueCode();

        $formMapper
            ->with('General', ['class' => 'col-md-8'])
                ->add('code', TextType::class, 
                    [
                        'label'=>'Código',
                        'data' => $code,
                        'attr' => [
                            'readonly' => true,
                        ]
                    ]
                )    
                ->add('name', TextType::class, 
                    [
                        'label'=>'Nombre'
                    ]
                )
                ->add('surname', TextType::class, 
                    [
                        'label'=>'Apellidos', 
                    ]
                )
                ->add('email', TextType::class, 
                    [
                        'label'=>'Email', 
                    ]
                )
                /*
                ->add('password', RepeatedType::class, 
                    [
                        'type' => PasswordType::class,
                        'invalid_message' => 'Las contraseñas deben coincidir.',
                        'options' => 
                            [
                                'attr' => ['class' => 'password-field']
                            ],
                        'first_options'  => ['label' => 'Contraseña'],
                        'second_options' => ['label' => 'Repite Contraseña']
                    ]
                )
                */ 
                ;
                if ($this->isCurrentRoute('create')) {
                    $formMapper
                        ->add('password', HiddenType::class, 
                            [
                                'label' => 'Contraseña',
                                'data' => $code
                            ]
                        );
                }
        $formMapper
            ->end()
        ;

        $formMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('role', ChoiceType::class, 
                    [
                        'choices' => [
                            'User' => 0,
                            'Premium' => 1,
                        ],
                        'label' => 'Estado'
                    ]
                )
                ->add('active', ChoiceType::class, 
                    [
                        'choices' => [
                            'Activado' => true,
                            'Desactivado' => false,
                        ],
                        'label' => 'Estado'
                    ]
                )
                /*
                ->add('cdate', DateType::class, 
                    [
                        'widget' => 'single_text',
                        'label' => 'Creado',
                    ]
                )
                ->add('mdate', DateType::class, 
                    [
                        'widget' => 'single_text',
                        'label' => 'Modificado',
                    ]
                )
                */
            ->end()
        ; 
    }

}