<?php

namespace App\Form;

use Decimal\Decimal;
use App\Entity\Voiture;
use App\Enum\MotorEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\DataTransformer\DecimalToStringTransformer;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la voiture',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('monthlyPrice', NumberType::class, [
                'label' => 'Prix mensuel',
                'scale' => 2,
            ])
            ->add('dailyPrice', NumberType::class, [
                'label' => 'Prix journalier',
                'scale' => 2,
            ])
            ->add('places', ChoiceType::class, [
                'label' => 'Nombre de places',
                'choices' => array_combine(range(1, 9), range(1, 9)),
            ])
            ->add('motor', EnumType::class, [
                'label' => 'Boîte de vitesse',
                'class' => MotorEnum::class,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => ['class' => 'btn-add'],
            ])
        ;

        $builder->get('monthlyPrice')
            ->addModelTransformer(new DecimalToStringTransformer());

        $builder->get('dailyPrice')
            ->addModelTransformer(new DecimalToStringTransformer());
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
