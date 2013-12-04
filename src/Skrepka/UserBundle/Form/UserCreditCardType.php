<?php

namespace Skrepka\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserCreditCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cardNumber', 'text')
            ->add('month', 'text')
            ->add('year', 'text')
            ->add('cvv2', 'text')
        ;
    }

    public function getName()
    {
        return 'credit_card';
    }
}
