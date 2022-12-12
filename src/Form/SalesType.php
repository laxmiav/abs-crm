<?php

namespace App\Form;

use App\Entity\Sales;
use App\Entity\Service;
use App\Entity\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class)
            ->add('createdAt',Datetype::class)
            ->add('warenty',Datetype::class)
            ->add('details',TextareaType::class)
            // ->add('services', EntityType::class, [
            //     'class' => Service::class,
            //     'choice_label' => '',
            //     'multiple'=> true,
            //     'expanded'=> true,
            // ])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple'=>false,
                'expanded'=>true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sales::class,
        ]);
    }
}
