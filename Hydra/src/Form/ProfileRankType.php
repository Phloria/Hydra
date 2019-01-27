<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileRankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('csgoActualRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'Never Played' => 1,
                    'Unranked' => 2,
                    'Silver 1' => 3,
                    'Silver 2' => 4,
                ],
            ])
            ->add('csgoBestRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'None' => 2,
                    'Silver 1' => 3,
                    'Silver 2' => 4,
                ],
            ])
            ->add('owActualRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'Never Played' => 1,
                    'Unranked' => 2,
                    'Bronze' => 3,
                    'Silver' => 4,
                ],
            ])
            ->add('owBestRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'None' => 2,
                    'Bronze' => 3,
                    'Silver' => 4,
                ],
            ])
            ->add('pubgLink',TextType::class, array('required'   => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
