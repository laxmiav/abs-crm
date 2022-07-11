<?php

namespace App\Form;

use App\Entity\Service;
use App\Entity\Sales;
use App\Entity\User;
use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('service_id',TextType::class,[
               'required'=>false
            ])
            ->add('created_at',DateType::class)
            ->add('problem',TextareaType::class,[
                'required'=>false
             ])
            ->add('service_status',ChoiceType::class,[
                'choices'  => [
                    'TODO' => 'todo',
                    'Progress' => 'progress',
                    'Pending' => 'pending',
                    'Complete' => 'complete',
                ],
                'required'=>false
            ])
            ->add('typeOfPending',TextType::class,[
                'required'=>false
             ])
            ->add('remarks',TextareaType::class,[
                'required'=>false
             ])
            ->add('closingAt',DateType::class,[
                'required'=>false
             ])
            ->add('FSR_id',TextType::class,[
                'required'=>false
             ])
            ->add('invoice_id',TextType::class,[
                'required'=>false
             ])
            ->add('amount',MoneyType::class,[
                'required'=>false
             ])
            ->add('invoice_status',ChoiceType::class,[
                'choices'  => [
                    'NA'=>'NA',
                    'Paid' => 'paid',
                    'Unpaid' => 'unpaid',
                    'Partialy-Paid' => 'partaily-paid',
                ],
                'required'=>false
            ])
            ->add('category',ChoiceType::class,[
                'choices'  => [
                    'Public' => 'public',
                    'Private' => 'private',
                    'Others' => 'others',
                ],
                'required'=>false
            ])
            ->add('user',EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.fullname', 'ASC');
                },
                'choice_label' => 'fullname',
                'multiple'=>true,
                'expanded'=>true,
                'required'=>false
            ])
            ->add('customer',EntityType::class, [
                'class' => Customer::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple'=>true,
                'expanded'=>true,
                'required'=>false
            ])
            ->add('sales',EntityType::class, [
                'class' => Sales::class,
                
                'choice_label' => 'name',
                'multiple'=>true,
                'expanded'=>true,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
