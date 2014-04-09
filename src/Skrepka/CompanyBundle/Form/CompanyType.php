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
            ->add('description', 'textarea', ['label' => 'form.company_desc'])
            ->add('category', 'document', [
                'label'         => 'form.company_category',
                'class'         => 'CategoryBundle:Category',
                'property'      => 'name',
                'query_builder' => function (DocumentRepository $dr) {
                    return $dr->createQueryBuilder()
                        ->sort('name', 'ASC')
                    ;
                },
                'group_by' => 'parentName',
                'empty_value' => 'select_category',
            ])
            ->add('city', 'document', [
                'label' => 'form.company_city',
                'class' => 'CompanyBundle:City',
            ])
            ->add('address', 'text', ['label' => 'form.company_address'])
            ->add('mobilePhone', 'text', [
                'label'     => 'form.company_mobile',
                'required'  => false
            ])
            ->add('phone', 'text', [
                'label'     => 'form.company_phone',
                'required'  => false])
            ->add('email', 'email', [
                'required' => false,
                'label' => 'form.email',
            ])
            ->add('site', 'text', [
                'required' => false,
                'label' => 'form.site',
            ])
            ->add('metaData', new MetaDataType(), [
                    'label' => '',
                    'required' => false,
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Skrepka\CompanyBundle\Document\Company',
            'cascade_validation' => true,
        ]);
    }

    public function getName()
    {
        return 'company';
    }
}
