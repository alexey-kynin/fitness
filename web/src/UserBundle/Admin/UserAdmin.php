<?php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use UserBundle\Entity\Roles;
use Sonata\Form\Type\DatePickerType;
use UserBundle\Entity\User;
use UserBundle\Extend\Security\RecoverPassword;


final class UserAdmin extends AbstractAdmin
{

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
//            ->add('password', RepeatedType::class, [
//            ])
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


    public function prePersist($object) {
        parent::prePersist($object);
        $this->updateUser($object);
    }

    public function preUpdate($object) {
        parent::preUpdate($object);
        $this->updateUser($object);
    }

    public function updateUser(User $user) {
        $password = $user->randomPassword();
        $user->setPassword($password);

//        $this->get('user.security.recover')->sendEmail($user);

        $usr = $this->getConfigurationPool()->getContainer()->get('user.security.recover');
        $usr->sendEmail($user);
//        $um->updateUser($u, false);
    }
}