<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\ContractEnum;
use App\Form\DataTransformer\StringToContractEnumTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('status', ChoiceType::class, [
                'choices' => array_combine(ContractEnum::values(), ContractEnum::values()),
                'placeholder' => 'Choose a contract',
            ])
            ->add('isActive')
            ->add('role')
            ->add('hiredOn')
            ->add('password')
        ;

        // convert between submitted string and ContractEnum instance
        $builder->get('status')->addModelTransformer(new StringToContractEnumTransformer());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
