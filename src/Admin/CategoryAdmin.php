<?php

namespace App\Admin;

use App\Entity\Category;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Sonata\CoreBundle\Form\Type\CollectionType;

class CategoryAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'ordering',
    ];

    public function toString($object)
    {
        return $object instanceof Category ? $object->getTitle() : 'Categoría';
    }   

    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);
        return $actions;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'show', 'create', 'edit']);
    }



    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, 
                [ 'show_filter' => true, 'label' => 'Título' ]
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('title', null, 
                [
                    'label' => 'Título',
                ]
            )
            ->add('alias', null, 
                [
                    'label' => 'Alias',
                    'header_style' => 'width: 100px;',
                ]
            )
            /*
            ->add('getCourses', 'integer', 
                [
                    'label' => 'Cursos',
                    'header_style' => 'width: 100px;',
                ]
            )
            */
            ->add('ordering', null, 
                [
                    'label' => 'Orden',
                    'header_style' => 'width: 100px;',
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
                ->add('title', null, 
                    [
                        'label' => 'Título',
                    ]
                )
                ->add('alias', null, 
                    [
                        'label' => 'Alias',
                    ]
                )
                ->add('description', null, 
                    [
                        'label' => 'Descripción',
                    ]
                )
            ->end()
        ;

        $showMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('ordering', 'integer', 
                    [
                        'label' => 'Orden',
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

        /*
        $showMapper
            ->with('Suscripciones', ['class' => 'col-md-12'])
                ->add('subscriptions', 'collection',
                    [
                        'label' => 'Suscripciones',
                    ]
                )
            ->end()
        ;
        */       
    }




    protected function configureFormFields(FormMapper $formMapper)
    {
        $object = $this->getSubject();
        $em = $this->getModelManager()->getEntityManager($this->getClass());
        $er = $em->getRepository($this->getClass());

        //$code = $object->getCode() ? $object->getCode() : $er->findUniqueCode();

        $formMapper
            ->with('General', ['class' => 'col-md-8']) 
                ->add('title', TextType::class, 
                    [
                        'label'=>'Título'
                    ]
                )
                ->add('alias', TextType::class, 
                    [
                        'label'=>'Alias', 
                    ]
                )
                ->add('description', TextareaType::class, 
                    [
                        'label'=>'Descripción', 
                    ]
                )
            ->end()
        ;

        $formMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('ordering', TextType::class, 
                    [
                        'label' => 'Orden'
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
            ->end()
        ;

        $formMapper
            ->with('SEO', ['class' => 'col-md-4'])
                ->add('metatitle', TextType::class, 
                    [
                        'label' => 'Meta-Título'
                    ]
                )
                ->add('metadesc', TextareaType::class, 
                    [
                        'label' => 'Meta-Descripción'
                    ]
                )
                ->add('metakey', TextareaType::class, 
                    [
                        'label' => 'Meta-Key'
                    ]
                )
                ->add('metaimage', TextType::class, 
                    [
                        'label' => 'Meta-Imagen'
                    ]
                )                
            ->end()
        ;

    }

}