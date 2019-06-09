<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.05.2019
 * Time: 17:38
 */

namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;
use UserBundle\Form\Models\RegisterUserModel;

class RegisterUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('firstName', TextType::class, [
//            'data_class' => UserAccount::class,
//            'label' => 'First Name'
//        ]);
        $builder->add('username', TextType::class, [
            'data_class' => UserAccount::class,
            'label' => 'User name'
        ]);
        $builder->add('email', RepeatedType::class, [
            'type' => EmailType::class,
            'invalid_message' => 'The email address is invalid.',
            'options' => ['attr' => ['class' => 'email-field']],
            'required' => true,
            'first_options'  => ['label' => 'Email'],
            'second_options' => ['label' => 'Repeat Email'],
        ]);
        $builder->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Password'],
            'second_options' => ['label' => 'Repeat Password'],
        ]);
        $builder->add('birthday', BirthdayType::class, [
            'label' => 'Birthday',
        ]);
        $builder->add('gender', TextType::class, [
            'label' => 'Gender'
        ]);
        $builder->add('phone', TextType::class, [
            'label' => 'Phone'
        ]);
        $builder->add('submit', SubmitType::class,[
            'label' => 'Register'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterUserModel::class
        ]);
    }
}