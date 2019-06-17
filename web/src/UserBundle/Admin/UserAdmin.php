<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 05.06.2019
 * Time: 22:12
 */

namespace UserBundle\Admin;

use CoreBundle\Core\Core;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\Roles;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;
use UserBundle\Form\Models\RegisterUserModel;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\DateTimePickerType;
use UserBundle\Form\RegisterUserForm;


final class UserAdmin extends AbstractAdmin
{

    public function getContainer(){
        return $this->getConfigurationPool()->getContainer();
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('User name')
                ->add('account', 'sonata_type_admin')
            ->end()
            ->add('username', TextType::class, [
                'label' => 'login'
            ])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,'invalid_message' => 'The email address is invalid.',
                'options' => ['attr' => ['class' => 'email-field']],
                'required' => true,
                'first_options'  => ['label' => 'Email'],
                'second_options' => ['label' => 'Repeat Email'],
            ])
            ->add('password', RepeatedType::class, [
            ])
            ->add('birthday', DatePickerType::class, [
                'dp_use_current'     => false,
                'format' => 'dd.MM.yyyy'
            ])
            ->add('gender', ChoiceFieldMaskType::class, [
                'choices' => [
                    'Man' => 'man',
                    'Women' => 'women'
                ]
            ])
            ->add('phone', TextType::class, [
                'attr'=>array('style'=>'width: 40%;')
            ])
            ->add('roles', 'sonata_type_model', [
                'label' => 'Role user',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true,
                'class' => Roles::class,
                'btn_add' => false,
            ])
    ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper
//            ->add('title')
//            ->add('author')
//        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('username', TextType::class, [

            ])
            ->add('birthday', 'date', [
                'pattern' => 'yyyy-MM-dd',
            ])
            ->add('email', EmailType::class, [

            ])
            ->add('phone', TextType::class, [

            ])
            ->add('gender', TextType::class, [

            ])
            ->add(
                '_action',
                'actions',
                [
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                    ]
                ]
            )
        ;
    }

    // Fields to be shown on show action
    protected function configureShowFields(ShowMapper $showMapper)
    {
//        $showMapper
//            ->add('id')
//            ->add('title')
//            ->add('slug')
//            ->add('author')
//        ;
    }
}