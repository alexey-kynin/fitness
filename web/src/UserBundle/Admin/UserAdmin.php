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

//    //Если не получается отредактировать Пользователя. Ругается на пароль
//    protected $formOptions = array(
//        'validation_groups' => array('Profile')
//    );
// preUpdate  -  можно ее переопределить

    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {
            if(empty($roles)) {
                continue;
            }
            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $container = $this->getConfigurationPool()->getContainer();
//        $roles = $container->getParameter('security.role_hierarchy.roles');
//
//        $rolesChoices = self::flattenRoles($roles);
//        $em = Core::em();
//        $roleRepo = $em->getRepository(Roles::class);

        $formMapper
            ->add('username', TextType::class)
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'The email address is invalid.',
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
            ->add('roles', null, [
                'label' => 'Role user',
                'expanded' => true,
                'by_reference' => false,
                'multiple' => true
            ])
//            ->add('roles', 'choice', array(
//                    'choices'  => $roleRepo,
//                    'multiple' => true
//                )
//            )
//            ->add('role', 'choice', array(
//                'choices' => array(
//                    'ROLE_USER' => 'User',
//                    'ROLE_ADMIN' => 'Admin',
//                    'ROLE_SUPER_ADMIN' => 'Super Admin'
//                ),
//                'multiple' => false
//            ));
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

//    public function prePersist($object)
//    {
//        parent::prePersist($object);
//
//        $em = Core::em();
//        $roleRepo = $em->getRepository(Roles::class);
//        $role = $roleRepo->findByRole('ROLE_USER');
//        if (!$role){
//            $roles = new Roles();
//            $roles->setName('ROLE USER!');
//            $roles->setRole('ROLE_USER');
//            $em->persist($role);
//            $em->flush();
//        }
//
//    }
}