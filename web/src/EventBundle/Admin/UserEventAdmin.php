<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 02.06.2019
 * Time: 17:59
 */

namespace EventBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UserEventAdmin extends AbstractAdmin
{
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('subscribe')
        ;
    }


}