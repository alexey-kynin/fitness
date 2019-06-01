<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.05.2019
 * Time: 21:37
 */

namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Form\Models\RecoverUserModel;

class RecoverUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class,[
            'label' => 'Email'
        ]);
        $builder->add('submit', SubmitType::class,[
            'label' => 'Recover'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecoverUserModel::class
        ]);
    }
}