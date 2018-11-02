<?php

namespace App\Admin;

use App\Entity\Partner;
use App\Entity\Subscription;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelType;

class SubscriptionAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'inDate',
    ];

    public function toString($object)
    {
        return $object instanceof Subscription ? $object->getId() : 'Suscripción';
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
            ->add('partner.code', null, 
                [ 'show_filter' => true, 'label' => 'Código' ]
            )
            ->add('partner.name', null, 
                [ 'show_filter' => true, 'label' => 'Nombre' ]
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('inDate', 'datetime', 
                [
                    'format' => 'd-m-Y H:i',
                    'label' => 'Inicio',
                    'header_style' => 'width: 140px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('outDate', 'datetime', 
                [
                    'format' => 'd-m-Y H:i',
                    'label' => 'Fin',
                    'header_style' => 'width: 140px; text-align: center',
                    'row_align' => 'center'
                ]
            )
            ->add('partner.code', null, 
                [
                    'label' => 'Código',
                    'header_style' => 'width: 100px;',
                ]
            )
            ->add('partner.name', null, 
                [
                    'label' => 'Nombre',
                ]
            )
            ->add('info', null, 
                [
                    'label' => 'Info',
                    'header_style' => 'width: 300px;',
                ]
            )
            ->add('price', null, 
                [
                    'label' => 'Precio',
                    'header_style' => 'width: 100px;',
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
                ->add('info', null, 
                    [
                        'label' => 'Info',
                    ]
                )
                ->add('price', null, 
                    [
                        'label' => 'Precio',
                    ]
                )
            ->end()
        ;

        $showMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('inDate', 'datetime', 
                    [
                        'format' => 'd-m-Y H:i',
                        'label' => 'Inicio',
                    ]
                )
                ->add('outDate', 'datetime', 
                    [
                        'format' => 'd-m-Y H:i',
                        'label' => 'Fin',
                    ]
                )
            ->end()
        ;
    }



    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', ['class' => 'col-md-8'])
                ->add('partner', ModelType::class, 
                    [
                        'class' => Partner::class,
                        'btn_add' => false,
                        'property' => 'name',
                        'label' => 'Socio'
                    ]
                )   
                ->add('info', TextType::class, 
                    [
                        'label'=>'Info'
                    ]
                )
                ->add('price', NumberType::class, 
                    [
                        'label'=>'Precio', 
                    ]
                )
            ->end()
        ;

        $formMapper
            ->with('Configuración', ['class' => 'col-md-4'])
                ->add('indate', DateType::class, 
                    [
                        'widget' => 'single_text',
                        'label' => 'Inicio',
                        'data' => new  \DateTime("now")
                    ]
                )
                ->add('outdate', DateType::class, 
                    [
                        'widget' => 'single_text',
                        'label' => 'Fin',
                        'data' => new  \DateTime("next year")
                    ]
                )
            ->end()
        ;

    }

}