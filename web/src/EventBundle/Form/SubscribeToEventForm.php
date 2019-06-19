<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 18.06.2019
 * Time: 16:34
 */

namespace EventBundle\Form;


use EventBundle\Form\Models\SubscribeToEventModel;
use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubscribeToEventForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('byEmail', TextType::class, [
//            'label' => 'By mail'
//        ]);
//        $builder->add('byPhone', TextType::class, [
//            'label' => 'By phone'
//        ]);
//        $builder->add('subscribe', TextType::class, [
//            'label' => 'subscribe!!!^ '
//        ]);
        $builder->add('subscribe', ChoiceType::class, [
            'label' => 'subscribe',
            'choices'  => [
                'By mail' => 'byEmail',
                'By Phone' => 'byPhone',
                'No' => false,
            ],
        ]);
        $builder->add('submit', SubmitType::class,[
            'label' => 'Subscribe'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => SubscribeToEventModel::class
        ]);
    }


}