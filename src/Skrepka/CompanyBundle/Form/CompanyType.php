<?php

namespace Skrepka\CompanyBundle\Form;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['label' => 'form.company_name'])
            ->add('description', 'textarea')
            ->add('category', 'document', [
                'class' => 'CategoryBundle:Category',
                'property' => 'name',
                'query_builder' => function (DocumentRepository $dr) {
                    return $dr->createQueryBuilder()
                        ->sort('name', 'ASC')
                    ;
                },
                'group_by' => 'parentName',
                'empty_value' => 'select_category',
            ])
            ->add('city')
            ->add('address')
            ->add('mobilePhone', 'text', ['required' => false])
            ->add('phone', 'text', ['required' => false])
            ->add('email', 'email', ['required' => false])
            ->add('site', 'text', ['required' => false])
            ->add('metaData', 'document', [
                'class' => 'CompanyBundle:MetaData',
                'required' => false
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Skrepka\CompanyBundle\Document\Company'
        ]);
    }

    public function getName()
    {
        return 'company';
    }
}
