<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 15.06.2019
 * Time: 16:57
 */

namespace UserBundle\Admin;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAccountAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('first_name', TextType::class)
            ->add('lastName', TextType::class);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('first_name', TextType::class, [])
            ->addIdentifier('lastName', TextType::class, []);
    }
}