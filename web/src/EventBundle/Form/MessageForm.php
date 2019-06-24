<?php

namespace EventBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use EventBundle\Form\Models\MessageModel;

class MessageForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('message_text', TextType::class,[
            'label' => 'Email'
        ]);
        $builder->add('submit', SubmitType::class,[
            'label' => 'Recover'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MessageModel::class
        ]);
    }
}