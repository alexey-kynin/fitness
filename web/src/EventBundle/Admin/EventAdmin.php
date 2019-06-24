<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 02.06.2019
 * Time: 17:59
 */

namespace EventBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EventAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array(
                'label' => 'Event Title'
            ))
            ->add('description', 'text', array(
                'label' => 'Event Description'
            ))
            ->add('staff', null, [
                'label' => 'Trainer',
            ])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('description')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('description')
            ->add('staff', null, [
                'label' => 'Trainer',
            ])
            ->add('totalUser', IntegerType::class, [
                'label' => 'Amount user'
            ])
            ->add('_action', 'actions', [
                    'actions' => [
                        'delete' => [],
                        'message' => [
                            'template' => '@Event/CRUD/list__action_message.html.twig',
                        ]
                    ]
                ]
            )
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('description')
            ->add('totalUser', IntegerType::class, [
                'label' => 'Amount user'
            ])

//            ->add('_action', 'actions', [
//                    'actions' => [
//                        'delete' => [],
//                        'message' => [
//                            'template' => '@Event/CRUD/list__action_message.html.twig',
//                        ]
//                    ]
//                ]
//            )
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('message', $this->getRouterIdParameter().'/message');
    }
}